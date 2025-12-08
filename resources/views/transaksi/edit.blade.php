@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Transaksi</h3>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.update', $transaksi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="tgl_transaksi">Tanggal Transaksi</label>
                            <input type="date" class="form-control @error('tgl_transaksi') is-invalid @enderror" id="tgl_transaksi" name="tgl_transaksi" value="{{ old('tgl_transaksi', $transaksi->tgl_transaksi->format('Y-m-d')) }}" required>
                            @error('tgl_transaksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ old('kategori', $transaksi->kategori) == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $transaksi->keterangan) }}" required>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_transaksi">Jenis Transaksi</label>
                            <select class="form-control @error('jenis_transaksi') is-invalid @enderror" id="jenis_transaksi" name="jenis_transaksi" required>
                                <option value="">Pilih Jenis</option>
                                <option value="pemasukan" {{ old('jenis_transaksi', $transaksi->jenis_transaksi) == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ old('jenis_transaksi', $transaksi->jenis_transaksi) == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('jenis_transaksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal', $transaksi->nominal) }}" min="0" step="0.01" required>
                            @error('nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
