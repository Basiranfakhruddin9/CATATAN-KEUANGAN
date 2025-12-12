@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('breadcrumb', 'Detail Kategori')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Detail Kategori
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kategori.index') }}" class="btn btn-tool">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-hashtag mr-2"></i>ID Kategori:</strong>
                    </div>
                    <div class="col-sm-8">
                        <span class="badge badge-info badge-lg">{{ $kategori->id_kategori }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-tag mr-2"></i>Nama Kategori:</strong>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="mb-0">{{ $kategori->nama_kategori }}</h5>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-calendar-plus mr-2"></i>Dibuat Pada:</strong>
                    </div>
                    <div class="col-sm-8">
                        <i class="far fa-clock mr-1"></i>{{ $kategori->created_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong><i class="fas fa-calendar-edit mr-2"></i>Terakhir Diupdate:</strong>
                    </div>
                    <div class="col-sm-8">
                        <i class="far fa-clock mr-1"></i>{{ $kategori->updated_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-2"></i>Edit Kategori
                </a>
                <a href="{{ route('kategori.index') }}" class="btn btn-default">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
