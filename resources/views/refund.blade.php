@extends('layouts.app')
@section('title', 'Pengajuan Refund')

@section('content')
@php
    $status = $status ?? request('status');
@endphp

<style>
    .refund-page, .refund-page *, .refund-page *::before, .refund-page *::after { box-sizing: border-box; }
    .refund-page { font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif; font-size: 15px; line-height: 1.5; color: #0e2a3b; padding: 24px; }
    .refund-page h1, .refund-page h2, .refund-page p { margin: 0; }

    /* Header */
    .refund-page .rf-hero { background: linear-gradient(120deg, #0e2a3b, #0b7a75); color: #fff; border-radius: 12px; padding: 24px; margin-bottom: 24px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between; }
    .refund-page .rf-hero h1 { font-size: 1.75rem; font-weight: 700; line-height: 1.2; margin-bottom: 4px; }
    .refund-page .rf-hero p { color: rgba(255, 255, 255, .8); }
    .refund-page .rf-count { background: #fff; color: #0e2a3b; border-radius: 999px; padding: 8px 16px; font-weight: 600; white-space: nowrap; }

    /* Alert */
    .refund-page .rf-alert { border-radius: 8px; padding: 12px 16px; margin-bottom: 16px; }
    .refund-page .rf-alert.ok { background: #d9f0e6; border: 1px solid #0b7a75; }
    .refund-page .rf-alert.bad { background: #fbe4e2; border: 1px solid #b3261e; color: #7a1a14; }
    .refund-page .rf-alert.warning { background: #fff4ce; border: 1px solid #d99b00; color: #694b00; }

    /* Kartu */
    .refund-page .rf-card { background: #fff; border: 1px solid #c9dbd8; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(14, 42, 59, .08); }

    /* Tab filter */
    .refund-page .refund-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .refund-page .refund-tabs a { border: 1px solid #c9dbd8; border-radius: 999px; color: #0e2a3b; padding: 7px 15px; text-decoration: none; background: #fff; }
    .refund-page .refund-tabs a:hover { border-color: #0e2a3b; }
    .refund-page .refund-tabs a.active { background: #0e2a3b; border-color: #0e2a3b; color: #fff; }

    /* Tabel */
    .refund-page .rf-scroll { overflow-x: auto; }
    .refund-page .rf-table { width: 100%; min-width: 800px; border-collapse: collapse; }
    .refund-page .rf-table th { text-align: left; font-weight: 600; font-size: .85rem; color: #4b6470; padding: 10px 14px; border-bottom: 2px solid #c9dbd8; }
    .refund-page .rf-table td { padding: 14px; border-bottom: 1px solid #e1ecea; vertical-align: top; }
    .refund-page .rf-table tbody tr:last-child td { border-bottom: 0; }
    .refund-page .rf-table tbody tr:hover { background: #f3f8f7; }
    .refund-page .rf-sub { display: block; color: #4b6470; font-size: .85rem; margin-top: 2px; }

    /* Status */
    .refund-page .refund-status { border: 1px solid currentColor; border-radius: 999px; display: inline-block; font-size: .8rem; font-weight: 600; padding: 3px 11px; white-space: nowrap; }
    .refund-page .refund-status.menunggu { color: #8a6200; }
    .refund-page .refund-status.diproses { color: #0b7a75; }
    .refund-page .refund-status.disetujui { background: #0e2a3b; border-color: #0e2a3b; color: #fff; }
    .refund-page .refund-status.berhasil { background: #0e2a3b; border-color: #0e2a3b; color: #fff; }
    .refund-page .refund-status.ditolak { color: #b3261e; }

    .refund-page .refund-amount { display: block; font-size: 1.05rem; font-weight: 700; white-space: nowrap; }

    /* Detail & form */
    .refund-page .refund-details { min-width: 250px; margin-top: 4px; }
    .refund-page .refund-details summary { color: #0b7a75; cursor: pointer; font-weight: 600; }
    .refund-page .rf-panel { padding-top: 10px; }
    .refund-page .rf-panel p { margin-bottom: 4px; }
    .refund-page .rf-label { display: block; font-size: .85rem; margin: 10px 0 4px; }
    .refund-page .rf-input { display: block; width: 100%; min-width: 230px; font: inherit; color: inherit; padding: 8px 10px; border: 1px solid #c9dbd8; border-radius: 6px; background: #fff; margin-bottom: 8px; }
    .refund-page .rf-actions { display: flex; flex-wrap: wrap; gap: 8px; }
    .refund-page .rf-btn { font: inherit; font-size: .875rem; font-weight: 600; padding: 7px 14px; border-radius: 6px; border: 1px solid transparent; cursor: pointer; color: #fff; }
    .refund-page .rf-btn.primary { background: #0b7a75; }
    .refund-page .rf-btn.success { background: #0e2a3b; }
    .refund-page .rf-btn.danger { background: #fff; color: #b3261e; border-color: #b3261e; }
    .refund-page .rf-btn:hover { filter: brightness(1.1); }
    .refund-page a:focus-visible, .refund-page button:focus-visible, .refund-page summary:focus-visible, .refund-page textarea:focus-visible { outline: 3px solid #f2b632; outline-offset: 2px; }

    /* Halaman berikutnya */
    .refund-page .rf-pager { display: flex; justify-content: space-between; align-items: center; margin-top: 16px; }
    .refund-page .rf-pager a { color: #0b7a75; font-weight: 600; }
    .refund-page .rf-muted { color: #4b6470; }

    /* Kosong */
    .refund-page .rf-empty { text-align: center; padding: 48px 16px; }
    .refund-page .rf-empty svg { width: 48px; height: 48px; color: #8aa2ab; }
    .refund-page .rf-empty h2 { font-size: 1.2rem; font-weight: 700; margin: 8px 0 4px; }
    .refund-page .rf-select, .refund-page .rf-field { display: block; width: 100%; min-width: 0; font: inherit; color: inherit; padding: 9px 11px; border: 1px solid #c9dbd8; border-radius: 6px; background: #fff; }
    .refund-page .rf-request-form { display: grid; grid-template-columns: minmax(220px, 2fr) minmax(150px, 1fr) minmax(220px, 2fr) auto; gap: 12px; align-items: end; }
    .refund-page .rf-request-form label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: 5px; }
    .refund-page .rf-request-form button { min-height: 40px; }
    .refund-page .rf-edit-form { display: grid; gap: 8px; min-width: 260px; }
    .refund-page .rf-inline-actions { display: flex; flex-wrap: wrap; gap: 8px; }
    @media (max-width: 767px) { .refund-page { padding: 16px; } .refund-page .rf-request-form { grid-template-columns: 1fr; } }
</style>

<div class="refund-page">
    <div class="rf-hero">
        <div>
            <h1>Pengajuan Refund</h1>
            <p>Tinjau permohonan dan perbarui status pengembalian dana.</p>
        </div>
        <span class="rf-count">{{ $refunds->total() }} pengajuan</span>
    </div>

    @if (session('success'))
        <div class="rf-alert ok" role="status">{{ session('success') }}</div>
    @endif

    @if (session('warning'))
        <div class="rf-alert warning" role="status">{{ session('warning') }}</div>
    @endif

    @if ($errors->any())
        <div class="rf-alert bad" role="alert">{{ $errors->first() }}</div>
    @endif

    <div class="rf-card" style="margin-bottom: 20px">
        <h2 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 6px">Pilih transaksi riwayat</h2>
        <p class="rf-muted" style="margin-bottom: 16px">Pilih transaksi lunas untuk memulai proses refund.</p>
        @if ($eligiblePayments->isNotEmpty())
            <form method="POST" action="{{ route('finance.refund.store') }}" class="rf-request-form">
                @csrf
                <div>
                    <label for="payment_id">Transaksi</label>
                    <select id="payment_id" name="payment_id" class="rf-select" required>
                        <option value="">Pilih transaksi...</option>
                        @foreach ($eligiblePayments as $payment)
                            <option value="{{ $payment->id }}" @selected((string) old('payment_id') === (string) $payment->id)>
                                {{ $payment->booking?->kode_booking ?? 'Pembayaran #'.$payment->id }}
                                — {{ $payment->customer?->nama_pelanggan ?? $payment->booking?->nama_pelanggan ?? 'Pelanggan' }}
                                — Rp{{ number_format((float) $payment->amount, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('payment_id')<small class="rf-sub" style="color:#b3261e">{{ $message }}</small>@enderror
                </div>
                <div>
                    <label for="amount">Nominal refund (Rp)</label>
                    <input id="amount" type="number" name="amount" class="rf-field" min="0.01" step="0.01" value="{{ old('amount') }}" required>
                    @error('amount')<small class="rf-sub" style="color:#b3261e">{{ $message }}</small>@enderror
                </div>
                <div>
                    <label for="reason">Alasan refund</label>
                    <input id="reason" type="text" name="reason" class="rf-field" maxlength="2000" value="{{ old('reason') }}" required>
                    @error('reason')<small class="rf-sub" style="color:#b3261e">{{ $message }}</small>@enderror
                </div>
                <button type="submit" class="rf-btn primary">Lanjutkan proses refund</button>
            </form>
        @else
            <p class="rf-muted">Tidak ada transaksi lunas yang tersedia untuk diajukan refund.</p>
        @endif
    </div>

    <div class="rf-card">
        <nav class="refund-tabs" aria-label="Filter status refund">
            <a href="{{ route('finance.refund') }}"
               class="{{ $status ? '' : 'active' }}"
               @if (! $status) aria-current="page" @endif>Semua</a>
            @foreach (['Menunggu', 'Diproses', 'Disetujui', 'Berhasil', 'Ditolak'] as $filterStatus)
                <a href="{{ route('finance.refund', ['status' => $filterStatus]) }}"
                   class="{{ $status === $filterStatus ? 'active' : '' }}"
                   @if ($status === $filterStatus) aria-current="page" @endif>{{ $filterStatus }}</a>
            @endforeach
        </nav>

        @if ($refunds->isNotEmpty())
            <div class="rf-scroll">
                <table class="rf-table">
                    <thead>
                        <tr>
                            <th scope="col">Pemesanan</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col">Permintaan Refund</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($refunds as $refund)
                            @php
                                $booking = $refund->payment?->booking;
                                $statusClass = strtolower($refund->status);
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $booking?->kode_booking ?? 'Pembayaran #'.$refund->payment_id }}</strong>
                                    <span class="rf-sub">{{ $booking?->nama_pelanggan ?? 'Data pemesan tidak tersedia' }}</span>
                                    @if ($booking?->tanggal_berangkat)
                                        <span class="rf-sub">Berangkat {{ \Carbon\Carbon::parse($booking->tanggal_berangkat)->translatedFormat('d M Y') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>Rp{{ number_format((float) ($refund->payment?->amount ?? 0), 0, ',', '.') }}</strong>
                                    <span class="rf-sub">{{ $refund->payment?->payment_method ?? 'Metode tidak tersedia' }}</span>
                                </td>
                                <td>
                                    <span class="refund-amount">Rp{{ number_format((float) $refund->amount, 0, ',', '.') }}</span>
                                    <details class="refund-details">
                                        <summary>Lihat alasan dan catatan</summary>
                                        <div class="rf-panel">
                                            <p><strong>Alasan:</strong> {{ $refund->reason }}</p>
                                            @if ($refund->notes)
                                                <p><strong>Catatan:</strong> {{ $refund->notes }}</p>
                                            @endif
                                            @if ($refund->processor)
                                                <span class="rf-sub">Diproses oleh {{ $refund->processor->name }}</span>
                                            @endif
                                        </div>
                                    </details>
                                </td>
                                <td>
                                    <span class="refund-status {{ $statusClass }}">{{ $refund->status }}</span>
                                    <span class="rf-sub" style="margin-top:6px">{{ $refund->created_at?->translatedFormat('d M Y, H:i') }}</span>
                                </td>
                                <td>
                                    @if (in_array($refund->status, ['Menunggu', 'Diproses'], true))
                                        <details class="refund-details">
                                            <summary>Edit pengajuan</summary>
                                            <form method="POST" action="{{ route('finance.refund.request.update', $refund) }}" class="rf-edit-form">
                                                @csrf
                                                @method('PUT')
                                                <label class="rf-label" for="edit-amount-{{ $refund->id }}">Nominal refund (maksimal 75% dari pembayaran)</label>
                                                <input id="edit-amount-{{ $refund->id }}" type="number" name="amount" class="rf-input" min="0.01" step="0.01" value="{{ number_format((float) $refund->amount, 2, '.', '') }}" required>
                                                <label class="rf-label" for="edit-reason-{{ $refund->id }}">Alasan refund</label>
                                                <textarea id="edit-reason-{{ $refund->id }}" name="reason" rows="2" maxlength="2000" class="rf-input" required>{{ $refund->reason }}</textarea>
                                                <button type="submit" class="rf-btn primary">Simpan perubahan</button>
                                            </form>
                                        </details>
                                        <form method="POST" action="{{ route('finance.refund.destroy', $refund) }}" class="rf-inline-actions" onsubmit="return confirm('Hapus pengajuan refund ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rf-btn danger">Hapus</button>
                                        </form>
                                        <details class="refund-details">
                                            <summary>Perbarui status</summary>
                                            <form method="POST" action="{{ route('finance.refund.update', $refund) }}">
                                                @csrf
                                                @method('PUT')
                                                <label class="rf-label" for="notes-{{ $refund->id }}">Catatan (opsional)</label>
                                                <textarea id="notes-{{ $refund->id }}" name="notes" rows="2" maxlength="2000" class="rf-input"></textarea>
                                                <div class="rf-actions">
                                                    @if ($refund->status === 'Menunggu')
                                                        <button type="submit" name="status" value="Diproses" class="rf-btn primary">Proses</button>
                                                    @else
                                                        <button type="submit" name="status" value="Disetujui" class="rf-btn success">Setujui &amp; batalkan transaksi</button>
                                                        <button type="submit" name="status" value="Ditolak" class="rf-btn danger"
                                                                onclick="return confirm('Tolak pengajuan refund ini?')">Tolak</button>
                                                    @endif
                                                </div>
                                            </form>
                                        </details>
                                    @else
                                        <span class="rf-muted">Tidak ada tindakan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($refunds->hasPages())
                <div class="rf-pager">
                    @if ($refunds->previousPageUrl())
                        <a href="{{ $refunds->previousPageUrl() }}">Sebelumnya</a>
                    @else
                        <span></span>
                    @endif
                    <span class="rf-muted">Halaman {{ $refunds->currentPage() }} dari {{ $refunds->lastPage() }}</span>
                    @if ($refunds->nextPageUrl())
                        <a href="{{ $refunds->nextPageUrl() }}">Berikutnya</a>
                    @else
                        <span></span>
                    @endif
                </div>
            @endif
        @else
            <div class="rf-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7M3 4v5h5"/><path d="M12 8v8M9.5 10.5c0-1 1-1.5 2.5-1.5s2.5.6 2.5 1.6-1 1.4-2.5 1.6-2.5.6-2.5 1.6 1 1.6 2.5 1.6 2.5-.5 2.5-1.5"/></svg>
                <h2>Belum ada pengajuan refund</h2>
                <p class="rf-muted">
                    @if ($status)
                        Tidak ada pengajuan dengan status {{ strtolower($status) }}.
                    @else
                        Pengajuan refund akan muncul di halaman ini.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
