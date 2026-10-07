<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\OperationalExpense;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OperationalExpenseController extends Controller
{
    public function index(): View
    {
        Transaksi::syncPaidBookings();

        $expenses = OperationalExpense::query()
            ->orderByDesc('expense_date')
            ->orderByDesc('id')
            ->get();
        $expenseBreakdown = $expenses
            ->groupBy('category')
            ->map(fn ($categoryExpenses) => $categoryExpenses->sum('amount'))
            ->sortDesc();
        $totalExpenses = $expenses->sum('amount');
        $incomeTransactions = Transaksi::incomeRecords();
        $incomeBreakdown = $incomeTransactions
            ->groupBy(fn (Transaksi $transaction): string => $transaction->paket_wisata ?: 'Destinasi tidak tersedia')
            ->map(fn ($methodTransactions) => $methodTransactions->sum('total'))
            ->sortDesc();
        $totalIncome = $incomeBreakdown->sum();
        $totalTransactions = Transaksi::count();
        $successfulTransactions = $incomeTransactions->count();
        $chartStart = now()->startOfMonth()->subMonths(5);
        $chartMonths = collect(range(0, 5))
            ->map(fn (int $monthOffset) => $chartStart->copy()->addMonths($monthOffset));
        $monthlyExpenseTotals = OperationalExpense::query()
            ->whereBetween('expense_date', [$chartStart->toDateString(), now()->endOfMonth()->toDateString()])
            ->get()
            ->groupBy(fn (OperationalExpense $expense): string => $expense->expense_date->format('Y-m'))
            ->map(fn ($monthExpenses) => $monthExpenses->sum('amount'));
        $chartMonthLabels = $chartMonths->map(fn ($month): string => $month->translatedFormat('F'))->all();
        $expenseChartData = $chartMonths
            ->map(fn ($month): float => (float) $monthlyExpenseTotals->get($month->format('Y-m'), 0))
            ->all();
        $monthlyIncomeTotals = collect($chartMonths)
            ->mapWithKeys(fn ($month): array => [$month->format('Y-m') => 0.0]);

        foreach ($incomeTransactions as $transaction) {
            $transactionMonth = $transaction->tanggal_transaksi?->format('Y-m');
            if ($transactionMonth !== null && $monthlyIncomeTotals->has($transactionMonth)) {
                $monthlyIncomeTotals->put(
                    $transactionMonth,
                    $monthlyIncomeTotals->get($transactionMonth) + (float) $transaction->total,
                );
            }
        }
        $incomeChartData = $monthlyIncomeTotals->values()->all();

        return view('laporankeuangan', compact(
            'expenses',
            'expenseBreakdown',
            'totalExpenses',
            'incomeBreakdown',
            'totalIncome',
            'totalTransactions',
            'successfulTransactions',
            'chartMonthLabels',
            'incomeChartData',
            'expenseChartData',
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->expenseRules());
        OperationalExpense::create($validated);

        return redirect()->route('finance.laporankeuangan')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function update(Request $request, OperationalExpense $expense): RedirectResponse
    {
        $validated = $request->validate($this->expenseRules());
        $expense->update($validated);

        return redirect()->route('finance.laporankeuangan')->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy(OperationalExpense $expense): RedirectResponse
    {
        $expense->delete();

        return redirect()->route('finance.laporankeuangan')->with('success', 'Pengeluaran berhasil dihapus.');
    }

    /**
     * @return array<string, array<int, string>>
     */
    private function expenseRules(): array
    {
        return [
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:2000'],
            'expense_date' => ['required', 'date'],
            'status' => ['required', 'in:Pending,Dibayar'],
            'amount' => ['required', 'numeric', 'decimal:0,2', 'min:0.01'],
        ];
    }
}
