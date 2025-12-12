@extends('layouts.app')

@section('title', 'Tambah Transaksi')
@section('breadcrumb', 'Tambah Transaksi')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Transaksi Baru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-tool">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="tgl_transaksi">
                            <i class="fas fa-calendar mr-1"></i>Tanggal Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" 
                                   class="form-control @error('tgl_transaksi') is-invalid @enderror" 
                                   id="tgl_transaksi" 
                                   name="tgl_transaksi" 
                                   value="{{ old('tgl_transaksi', date('Y-m-d')) }}" 
                                   required>
                            @error('tgl_transaksi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kategori">
                            <i class="fas fa-tag mr-1"></i>Kategori
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            </div>
                            <select class="form-control @error('kategori') is-invalid @enderror" 
                                    id="kategori" 
                                    name="kategori" 
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ old('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($kategoris->count() == 0)
                        <small class="form-text text-danger">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Belum ada kategori. <a href="{{ route('kategori.create') }}">Buat kategori terlebih dahulu</a>
                        </small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-comment mr-1"></i>Keterangan
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            </div>
                            <input type="text" 
                                   class="form-control @error('keterangan') is-invalid @enderror" 
                                   id="keterangan" 
                                   name="keterangan" 
                                   value="{{ old('keterangan') }}" 
                                   placeholder="Masukkan keterangan transaksi"
                                   required>
                            @error('keterangan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_transaksi">
                            <i class="fas fa-exchange-alt mr-1"></i>Jenis Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                            </div>
                            <select class="form-control @error('jenis_transaksi') is-invalid @enderror" 
                                    id="jenis_transaksi" 
                                    name="jenis_transaksi" 
                                    required>
                                <option value="">Pilih Jenis</option>
                                <option value="pemasukan" {{ old('jenis_transaksi') == 'pemasukan' ? 'selected' : '' }}>
                                    Pemasukan
                                </option>
                                <option value="pengeluaran" {{ old('jenis_transaksi') == 'pengeluaran' ? 'selected' : '' }}>
                                    Pengeluaran
                                </option>
                            </select>
                            @error('jenis_transaksi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nominal">
                            <i class="fas fa-money-bill-wave mr-1"></i>Nominal (Rp)
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" 
                                   class="form-control @error('nominal') is-invalid @enderror" 
                                   id="nominal" 
                                   name="nominal" 
                                   value="{{ old('nominal') }}" 
                                   min="0" 
                                   step="0.01" 
                                   placeholder="0"
                                   required>
                            @error('nominal')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle mr-1"></i>Masukkan nominal tanpa tanda titik atau koma (contoh: 100000)
                        </small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-2"></i>Simpan Transaksi
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-default">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

