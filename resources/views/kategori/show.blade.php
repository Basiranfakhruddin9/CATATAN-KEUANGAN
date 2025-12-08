@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Kategori</h3>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>ID:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $kategori->id_kategori }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Nama Kategori:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $kategori->nama_kategori }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Dibuat:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $kategori->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Diupdate:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $kategori->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
