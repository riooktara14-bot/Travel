<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refund;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class FinanceDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'period' => ['nullable', 'in:harian,mingguan,bulanan'],
        ]);
        $period = $validated['period'] ?? 'bulanan';
        $start = match ($period) {
            'harian' => now()->startOfDay(),
            'mingguan' => now()->subDays(6)->startOfDay(),
            default => now()->startOfMonth(),
        };
        $payments = Payment::where('payment_status', 'Berhasil')
            ->whereBetween('verified_at', [$start, now()->endOfDay()])
            ->get();
        $groupFormat = $period === 'harian' ? 'H:00' : 'd M';
        $chart = $payments->groupBy(fn (Payment $payment): string => $payment->verified_at->format($groupFormat));
        $labels = $period === 'harian'
            ? collect(range(0, 23))->map(fn (int $hour): string => sprintf('%02d:00', $hour))
            : collect(CarbonPeriod::create($start->copy()->startOfDay(), now()->startOfDay()))->map(fn ($date): string => $date->format('d M'));
        $values = $labels->map(fn (string $label): float => (float) $chart->get($label, collect())->sum('amount'));

        return view('finance.dashboard', [
            'period' => $period,
            'chartLabels' => $labels->values(),
            'chartValues' => $values->values(),
            'totalIncome' => Payment::whereIn('payment_status', ['Berhasil', 'Refund'])->sum('amount') - Refund::whereIn('status', ['Disetujui', 'Berhasil'])->sum('amount'),
            'monthlyIncome' => Payment::whereIn('payment_status', ['Berhasil', 'Refund'])->whereBetween('verified_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount') - Refund::whereIn('status', ['Disetujui', 'Berhasil'])->whereBetween('processed_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount'),
            'paymentCount' => Payment::count(),
            'successfulCount' => Payment::where('payment_status', 'Berhasil')->count(),
            'pendingCount' => Payment::where('payment_status', 'Pending')->count(),
            'failedCount' => Payment::whereIn('payment_status', ['Gagal', 'Dibatalkan'])->count(),
            'refundTotal' => Refund::whereIn('status', ['Disetujui', 'Berhasil'])->sum('amount'),
            'transactionCount' => Payment::count(),
            'recentPayments' => Payment::with(['booking', 'customer'])->latest()->limit(8)->get(),
        ]);
    }
}
