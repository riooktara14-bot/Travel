<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceActivity;
use Illuminate\Http\Request;

class FinanceTransactionController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);
        $activities = FinanceActivity::with(['payment', 'user'])
            ->when($filters['search'] ?? null, function ($query, string $term): void {
                $query->where('reference_code', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('finance.history.index', compact('activities'));
    }
}
