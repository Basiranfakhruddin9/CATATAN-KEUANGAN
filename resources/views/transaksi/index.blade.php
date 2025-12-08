@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi</h3>
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary float-right">Tambah Transaksi</a>
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
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id_transaksi }}</td>
                                    <td>{{ $transaksi->tgl_transaksi->format('d/m/Y') }}</td>
                                    <td>{{ $transaksi->kategoriRelation->nama_kategori ?? 'N/A' }}</td>
                                    <td>{{ $transaksi->keterangan }}</td>
                                    <td>
                                        <span class="badge badge-{{ $transaksi->jenis_transaksi == 'pemasukan' ? 'success' : 'danger' }}">
                                            {{ ucfirst($transaksi->jenis_transaksi) }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-info btn-sm">Lihat</a>
                                        <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data transaksi</td>
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
