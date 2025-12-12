@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('breadcrumb', 'Detail Transaksi')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Detail Transaksi
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-tool">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-hashtag mr-2"></i>ID Transaksi:</strong>
                    </div>
                    <div class="col-sm-8">
                        <span class="badge badge-secondary badge-lg">#{{ $transaksi->id }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="far fa-calendar-alt mr-2"></i>Tanggal Transaksi:</strong>
                    </div>
                    <div class="col-sm-8">
                        <i class="far fa-clock mr-1"></i>{{ $transaksi->tgl_transaksi->format('d F Y') }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-tag mr-2"></i>Kategori:</strong>
                    </div>
                    <div class="col-sm-8">
                        <span class="badge badge-info">{{ $transaksi->kategori->nama_kategori ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-comment mr-2"></i>Keterangan:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $transaksi->keterangan }}
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-exchange-alt mr-2"></i>Jenis Transaksi:</strong>
                    </div>
                    <div class="col-sm-8">
                        @if($transaksi->jenis_transaksi == 'pemasukan')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-arrow-up mr-1"></i>Pemasukan
                            </span>
                        @else
                            <span class="badge badge-danger badge-lg">
                                <i class="fas fa-arrow-down mr-1"></i>Pengeluaran
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-money-bill-wave mr-2"></i>Nominal:</strong>
                    </div>
                    <div class="col-sm-8">
                        <h4 class="mb-0">
                            <strong class="{{ $transaksi->jenis_transaksi == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                {{ $transaksi->jenis_transaksi == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                            </strong>
                        </h4>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-calendar-plus mr-2"></i>Dibuat Pada:</strong>
                    </div>
                    <div class="col-sm-8">
                        <i class="far fa-clock mr-1"></i>{{ $transaksi->created_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-calendar-edit mr-2"></i>Terakhir Diupdate:</strong>
                    </div>
                    <div class="col-sm-8">
                        <i class="far fa-clock mr-1"></i>{{ $transaksi->updated_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-2"></i>Edit Transaksi
                </a>
                <a href="{{ route('transaksi.index') }}" class="btn btn-default">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
