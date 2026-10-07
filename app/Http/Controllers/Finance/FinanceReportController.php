<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FinanceReportController extends Controller
{
    public function index(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $payments = Payment::with(['booking', 'customer'])
            ->where(function ($query) use ($from, $to): void {
                $query->whereBetween('verified_at', [$from, $to])
                    ->orWhere(function ($query) use ($from, $to): void {
                        $query->whereNull('verified_at')->whereBetween('created_at', [$from, $to]);
                    });
            })
            ->latest()
            ->get();
        $refunds = Refund::whereBetween('created_at', [$from, $to])->get();
        $processedRefunds = Refund::whereIn('status', ['Disetujui', 'Berhasil'])
            ->whereBetween('processed_at', [$from, $to])
            ->get();

        if ($request->query('export') === 'csv') {
            return $this->exportCsv($payments);
        }

        return view('finance.reports.index', [
            'payments' => $payments,
            'refunds' => $refunds,
            'from' => $from,
            'to' => $to,
            'income' => $payments->whereIn('payment_status', ['Berhasil', 'Refund'])->sum('amount') - $processedRefunds->sum('amount'),
            'refundTotal' => $processedRefunds->sum('amount'),
            'refundCount' => $processedRefunds->count(),
            'todayIncome' => Payment::whereIn('payment_status', ['Berhasil', 'Refund'])->whereDate('verified_at', today())->sum('amount') - Refund::whereIn('status', ['Disetujui', 'Berhasil'])->whereDate('processed_at', today())->sum('amount'),
            'weekIncome' => Payment::whereIn('payment_status', ['Berhasil', 'Refund'])->whereBetween('verified_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('amount') - Refund::whereIn('status', ['Disetujui', 'Berhasil'])->whereBetween('processed_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('amount'),
            'monthIncome' => Payment::whereIn('payment_status', ['Berhasil', 'Refund'])->whereBetween('verified_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount') - Refund::whereIn('status', ['Disetujui', 'Berhasil'])->whereBetween('processed_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount'),
            'yearIncome' => Payment::whereIn('payment_status', ['Berhasil', 'Refund'])->whereBetween('verified_at', [now()->startOfYear(), now()->endOfYear()])->sum('amount') - Refund::whereIn('status', ['Disetujui', 'Berhasil'])->whereBetween('processed_at', [now()->startOfYear(), now()->endOfYear()])->sum('amount'),
            'successfulCount' => $payments->where('payment_status', 'Berhasil')->count(),
            'pendingCount' => $payments->where('payment_status', 'Pending')->count(),
            'failedCount' => $payments->whereIn('payment_status', ['Gagal', 'Dibatalkan'])->count(),
        ]);
    }

    private function dateRange(Request $request): array
    {
        $validated = $request->validate([
            'period' => ['nullable', 'in:hari,minggu,bulan,tahun,custom'],
            'from' => ['nullable', 'date', 'required_if:period,custom'],
            'to' => ['nullable', 'date', 'after_or_equal:from', 'required_if:period,custom'],
        ]);

        return match ($validated['period'] ?? 'bulan') {
            'hari' => [now()->startOfDay(), now()->endOfDay()],
            'minggu' => [now()->startOfWeek(), now()->endOfWeek()],
            'tahun' => [now()->startOfYear(), now()->endOfYear()],
            'custom' => [Carbon::parse($validated['from'])->startOfDay(), Carbon::parse($validated['to'])->endOfDay()],
            default => [now()->startOfMonth(), now()->endOfMonth()],
        };
    }

    private function exportCsv($payments): StreamedResponse
    {
        return response()->streamDownload(function () use ($payments): void {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Tanggal', 'ID Booking', 'Pelanggan', 'Paket Wisata', 'Metode Pembayaran', 'Nominal', 'Status']);
            foreach ($payments as $payment) {
                fputcsv($output, [
                    $payment->verified_at?->format('Y-m-d') ?? $payment->created_at->format('Y-m-d'),
                    $payment->booking?->kode_booking ?? '-',
                    $payment->customer?->nama_pelanggan ?? $payment->booking?->nama_pelanggan ?? '-',
                    $payment->booking?->paket_wisata ?? '-',
                    $payment->payment_method ?? '-',
                    $payment->amount,
                    $payment->payment_status,
                ]);
            }
            fclose($output);
        }, 'laporan-keuangan.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
