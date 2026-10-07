<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promo = Promo::latest()->get();

        return view('promo', compact('promo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_promo' => 'required|string|max:255',
            'kode_promo' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'tipe_diskon' => 'required|in:persen,nominal',
            'nilai_diskon' => 'required|numeric|min:0',
            'minimal_transaksi' => 'required|numeric|min:0',
            'gambar' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Promo::create($validated);

        return redirect()
            ->route('promo')
            ->with('success', 'Promo berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_promo' => 'required|string|max:255',
            'kode_promo' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'tipe_diskon' => 'required|in:persen,nominal',
            'nilai_diskon' => 'required|numeric|min:0',
            'minimal_transaksi' => 'required|numeric|min:0',
            'gambar' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $promo = Promo::findOrFail($id);

        $promo->update($validated);

        return redirect()
            ->route('promo')
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);

        $promo->delete();

        return redirect()
            ->route('promo')
            ->with('success', 'Promo berhasil dihapus.');
    }
}
