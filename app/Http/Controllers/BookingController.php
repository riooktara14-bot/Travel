<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DestinasiWisata;
use App\Models\FinanceActivity;
use App\Models\Payment;
use App\Models\Pelanggan;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['pelanggan', 'transportasi'])->latest('tanggal_berangkat')->get();
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $destinasi = DestinasiWisata::where('status', 'aktif')->orderBy('nama_destinasi')->get();
        $transportasis = Transportasi::where('status', 'aktif')->orderBy('nama_transportasi')->get();
        $statistik = [
            'total' => Booking::count(),
            'menunggu' => Booking::where('status', 'Menunggu Pembayaran')->count(),
            'selesai' => Booking::where('status', 'Selesai')->count(),
            'dibatalkan' => Booking::where('status', 'Dibatalkan')->count(),
        ];

        return view('booking', compact('bookings', 'pelanggans', 'destinasi', 'transportasis', 'statistik'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_booking' => 'required|string|max:255|unique:bookings,kode_booking',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
            'transportasi_id' => 'nullable|exists:transportasis,id',
            'metode_pembayaran' => 'nullable|in:Transfer Bank,QRIS,E-Wallet,Kartu Kredit',
            'nama_pelanggan' => 'nullable|string|max:255',
            'paket_wisata' => 'required|string|max:255',
            'tanggal_berangkat' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'total_biaya' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
        ]);

        $pelanggan = ($validated['pelanggan_id'] ?? null)
            ? Pelanggan::findOrFail($validated['pelanggan_id'])
            : Pelanggan::firstOrCreate(
                ['nama_pelanggan' => $validated['nama_pelanggan']],
                [
                    'email' => 'booking-'.$validated['kode_booking'].'@local.test',
                    'no_hp' => 'N/A',
                    'alamat' => 'Belum diisi',
                    'status' => 'Non Member',
                    'total_booking' => 0,
                ]
            );
        $validated['pelanggan_id'] = $pelanggan->id;
        $validated['nama_pelanggan'] = $pelanggan->nama_pelanggan;
        DB::transaction(function () use ($validated, $pelanggan, $request): void {
            $booking = Booking::create($validated);
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'customer_id' => $pelanggan->id,
                'amount' => $booking->total_biaya,
                'payment_method' => $booking->metode_pembayaran,
                'payment_status' => 'Pending',
            ]);
            FinanceActivity::create([
                'payment_id' => $payment->id,
                'user_id' => $request->user()?->id,
                'action' => 'payment_created',
                'description' => 'Pembayaran pending dibuat dari booking '.$booking->kode_booking.'.',
                'reference_code' => $booking->kode_booking,
            ]);
            $pelanggan->update(['total_booking' => $pelanggan->bookings()->count()]);
        });

        return redirect()->route('booking')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'jumlah_orang' => 'required|integer|min:1',
            'destinasi' => ['required', 'string', Rule::exists('destinasi_wisatas', 'nama_destinasi')->where('status', 'aktif')],
            'transportasi_id' => ['nullable', Rule::exists('transportasis', 'id')->where('status', 'aktif')],
            'metode_pembayaran' => 'nullable|in:Transfer Bank,QRIS,E-Wallet,Kartu Kredit',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'tanggal_berangkat' => 'required|date',
            'catatan' => 'nullable|string|max:2000',
        ]);

        $destination = DestinasiWisata::where('nama_destinasi', $validated['destinasi'])
            ->where('status', 'aktif')
            ->firstOrFail();
        $proofPath = $request->file('payment_proof')?->store('payment-proofs', 'local');

        $booking = DB::transaction(function () use ($validated, $destination, $proofPath): Booking {
            $pelanggan = Pelanggan::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'nama_pelanggan' => $validated['nama'],
                    'no_hp' => $validated['telepon'],
                    'alamat' => 'Belum diisi',
                    'status' => 'Member',
                ]
            );
            $booking = Booking::create([
                'kode_booking' => 'BK-'.strtoupper(Str::random(8)),
                'pelanggan_id' => $pelanggan->id,
                'nama_pelanggan' => $pelanggan->nama_pelanggan,
                'paket_wisata' => $destination->nama_destinasi,
                'tanggal_berangkat' => $validated['tanggal_berangkat'],
                'jumlah_peserta' => $validated['jumlah_orang'],
                'transportasi_id' => $validated['transportasi_id'] ?? null,
                'metode_pembayaran' => $validated['metode_pembayaran'] ?? null,
                'total_biaya' => number_format((float) $destination->harga * $validated['jumlah_orang'], 2, '.', ''),
                'status' => 'Menunggu Pembayaran',
            ]);
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'customer_id' => $pelanggan->id,
                'amount' => $booking->total_biaya,
                'payment_method' => $booking->metode_pembayaran,
                'payment_status' => 'Pending',
                'payment_proof' => $proofPath,
                'notes' => $validated['catatan'] ?? null,
            ]);
            FinanceActivity::create([
                'payment_id' => $payment->id,
                'user_id' => null,
                'action' => 'payment_created',
                'description' => 'Pembayaran pending dikirim bersama booking '.$booking->kode_booking.'.',
                'reference_code' => $booking->kode_booking,
            ]);
            $pelanggan->update(['total_booking' => $pelanggan->bookings()->count()]);

            return $booking;
        });

        return redirect()->route('booking1')->with('success', 'Booking berhasil dikirim dengan kode '.$booking->kode_booking.'.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_booking' => 'required|string|max:255',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
            'transportasi_id' => 'nullable|exists:transportasis,id',
            'nama_pelanggan' => 'nullable|string|max:255',
            'paket_wisata' => 'required|string|max:255',
            'tanggal_berangkat' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'total_biaya' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|in:Transfer Bank,QRIS,E-Wallet,Kartu Kredit',
            'status' => 'required|string|max:50',
        ]);

        $booking = Booking::findOrFail($id);
        $oldPelanggan = $booking->pelanggan;
        $pelanggan = ($validated['pelanggan_id'] ?? null)
            ? Pelanggan::findOrFail($validated['pelanggan_id'])
            : ($oldPelanggan ?: Pelanggan::firstOrCreate(
                ['nama_pelanggan' => $validated['nama_pelanggan']],
                [
                    'email' => 'booking-'.$validated['kode_booking'].'@local.test',
                    'no_hp' => 'N/A',
                    'alamat' => 'Belum diisi',
                    'status' => 'Non Member',
                    'total_booking' => 0,
                ]
            ));
        $validated['pelanggan_id'] = $pelanggan->id;
        $validated['nama_pelanggan'] = $pelanggan->nama_pelanggan;

        DB::transaction(function () use ($booking, $oldPelanggan, $pelanggan, $validated, $request): void {
            $booking->update($validated);
            $oldPelanggan?->update(['total_booking' => $oldPelanggan->bookings()->count()]);
            $pelanggan->update(['total_booking' => $pelanggan->bookings()->count()]);

            $booking->payments()
                ->where('payment_status', 'Pending')
                ->get()
                ->each(function (Payment $payment) use ($booking, $pelanggan, $request): void {
                    $newAmount = number_format((float) $booking->total_biaya, 2, '.', '');
                    $hasPaymentChanges = (string) $payment->amount !== $newAmount
                        || $payment->payment_method !== $booking->metode_pembayaran
                        || $payment->customer_id !== $pelanggan->id;

                    if (! $hasPaymentChanges) {
                        return;
                    }

                    $payment->update([
                        'customer_id' => $pelanggan->id,
                        'amount' => $newAmount,
                        'payment_method' => $booking->metode_pembayaran,
                    ]);
                    FinanceActivity::create([
                        'payment_id' => $payment->id,
                        'user_id' => $request->user()->id,
                        'action' => 'payment_updated',
                        'description' => 'Data pembayaran diperbarui mengikuti perubahan booking.',
                        'reference_code' => $booking->kode_booking,
                    ]);
                });
        });

        return redirect()->route('booking')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $pelanggan = $booking->pelanggan;
        $booking->delete();
        $pelanggan?->update(['total_booking' => $pelanggan->bookings()->count()]);

        return redirect()->route('booking')->with('success', 'Booking berhasil dihapus.');
    }
}
