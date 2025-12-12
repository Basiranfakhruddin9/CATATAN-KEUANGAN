@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('breadcrumb', 'Tambah Kategori')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tag mr-2"></i>Tambah Kategori Baru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kategori.index') }}" class="btn btn-tool">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kategori">
                            <i class="fas fa-tag mr-1"></i>Nama Kategori
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            </div>
                            <input type="text" 
                                   class="form-control @error('nama_kategori') is-invalid @enderror" 
                                   id="nama_kategori" 
                                   name="nama_kategori" 
                                   value="{{ old('nama_kategori') }}" 
                                   placeholder="Masukkan nama kategori (contoh: Makanan, Transportasi, dll)"
                                   required>
                            @error('nama_kategori')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle mr-1"></i>Kategori digunakan untuk mengelompokkan transaksi keuangan Anda.
                        </small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Kategori
                    </button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-default">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
