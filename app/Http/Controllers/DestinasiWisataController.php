<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DestinasiWisataController extends Controller
{
    public function publicIndex(Request $request): View
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
        ]);
        $search = trim($validated['q'] ?? '');
        $selectedLocation = $validated['lokasi'] ?? '';
        $lokasiList = DestinasiWisata::query()
            ->where('status', 'aktif')
            ->select('lokasi')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        $destinasi = DestinasiWisata::query()
            ->where('status', 'aktif')
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('nama_destinasi', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->when($selectedLocation !== '', function (Builder $query) use ($selectedLocation): void {
                $query->where('lokasi', $selectedLocation);
            })
            ->orderBy('nama_destinasi')
            ->get();

        return view('destination', compact('destinasi', 'lokasiList', 'search', 'selectedLocation'));
    }

    public function index()
    {
        // Ambil semua data destinasi
        $destinasi = DestinasiWisata::latest()->get();

        // Hitung jumlah berdasarkan status
        $totalAktif = DestinasiWisata::where('status', 'aktif')->count();
        $totalNonaktif = DestinasiWisata::where('status', 'nonaktif')->count();

        return view('destinasiwisata', compact(
            'destinasi',
            'totalAktif',
            'totalNonaktif'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_destinasi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'gambar' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        DestinasiWisata::create([
            'nama_destinasi' => $request->nama_destinasi,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'gambar' => $request->gambar,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('destinasiwisata')
            ->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_destinasi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'gambar' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);

        $destinasi->update([
            'nama_destinasi' => $request->nama_destinasi,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'gambar' => $request->gambar,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('destinasiwisata')
            ->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);

        $destinasi->delete();

        return redirect()
            ->route('destinasiwisata')
            ->with('success', 'Destinasi berhasil dihapus.');
    }
}
