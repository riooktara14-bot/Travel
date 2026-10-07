<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function index()
    {
        Transaksi::syncPaidBookings();

        $transaksi = Transaksi::latest('tanggal_transaksi')->get();
        $transaksiPendapatan = $transaksi->whereIn('status', ['Lunas', 'Selesai']);
        $totalPendapatan = $transaksiPendapatan->sum('total');

        return view('pendapatan', compact('transaksi', 'transaksiPendapatan', 'totalPendapatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_transaksi' => 'required|string|max:255',
            'nama_pelanggan' => 'required|string|max:255',
            'paket_wisata' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        Transaksi::create($validated);

        return redirect()->route('pendapatan')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_transaksi' => 'required|string|max:255',
            'nama_pelanggan' => 'required|string|max:255',
            'paket_wisata' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        $booking = Booking::where('kode_booking', $transaksi->kode_transaksi)->first();
        $booking?->update([
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'status' => $validated['status'],
            'total_biaya' => $validated['total'],
        ]);

        return redirect()->route('pendapatan')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('pendapatan')->with('success', 'Transaksi berhasil dihapus.');
    }
}
