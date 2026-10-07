<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;
use Illuminate\Http\Request;

class TourGuideController extends Controller
{
    public function index()
    {
        $tourguide = TourGuide::latest()->get();

        $totalTourguide = TourGuide::count();
        $totalTersedia = TourGuide::where('status', 'tersedia')->count();
        $totalBertugas = TourGuide::where('status', 'bertugas')->count();
        $totalCuti = TourGuide::where('status', 'cuti')->count();

        return view('tourguide', compact(
            'tourguide',
            'totalTourguide',
            'totalTersedia',
            'totalBertugas',
            'totalCuti'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'bahasa' => 'nullable|string|max:100',
            'spesialisasi' => 'nullable|string|max:255',
            'harga_per_hari' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,bertugas,cuti',
        ]);

        TourGuide::create($validated);

        return redirect()->route('tourguide')->with('success', 'Tour guide berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'bahasa' => 'nullable|string|max:100',
            'spesialisasi' => 'nullable|string|max:255',
            'harga_per_hari' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,bertugas,cuti',
        ]);

        $tourGuide = TourGuide::findOrFail($id);
        $tourGuide->update($validated);

        return redirect()->route('tourguide')->with('success', 'Tour guide berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tourGuide = TourGuide::findOrFail($id);
        $tourGuide->delete();

        return redirect()->route('tourguide')->with('success', 'Tour guide berhasil dihapus.');
    }
}
