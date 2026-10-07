<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\Finance\FinanceDashboardController;
use App\Http\Controllers\Finance\FinanceReportController;
use App\Http\Controllers\Finance\FinanceTransactionController;
use App\Http\Controllers\Finance\OperationalExpenseController;
use App\Http\Controllers\Finance\PaymentController;
use App\Http\Controllers\Finance\RefundController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\TransportasiController;
use App\Models\Booking;
use App\Models\DestinasiWisata;
use App\Models\Hotel;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

Route::get('/testimoni', function () {
    return view('testimoni');
})->name('testimoni');

Route::middleware(['auth', 'role:finance,owner'])->group(function (): void {
    Route::get('/finance/laporan-keuangan', [OperationalExpenseController::class, 'index'])->name('finance.laporankeuangan');

    Route::middleware('role:finance')
        ->prefix('finance/laporan-keuangan/pengeluaran')
        ->name('finance.laporan-keuangan.pengeluaran.')
        ->group(function (): void {
            Route::post('/', [OperationalExpenseController::class, 'store'])->name('store');
            Route::put('/{expense}', [OperationalExpenseController::class, 'update'])->name('update');
            Route::delete('/{expense}', [OperationalExpenseController::class, 'destroy'])->name('destroy');
        });
});

Route::middleware(['auth', 'role:admin,finance'])->group(function (): void {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

    Route::get('/pendapatan', [PendapatanController::class, 'index'])->name('pendapatan');
    Route::post('/pendapatan', [PendapatanController::class, 'store'])->name('pendapatan.store');
    Route::put('/pendapatan/{id}', [PendapatanController::class, 'update'])->name('pendapatan.update');
    Route::delete('/pendapatan/{id}', [PendapatanController::class, 'destroy'])->name('pendapatan.destroy');
    Route::get('/laporankeuangan', function () {
        return redirect()->route('finance.laporankeuangan');
    })->name('laporankeuangan');
});

Route::middleware(['auth', 'role:admin,finance'])->group(function (): void {
    Route::get('/profiladmin', [AdminController::class, 'profile'])->name('profiladmin');
    Route::put('/profiladmin', [AdminController::class, 'updateProfile'])->name('profiladmin.update');

    Route::prefix('finance')->name('finance.')->group(function (): void {
        Route::get('/profil', [AdminController::class, 'profile'])->name('profil');
        Route::put('/profil', [AdminController::class, 'updateProfile'])->name('profil.update');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/datapelanggan', [PelangganController::class, 'index'])->name('datapelanggan');
    Route::post('/datapelanggan', [PelangganController::class, 'store'])->name('datapelanggan.store');
    Route::put('/datapelanggan/{id}', [PelangganController::class, 'update'])->name('datapelanggan.update');
    Route::delete('/datapelanggan/{id}', [PelangganController::class, 'destroy'])->name('datapelanggan.destroy');

    Route::middleware('superadmin')->group(function () {
        Route::get('/kelolaadmin', [AdminController::class, 'index'])->name('kelolaadmin');
        Route::post('/kelolaadmin', [AdminController::class, 'store'])->name('kelolaadmin.store');
        Route::put('/kelolaadmin/{id}', [AdminController::class, 'update'])->name('kelolaadmin.update');
        Route::delete('/kelolaadmin/{id}', [AdminController::class, 'destroy'])->name('kelolaadmin.destroy');

        Route::get('/pengaturanweb', function () {
            return view('pengaturanweb');
        })->name('pengaturanweb');
    });

    Route::get('admin', function () {
        $bookings = Booking::with('pelanggan')->get();
        $todayBookings = $bookings->filter(fn (Booking $booking): bool => $booking->tanggal_berangkat?->isToday() ?? false);
        $upcomingBookings = $bookings->filter(fn (Booking $booking): bool => $booking->tanggal_berangkat?->isFuture() ?? false)->sortBy('tanggal_berangkat')->take(6);
        $monthlyBookings = $bookings->filter(fn (Booking $booking): bool => $booking->created_at?->year === now()->year)
            ->groupBy(fn (Booking $booking): int => $booking->created_at->month)
            ->map->count();
        $monthlyChart = collect(range(1, 12))->map(fn (int $month): int => $monthlyBookings->get($month, 0))->values();
        $incomeStatuses = ['Lunas', 'Selesai'];
        $totalPendapatan = Transaksi::whereIn('status', $incomeStatuses)
            ->whereNotIn('kode_transaksi', Booking::whereIn('status', $incomeStatuses)->select('kode_booking'))
            ->sum('total')
            + Booking::whereIn('status', $incomeStatuses)->sum('total_biaya');

        return view('admin', [
            'totalDestinasi' => DestinasiWisata::where('status', 'aktif')->count(),
            'totalHotels' => Hotel::where('status', 'aktif')->count(),
            'totalPelanggan' => Pelanggan::count(),
            'totalArmada' => Transportasi::where('status', 'aktif')->count(),
            'todayBookings' => $todayBookings,
            'todayBookingCount' => $todayBookings->count(),
            'upcomingBookings' => $upcomingBookings,
            'totalPendapatan' => $totalPendapatan,
            'monthlyChart' => $monthlyChart,
        ]);
    })->name('admin');

});

Route::get('/city', function () {
    return view('city');
})->name('city');

Route::get('/destination', [DestinasiWisataController::class, 'publicIndex'])->name('destination');

Route::get('/transportasi2', function () {
    return view('transportasi2');
})->name('transportasi2');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::view('/login', 'masuk')->name('login');
Route::view('/masuk', 'masuk')->name('masuk');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('finance')->name('finance.')->middleware(['auth', 'role:admin'])->group(function (): void {
    Route::get('/', FinanceDashboardController::class)->name('dashboard');
    Route::get('/dashboard', FinanceDashboardController::class)->name('dashboard.view');
    Route::get('/pembayaran', [PaymentController::class, 'index'])->name('pembayaran');
    Route::get('/pembayaran/{payment}', [PaymentController::class, 'show'])->name('pembayaran.show');
    Route::get('/pembayaran/{payment}/bukti', [PaymentController::class, 'proof'])->name('pembayaran.proof');
    Route::put('/pembayaran/{payment}/verifikasi', [PaymentController::class, 'verify'])->name('pembayaran.verify');
    Route::get('/pendapatan', [FinanceReportController::class, 'index'])->name('pendapatan');
    Route::get('/laporan', [FinanceReportController::class, 'index'])->name('laporan');
    Route::get('/riwayat', [FinanceTransactionController::class, 'index'])->name('riwayat');
});

Route::get('/refund', fn () => redirect()->route('finance.refund'))
    ->middleware(['auth', 'role:finance'])
    ->name('refund');

Route::prefix('finance')->name('finance.')->middleware(['auth', 'role:finance'])->group(function (): void {
    Route::get('/refund', [RefundController::class, 'index'])->name('refund');
    Route::post('/refund', [RefundController::class, 'store'])->name('refund.store');
    Route::put('/refund/{refund}', [RefundController::class, 'update'])->name('refund.update');
    Route::put('/refund/{refund}/request', [RefundController::class, 'updateRequest'])->name('refund.request.update');
    Route::delete('/refund/{refund}', [RefundController::class, 'destroy'])->name('refund.destroy');
});

Route::get('/booking1', function () {
    $destinasi = DestinasiWisata::where('status', 'aktif')->orderBy('nama_destinasi')->get();
    $transportasis = Transportasi::where('status', 'aktif')->orderBy('nama_transportasi')->get();

    return view('booking1', compact('destinasi', 'transportasis'));
})->name('booking1');
Route::post('/booking1', [BookingController::class, 'publicStore'])->name('booking1.store');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/destinasi-wisata', [DestinasiWisataController::class, 'index'])
        ->name('destinasiwisata');

    Route::post('/destinasi-wisata', [DestinasiWisataController::class, 'store'])
        ->name('destinasiwisata.store');

    Route::put('/destinasi-wisata/{id}', [DestinasiWisataController::class, 'update'])
        ->name('destinasiwisata.update');

    Route::delete('/destinasi-wisata/{id}', [DestinasiWisataController::class, 'destroy'])
        ->name('destinasiwisata.destroy');

    Route::get('/hotel', [HotelController::class, 'index'])
        ->name('hotel');

    Route::post('/hotel', [HotelController::class, 'store'])
        ->name('hotel.store');

    Route::put('/hotel/{id}', [HotelController::class, 'update'])
        ->name('hotel.update');

    Route::delete('/hotel/{id}', [HotelController::class, 'destroy'])
        ->name('hotel.destroy');

    Route::get('/transportasi', [TransportasiController::class, 'index'])
        ->name('transportasi');

    Route::post('/transportasi', [TransportasiController::class, 'store'])
        ->name('transportasi.store');

    Route::put('/transportasi/{id}', [TransportasiController::class, 'update'])
        ->name('transportasi.update');

    Route::delete('/transportasi/{id}', [TransportasiController::class, 'destroy'])
        ->name('transportasi.destroy');

    Route::get('/tourguide', [TourGuideController::class, 'index'])
        ->name('tourguide');

    Route::post('/tourguide', [TourGuideController::class, 'store'])
        ->name('tourguide.store');

    Route::put('/tourguide/{id}', [TourGuideController::class, 'update'])
        ->name('tourguide.update');

    Route::delete('/tourguide/{id}', [TourGuideController::class, 'destroy'])
        ->name('tourguide.destroy');

    Route::get('/promo', [PromoController::class, 'index'])
        ->name('promo');

    Route::post('/promo', [PromoController::class, 'store'])
        ->name('promo.store');

    Route::put('/promo/{id}', [PromoController::class, 'update'])
        ->name('promo.update');

    Route::delete('/promo/{id}', [PromoController::class, 'destroy'])
        ->name('promo.destroy');
});
