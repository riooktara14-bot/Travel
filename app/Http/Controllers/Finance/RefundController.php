<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceActivity;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RefundController extends Controller
{
    private const RESERVED_REFUND_STATUSES = ['Menunggu', 'Diproses', 'Disetujui', 'Berhasil'];

    private const REFUND_LIMIT_WARNING = 'Total refund tidak boleh melebihi 75% dari total pembayaran.';

    public function index(Request $request)
    {
        $status = $request->query('status');
        abort_if(
            $status !== null && ! in_array($status, ['Menunggu', 'Diproses', 'Disetujui', 'Berhasil', 'Ditolak'], true),
            422,
            'Filter status refund tidak valid.',
        );

        return view('refund', [
            'refunds' => Refund::with(['payment.booking', 'payment.customer', 'processor'])
                ->when($status, fn ($query) => $query->where('status', $status))
                ->latest()
                ->paginate(15)
                ->withQueryString(),
            'eligiblePayments' => Payment::with(['booking', 'customer'])
                ->where('payment_status', 'Berhasil')
                ->whereDoesntHave('refunds', fn ($query) => $query->whereIn('status', self::RESERVED_REFUND_STATUSES))
                ->latest()
                ->get(),
            'status' => $status,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => ['required', 'exists:payments,id'],
            'amount' => ['required', 'numeric', 'decimal:0,2', 'min:0.01'],
            'reason' => ['required', 'string', 'max:2000'],
        ]);

        $created = DB::transaction(function () use ($request, $validated): bool {
            $payment = Payment::query()->lockForUpdate()->findOrFail($validated['payment_id']);
            abort_unless($payment->payment_status === 'Berhasil', 422, 'Refund hanya dapat diajukan untuk pembayaran Berhasil.');

            if (! $this->isWithinRefundLimit($payment, (float) $validated['amount'])) {
                return false;
            }

            $refund = Refund::create([
                ...$validated,
                'payment_id' => $payment->id,
            ]);
            FinanceActivity::create([
                'payment_id' => $payment->id,
                'user_id' => $request->user()->id,
                'action' => 'refund_created',
                'description' => $validated['reason'],
                'reference_code' => $payment->booking?->kode_booking,
            ]);

            return true;
        });

        if (! $created) {
            return redirect()->route('finance.refund')
                ->withInput()
                ->with('warning', self::REFUND_LIMIT_WARNING);
        }

        return redirect()->route('finance.refund')->with('success', 'Pengajuan refund dibuat.');
    }

    public function updateRequest(Request $request, Refund $refund)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'decimal:0,2', 'min:0.01'],
            'reason' => ['required', 'string', 'max:2000'],
        ]);

        $updated = DB::transaction(function () use ($request, $refund, $validated): bool {
            $payment = Payment::query()->lockForUpdate()->findOrFail($refund->payment_id);
            $lockedRefund = Refund::query()->lockForUpdate()->findOrFail($refund->id);
            abort_unless(
                in_array($lockedRefund->status, ['Menunggu', 'Diproses'], true),
                422,
                'Hanya refund Menunggu atau Diproses yang dapat diedit.',
            );

            if (! $this->isWithinRefundLimit($payment, (float) $validated['amount'], $lockedRefund->id)) {
                return false;
            }

            $lockedRefund->update($validated);
            FinanceActivity::create([
                'payment_id' => $payment->id,
                'user_id' => $request->user()->id,
                'action' => 'refund_updated',
                'description' => 'Nominal/alasan refund diperbarui: '.$validated['reason'],
                'reference_code' => $payment->booking?->kode_booking,
            ]);

            return true;
        });

        if (! $updated) {
            return redirect()->route('finance.refund')
                ->withInput()
                ->with('warning', self::REFUND_LIMIT_WARNING);
        }

        return redirect()->route('finance.refund')->with('success', 'Pengajuan refund diperbarui.');
    }

    public function destroy(Request $request, Refund $refund)
    {
        DB::transaction(function () use ($request, $refund): void {
            $payment = Payment::query()->lockForUpdate()->findOrFail($refund->payment_id);
            $lockedRefund = Refund::query()->lockForUpdate()->findOrFail($refund->id);
            abort_unless(
                in_array($lockedRefund->status, ['Menunggu', 'Diproses'], true),
                422,
                'Hanya refund Menunggu atau Diproses yang dapat dihapus.',
            );

            FinanceActivity::create([
                'payment_id' => $payment->id,
                'user_id' => $request->user()->id,
                'action' => 'refund_deleted',
                'description' => 'Pengajuan refund dihapus: Rp'.number_format((float) $lockedRefund->amount, 2, ',', '.').' — '.$lockedRefund->reason,
                'reference_code' => $payment->booking?->kode_booking,
            ]);

            $lockedRefund->delete();
        });

        return redirect()->route('finance.refund')->with('success', 'Pengajuan refund dihapus.');
    }

    public function update(Request $request, Refund $refund)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['Diproses', 'Disetujui', 'Ditolak'])],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($request, $refund, $validated): void {
            $refund = Refund::lockForUpdate()->findOrFail($refund->id);
            $allowedTransition = ($refund->status === 'Menunggu' && $validated['status'] === 'Diproses')
                || ($refund->status === 'Diproses' && in_array($validated['status'], ['Disetujui', 'Ditolak'], true));
            abort_unless($allowedTransition, 422, 'Refund harus diproses terlebih dahulu dan status final tidak dapat diubah.');

            $refund->update([
                'status' => $validated['status'],
                'processed_by' => $request->user()->id,
                'processed_at' => now(),
                'notes' => $validated['notes'] ?? $refund->notes,
            ]);

            if ($validated['status'] === 'Disetujui') {
                $payment = Payment::query()->lockForUpdate()->findOrFail($refund->payment_id);
                abort_unless($payment->payment_status === 'Berhasil', 422, 'Pembayaran tidak lagi memenuhi syarat refund.');

                $payment->update(['payment_status' => 'Refund']);
                $payment->booking?->update(['status' => 'Dibatalkan']);

                $transactionUpdated = 0;
                if ($payment->legacy_transaction_id) {
                    $transactionUpdated = Transaksi::whereKey($payment->legacy_transaction_id)
                        ->update(['status' => 'Dibatalkan']);
                }

                if ($transactionUpdated === 0 && $payment->booking) {
                    Transaksi::where('kode_transaksi', $payment->booking->kode_booking)
                        ->update(['status' => 'Dibatalkan']);
                }
            }

            FinanceActivity::create([
                'payment_id' => $refund->payment_id,
                'user_id' => $request->user()->id,
                'action' => 'refund_'.$validated['status'],
                'description' => $validated['notes'] ?? 'Refund diproses: '.$validated['status'],
                'reference_code' => $refund->payment?->booking?->kode_booking,
            ]);
        });

        return redirect()->route('finance.refund')->with('success', 'Status refund diperbarui.');
    }

    private function isWithinRefundLimit(Payment $payment, float $requestedAmount, ?int $exceptRefundId = null): bool
    {
        $reservedAmount = $payment->refunds()
            ->whereIn('status', self::RESERVED_REFUND_STATUSES)
            ->when($exceptRefundId, fn ($query) => $query->where('id', '<>', $exceptRefundId))
            ->sum('amount');
        $paymentAmountInCents = (int) round((float) $payment->amount * 100);
        $maximumRefundInCents = intdiv($paymentAmountInCents * 75, 100);
        $reservedAmountInCents = (int) round((float) $reservedAmount * 100);
        $requestedAmountInCents = (int) round($requestedAmount * 100);

        return $requestedAmountInCents + $reservedAmountInCents <= $maximumRefundInCents;
    }
}
