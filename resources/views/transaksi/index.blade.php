@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('breadcrumb', 'Transaksi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-money-bill-wave mr-2"></i>Daftar Transaksi Keuangan
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i>Tambah Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="transaksiTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th width="12%">Tanggal</th>
                                <th width="15%">Kategori</th>
                                <th>Keterangan</th>
                                <th width="12%">Jenis</th>
                                <th width="15%" class="text-right">Nominal</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $transaksi)
                                <tr>
                                    <td>
                                        <span class="badge badge-secondary">#{{ $transaksi->id }}</span>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $transaksi->tgl_transaksi->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            <i class="fas fa-tag mr-1"></i>{{ $transaksi->kategori->nama_kategori ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($transaksi->keterangan, 40) }}</td>
                                    <td>
                                        @if($transaksi->jenis_transaksi == 'pemasukan')
                                            <span class="badge badge-success">
                                                <i class="fas fa-arrow-up mr-1"></i>Pemasukan
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-arrow-down mr-1"></i>Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <strong class="{{ $transaksi->jenis_transaksi == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                            {{ $transaksi->jenis_transaksi == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('transaksi.show', $transaksi) }}" 
                                               class="btn btn-info btn-sm" 
                                               data-toggle="tooltip" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('transaksi.edit', $transaksi) }}" 
                                               class="btn btn-warning btn-sm" 
                                               data-toggle="tooltip" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transaksi.destroy', $transaksi) }}" 
                                                  method="POST" 
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada transaksi. <a href="{{ route('transaksi.create') }}">Tambah transaksi pertama Anda</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($transaksis->count() > 0)
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted">
                            Menampilkan <strong>{{ $transaksis->count() }}</strong> transaksi
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
