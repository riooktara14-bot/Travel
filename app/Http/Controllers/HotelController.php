<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotel = Hotel::latest()->get();

        $totalHotel = Hotel::count();
        $totalAktif = Hotel::where('status', 'aktif')->count();
        $totalNonaktif = Hotel::where('status', 'nonaktif')->count();

        return view('hotel', compact(
            'hotel',
            'totalHotel',
            'totalAktif',
            'totalNonaktif'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'gambar' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Hotel::create([
            'nama_hotel' => $request->nama_hotel,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga_per_malam' => $request->harga_per_malam,
            'rating' => $request->rating,
            'gambar' => $request->gambar,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('hotel')
            ->with('success', 'Hotel berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'gambar' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $hotel = Hotel::findOrFail($id);

        $hotel->update([
            'nama_hotel' => $request->nama_hotel,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga_per_malam' => $request->harga_per_malam,
            'rating' => $request->rating,
            'gambar' => $request->gambar,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('hotel')
            ->with('success', 'Hotel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        return redirect()
            ->route('hotel')
            ->with('success', 'Hotel berhasil dihapus.');
    }
}
