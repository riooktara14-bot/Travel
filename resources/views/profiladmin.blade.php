@extends('layouts.app')
@section('title', auth()->user()->isFinance() ? 'Profil Finance' : 'Profil Admin')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h3 class="fw-bold">👤 Profil {{ auth()->user()->isFinance() ? 'Finance' : 'Admin' }}</h3>
        <p class="text-muted">
            Informasi akun {{ auth()->user()->isFinance() ? 'Finance' : 'administrator' }} TravelGo.
        </p>
    </div>

    <div class="row">

        <!-- Profil -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    @if ($admin->profile_photo_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($admin->profile_photo_path) }}"
                             class="rounded-circle mb-3 object-fit-cover"
                             width="150"
                             height="150"
                             alt="Foto profil {{ $admin->name }}">
                    @else
                        <div class="rounded-circle mb-3 bg-primary text-white d-inline-flex align-items-center justify-content-center fw-bold"
                             style="width:150px;height:150px;font-size:4rem;">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </div>
                    @endif

                    <h4 class="fw-bold">{{ $admin->name }}</h4>

                    <p class="text-muted">{{ ucfirst($admin->getRawOriginal('role') ?: $admin->role?->nama_peran) }}</p>

                </div>

            </div>

        </div>

        <!-- Informasi -->
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        <h5 class="mb-0">Informasi Akun</h5>
                        <button type="button" id="toggle-profile-edit" class="btn btn-outline-primary btn-sm">
                            <i class="mdi mdi-pencil"></i>
                            Ubah Profil
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <form method="POST" action="{{ route(auth()->user()->isFinance() ? 'finance.profil.update' : 'profiladmin.update') }}" enctype="multipart/form-data" class="owner-profile-form">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label>Nama Lengkap</label>

                                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" data-profile-field required disabled>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Email</label>

                                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" data-profile-field required disabled>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Role</label>

                                    <input type="text" class="form-control" value="{{ ucfirst($admin->getRawOriginal('role') ?: $admin->role?->nama_peran) }}" readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Bergabung</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $admin->created_at?->translatedFormat('d F Y') }}"
                                       readonly>

                            </div>

                            <div class="col-md-6 mb-3"><label>Password Baru</label><input type="password" name="password" class="form-control" minlength="6" data-profile-field disabled></div>
                            <div class="col-md-6 mb-3"><label>Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control" minlength="6" data-profile-field disabled></div>

                            <div class="col-md-12 mb-3">
                                <label for="profile_photo">Foto Profil</label>
                                <input type="file" id="profile_photo" name="profile_photo" class="form-control" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" data-profile-field disabled>
                                <small class="text-muted">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                            </div>

                        </div>

                        <div class="text-end">

                            <button type="submit" class="btn btn-success" id="save-profile" disabled>
                                <i class="mdi mdi-content-save"></i>
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>



        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    const editButton = document.getElementById('toggle-profile-edit');
    const saveButton = document.getElementById('save-profile');
    const profileFields = document.querySelectorAll('[data-profile-field]');

    editButton?.addEventListener('click', () => {
        const isEditing = editButton.dataset.editing === 'true';

        profileFields.forEach((field) => {
            field.disabled = isEditing;
        });
        saveButton.disabled = isEditing;
        editButton.dataset.editing = String(!isEditing);
        editButton.innerHTML = isEditing
            ? '<i class="mdi mdi-pencil"></i> Ubah Profil'
            : '<i class="mdi mdi-close"></i> Batal';
    });
</script>
@endpush
