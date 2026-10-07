<?php

namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    public function index()
    {
        $transportasi = Transportasi::latest()->get();

        return view('transportasi', compact('transportasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_transportasi' => 'required|string|max:255',
            'jenis_transportasi' => 'required|string|max:100',
            'perusahaan' => 'nullable|string|max:255',
            'rute' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'gambar' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Transportasi::create($validated);

        return redirect()->route('transportasi')->with('success', 'Transportasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_transportasi' => 'required|string|max:255',
            'jenis_transportasi' => 'required|string|max:100',
            'perusahaan' => 'nullable|string|max:255',
            'rute' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'gambar' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $item = Transportasi::findOrFail($id);
        $item->update($validated);

        return redirect()->route('transportasi')->with('success', 'Transportasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        $transportasi->delete();

        return redirect()->route('transportasi')->with('success', 'Transportasi berhasil dihapus.');
    }
}
