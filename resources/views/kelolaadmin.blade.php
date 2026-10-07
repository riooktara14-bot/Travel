@extends('layouts.app')
@section('title', 'Kelola Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Kelola Admin</h3>
            <p class="text-muted mb-0">Kelola seluruh akun administrator sistem.</p>
        </div>
        @unless (auth()->user()->isOwner())
            <button type="button" class="btn btn-primary toggle-form" data-target="admin-form"><i class="mdi mdi-account-plus"></i> Tambah Admin</button>
        @endunless
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @unless (auth()->user()->isOwner())
    <div class="card border-0 shadow-sm mb-4" id="admin-form" style="{{ $errors->any() ? '' : 'display:none;' }}">
        <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">Tambah Admin <button type="button" class="btn-close close-form" data-target="admin-form" aria-label="Tutup"></button></div>
        <div class="card-body">
            <form method="POST" action="{{ route('kelolaadmin.store') }}" class="row g-3">
                @csrf
                <div class="col-md-3"><label class="form-label">Nama</label><input name="name" class="form-control" required></div>
                <div class="col-md-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="col-md-2"><label class="form-label">Password</label><input type="password" name="password" class="form-control" minlength="6" required></div>
                <div class="col-md-2"><label class="form-label">Role</label><select name="role" class="form-select"><option value="admin">Admin</option><option value="finance">Finance</option><option value="super admin">Super Admin</option><option value="owner">Owner</option></select></div>
                <div class="col-md-2"><label class="form-label">Status</label><select name="status" class="form-select"><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option></select></div>
                <div class="col-12"><button class="btn btn-primary"><i class="mdi mdi-content-save"></i> Simpan Admin</button></div>
            </form>
        </div>
    </div>
    @endunless

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4"><div class="card border-0 shadow-sm"><div class="card-body"><small class="text-muted">Total Admin</small><h2 class="fw-bold text-primary">{{ $statistik['total'] }}</h2></div></div></div>
        <div class="col-lg-3 col-md-6 mb-4"><div class="card border-0 shadow-sm"><div class="card-body"><small class="text-muted">Super Admin</small><h2 class="fw-bold text-success">{{ $statistik['super_admin'] }}</h2></div></div></div>
        <div class="col-lg-3 col-md-6 mb-4"><div class="card border-0 shadow-sm"><div class="card-body"><small class="text-muted">Admin Aktif</small><h2 class="fw-bold text-warning">{{ $statistik['aktif'] }}</h2></div></div></div>
        <div class="col-lg-3 col-md-6 mb-4"><div class="card border-0 shadow-sm"><div class="card-body"><small class="text-muted">Nonaktif</small><h2 class="fw-bold text-danger">{{ $statistik['nonaktif'] }}</h2></div></div></div>
    </div>

    <div class="card border-0 shadow">
        <div class="card-header bg-white"><h5 class="mb-0">Daftar Admin dan Finance</h5></div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th><th>Foto</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Login Terakhir</th>@unless (auth()->user()->isOwner())<th>Aksi</th>@endunless
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">{{ strtoupper(substr($admin->name, 0, 1)) }}</div></td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td><span class="badge {{ strtolower((string) $admin->getRawOriginal('role')) === 'super admin' ? 'bg-danger' : 'bg-primary' }}">{{ ucfirst($admin->getRawOriginal('role') ?: $admin->role()->value('nama_peran')) }}</span></td>
                            <td><span class="badge {{ strtolower($admin->status) === 'aktif' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($admin->status) }}</span></td>
                            <td>{{ $admin->last_login_at ? $admin->last_login_at->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i').' WIB' : 'Belum login' }}</td>
                            @unless (auth()->user()->isOwner())
                            <td class="text-nowrap">
                                <details class="d-inline-block">
                                    <summary class="btn btn-warning btn-sm">Edit</summary>
                                    <form method="POST" action="{{ route('kelolaadmin.update', $admin->id) }}" class="mt-2" style="min-width:260px;">
                                        @csrf @method('PUT')
                                        <input name="name" value="{{ $admin->name }}" class="form-control form-control-sm mb-1" required>
                                        <input type="email" name="email" value="{{ $admin->email }}" class="form-control form-control-sm mb-1" required>
                                        <select name="role" class="form-select form-select-sm mb-1"><option value="admin" @selected(strtolower((string) $admin->getRawOriginal('role')) === 'admin')>Admin</option><option value="finance" @selected($admin->isFinance())>Finance</option><option value="super admin" @selected(strtolower((string) $admin->getRawOriginal('role')) === 'super admin')>Super Admin</option><option value="owner" @selected(strtolower((string) $admin->getRawOriginal('role')) === 'owner')>Owner</option></select>
                                        <select name="status" class="form-select form-select-sm mb-1"><option value="aktif" @selected(strtolower($admin->status) === 'aktif')>Aktif</option><option value="nonaktif" @selected(strtolower($admin->status) === 'nonaktif')>Nonaktif</option></select>
                                        <input type="password" name="password" placeholder="Password baru (opsional)" class="form-control form-control-sm mb-1" minlength="6">
                                        <button class="btn btn-primary btn-sm">Simpan</button>
                                    </form>
                                </details>
                                <form method="POST" action="{{ route('kelolaadmin.destroy', $admin->id) }}" class="d-inline" onsubmit="return confirm('Hapus admin ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus</button></form>
                            </td>
                            @endunless
                        </tr>
                    @empty
                        <tr><td colspan="{{ auth()->user()->isOwner() ? 7 : 8 }}" class="text-center text-muted py-4">Belum ada data admin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.toggle-form, .close-form').forEach(function (button) {
        button.addEventListener('click', function () {
            const form = document.getElementById(button.dataset.target);
            form.style.display = form.style.display === 'none' ? '' : 'none';
        });
    });
</script>
@endsection
