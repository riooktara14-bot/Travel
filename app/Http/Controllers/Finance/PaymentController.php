<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceActivity;
use App\Models\Payment;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(['Pending', 'Berhasil', 'Gagal', 'Dibatalkan', 'Refund'])],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        $query = Payment::with(['booking', 'customer'])->latest();
        $query->when($filters['search'] ?? null, function ($query, string $search): void {
            $query->where(function ($query) use ($search): void {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhereHas('booking', fn ($booking) => $booking->where('kode_booking', 'like', "%{$search}%"))
                    ->orWhereHas('customer', fn ($customer) => $customer->where('nama_pelanggan', 'like', "%{$search}%"));
            });
        });
        $query->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('payment_status', $status));
        $query->when($filters['from'] ?? null, function ($query, string $from): void {
            $query->where(function ($query) use ($from): void {
                $query->whereDate('verified_at', '>=', $from)
                    ->orWhere(fn ($query) => $query->whereNull('verified_at')->whereDate('created_at', '>=', $from));
            });
        });
        $query->when($filters['to'] ?? null, function ($query, string $to): void {
            $query->where(function ($query) use ($to): void {
                $query->whereDate('verified_at', '<=', $to)
                    ->orWhere(fn ($query) => $query->whereNull('verified_at')->whereDate('created_at', '<=', $to));
            });
        });

        return view('finance.payments.index', [
            'payments' => $query->paginate(15)->withQueryString(),
            'statuses' => ['Pending', 'Berhasil', 'Gagal', 'Dibatalkan', 'Refund'],
        ]);
    }

    public function show(Payment $payment)
    {
        $payment->load(['booking.pelanggan', 'customer', 'verifier', 'refunds.processor']);

        return view('finance.payments.show', compact('payment'));
    }

    public function proof(Payment $payment)
    {
        abort_unless($payment->payment_proof && Storage::disk('local')->exists($payment->payment_proof), 404);

        return Storage::disk('local')->response($payment->payment_proof);
    }

    public function verify(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['Berhasil', 'Gagal'])],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($request, $payment, $validated): void {
            $payment = Payment::lockForUpdate()->findOrFail($payment->id);
            abort_unless($payment->payment_status === 'Pending', 422, 'Hanya pembayaran Pending yang dapat diverifikasi.');

            $payment->update([
                'payment_status' => $validated['status'],
                'verified_by' => $request->user()->id,
                'verified_at' => now(),
                'notes' => $validated['notes'] ?? $payment->notes,
            ]);

            if ($payment->booking) {
                $payment->booking->update(['status' => $validated['status'] === 'Berhasil' ? 'Lunas' : 'Dibatalkan']);
            }

            if ($validated['status'] === 'Berhasil' && $payment->booking) {
                Transaksi::updateOrCreate(
                    ['kode_transaksi' => $payment->booking->kode_booking],
                    [
                        'nama_pelanggan' => $payment->customer?->nama_pelanggan ?? $payment->booking->nama_pelanggan,
                        'paket_wisata' => $payment->booking->paket_wisata,
                        'metode_pembayaran' => $payment->payment_method ?? 'Belum dipilih',
                        'total' => $payment->amount,
                        'tanggal_transaksi' => now()->toDateString(),
                        'status' => 'Lunas',
                    ]
                );
            }

            FinanceActivity::create([
                'payment_id' => $payment->id,
                'user_id' => $request->user()->id,
                'action' => $validated['status'] === 'Berhasil' ? 'payment_verified' : 'payment_rejected',
                'description' => $validated['notes'] ?? 'Status pembayaran diubah menjadi '.$validated['status'].'.',
                'reference_code' => $payment->booking?->kode_booking,
            ]);
        });

        return redirect()->route('finance.pembayaran.show', $payment)->with('success', 'Verifikasi pembayaran tersimpan.');
    }
}
