@extends('layouts.app')

@section('title', 'Profile')
@section('breadcrumb', 'Profile')

@section('content')
<div class="row">
    <!-- Profile Photo & Info -->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" 
                         src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? Auth::user()->username) . '&background=667eea&color=fff&size=128' }}" 
                         alt="User profile picture"
                         id="previewFoto"
                         style="width: 128px; height: 128px; object-fit: cover;">
                </div>
                <h3 class="profile-username text-center">{{ Auth::user()->name ?? Auth::user()->username }}</h3>
                <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Total Transaksi</b> <a class="float-right">{{ \App\Models\Transaksi::count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Kategori</b> <a class="float-right">{{ \App\Models\Kategori::count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Saldo</b> <a class="float-right text-success">Rp {{ number_format(\App\Models\Transaksi::where('jenis_transaksi', 'pemasukan')->sum('nominal') - \App\Models\Transaksi::where('jenis_transaksi', 'pengeluaran')->sum('nominal'), 0, ',', '.') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Profile Forms -->
    <div class="col-md-8">
        <!-- Update Profile Information -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-edit mr-2"></i>Informasi Profile
                </h3>
            </div>
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <!-- Photo Upload -->
                    <div class="form-group text-center">
                        <label for="foto_profil">
                            <i class="fas fa-camera mr-1"></i>Foto Profil
                        </label>
                        <div class="custom-file mb-3">
                            <input type="file" 
                                   class="custom-file-input @error('foto_profil') is-invalid @enderror" 
                                   id="foto_profil" 
                                   name="foto_profil"
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            <label class="custom-file-label" for="foto_profil">Pilih foto...</label>
                            @error('foto_profil')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user mr-1"></i>Nama
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', Auth::user()->name ?? Auth::user()->username) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope mr-1"></i>Email
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', Auth::user()->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                    @if (session('status') === 'profile-updated')
                        <span class="ml-2 text-success">
                            <i class="fas fa-check-circle mr-1"></i>Berhasil disimpan!
                        </span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="card card-warning card-outline mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-key mr-2"></i>Ubah Password
                </h3>
            </div>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="current_password">
                            <i class="fas fa-lock mr-1"></i>Password Saat Ini
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" 
                                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock mr-1"></i>Password Baru
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" 
                                   class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                                   id="password" 
                                   name="password">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            <i class="fas fa-lock mr-1"></i>Konfirmasi Password Baru
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key mr-2"></i>Ubah Password
                    </button>
                    @if (session('status') === 'password-updated')
                        <span class="ml-2 text-success">
                            <i class="fas fa-check-circle mr-1"></i>Password berhasil diubah!
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview foto profil
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewFoto').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Update custom file input label
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName || 'Pilih foto...');
        });
    });
</script>
@endpush
