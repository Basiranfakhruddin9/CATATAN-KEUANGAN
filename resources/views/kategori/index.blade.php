@extends('layouts.app')

@section('title', 'Manajemen Kategori')
@section('breadcrumb', 'Kategori')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tags mr-2"></i>Daftar Kategori
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i>Tambah Kategori
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kategoriTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th>Nama Kategori</th>
                                <th width="30%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $kategori)
                                <tr>
                                    <td>
                                        <span class="badge badge-info">{{ $kategori->id_kategori }}</span>
                                    </td>
                                    <td>
                                        <i class="fas fa-tag text-primary mr-2"></i>
                                        <strong>{{ $kategori->nama_kategori }}</strong>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('kategori.show', $kategori) }}" 
                                               class="btn btn-info btn-sm" 
                                               data-toggle="tooltip" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('kategori.edit', $kategori) }}" 
                                               class="btn btn-warning btn-sm" 
                                               data-toggle="tooltip" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('kategori.destroy', $kategori) }}" 
                                                  method="POST" 
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        data-toggle="tooltip" 
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data kategori. <a href="{{ route('kategori.create') }}">Tambah kategori pertama Anda</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($kategoris->count() > 0)
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted">
                            Menampilkan <strong>{{ $kategoris->count() }}</strong> kategori
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
