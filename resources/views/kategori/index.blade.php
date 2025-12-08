@extends('layouts.app')

@section('content')
<div class="container fade-in-up">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kategori</h3>
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary float-right">Tambah Kategori</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $kategori)
                                <tr>
                                    <td>{{ $kategori->id_kategori }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-info btn-sm">Lihat</a>
                                        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
