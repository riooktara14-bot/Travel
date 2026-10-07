<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::withCount('bookings')->latest()->get();

        return view('datapelanggan', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'total_booking' => 'required|integer|min:0',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'total_booking' => 'required|integer|min:0',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($validated);

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
