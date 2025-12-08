@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Transaksi</h3>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>ID:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $transaksi->id_transaksi }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Tanggal:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $transaksi->tgl_transaksi->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Kategori:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $transaksi->kategoriRelation->nama_kategori ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Keterangan:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $transaksi->keterangan }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Jenis:</strong>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge badge-{{ $transaksi->jenis_transaksi == 'pemasukan' ? 'success' : 'danger' }}">
                                {{ ucfirst($transaksi->jenis_transaksi) }}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Nominal:</strong>
                        </div>
                        <div class="col-sm-9">
                            Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Dibuat:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $transaksi->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Diupdate:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $transaksi->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
