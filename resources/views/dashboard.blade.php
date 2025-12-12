@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1">
                <i class="fas fa-arrow-up"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pemasukan</span>
                <span class="info-box-number">
                    Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
                </span>
                <small class="text-muted" style="font-size: 11px; display: block; margin-top: 5px;">
                    <i class="fas fa-calendar mr-1"></i>Bulan ini: Rp {{ number_format($pemasukanBulanIni ?? 0, 0, ',', '.') }}
                </small>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1">
                <i class="fas fa-arrow-down"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pengeluaran</span>
                <span class="info-box-number">
                    Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                </span>
                <small class="text-muted" style="font-size: 11px; display: block; margin-top: 5px;">
                    <i class="fas fa-calendar mr-1"></i>Bulan ini: Rp {{ number_format($pengeluaranBulanIni ?? 0, 0, ',', '.') }}
                </small>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1">
                <i class="fas fa-wallet"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">
                    Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
                </span>
                <small class="text-muted" style="font-size: 11px; display: block; margin-top: 5px;">
                    <i class="fas fa-info-circle mr-1"></i>Pemasukan - Pengeluaran
                </small>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1">
                <i class="fas fa-chart-line"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Transaksi</span>
                <span class="info-box-number">
                    {{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}
                </span>
                <small class="text-muted" style="font-size: 11px; display: block; margin-top: 5px;">
                    <i class="fas fa-tags mr-1"></i>{{ $totalKategori ?? 0 }} Kategori
                </small>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <!-- Grafik Keuangan Bulanan -->
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-area mr-2"></i>Grafik Keuangan 6 Bulan Terakhir
                </h3>
            </div>
            <div class="card-body">
                <canvas id="keuanganChart" style="min-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <!-- Transaksi Terbaru -->
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i>Transaksi Terbaru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye mr-1"></i>Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if(isset($transaksis) && $transaksis->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th class="text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->tgl_transaksi->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $transaksi->kategori->nama_kategori ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>{{ Str::limit($transaksi->keterangan, 30) }}</td>
                                <td>
                                    @if($transaksi->jenis_transaksi == 'pemasukan')
                                        <span class="badge badge-success">Pemasukan</span>
                                    @else
                                        <span class="badge badge-danger">Pengeluaran</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <strong class="{{ $transaksi->jenis_transaksi == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                        {{ $transaksi->jenis_transaksi == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-4 text-center">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada transaksi. <a href="{{ route('transaksi.create') }}">Tambah transaksi pertama Anda</a></p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions & Stats -->
    <div class="col-md-4">
        <!-- Quick Actions -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-2"></i>Aksi Cepat
                </h3>
            </div>
            <div class="card-body">
                <a href="{{ route('transaksi.create') }}" class="btn btn-success btn-block mb-2">
                    <i class="fas fa-plus mr-2"></i>Tambah Transaksi
                </a>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-block mb-2">
                    <i class="fas fa-tag mr-2"></i>Tambah Kategori
                </a>
                <a href="{{ route('transaksi.index') }}" class="btn btn-info btn-block mb-2">
                    <i class="fas fa-list mr-2"></i>Lihat Semua Transaksi
                </a>
                <a href="{{ route('kategori.index') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-tags mr-2"></i>Kelola Kategori
                </a>
            </div>
        </div>

        <!-- Progress -->
        @if(isset($totalPemasukan) && $totalPemasukan > 0)
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-2"></i>Ringkasan
                </h3>
            </div>
            <div class="card-body">
                @php
                    $persenPengeluaran = $totalPemasukan > 0 ? ($totalPengeluaran / $totalPemasukan) * 100 : 0;
                    $persenPemasukan = 100 - $persenPengeluaran;
                @endphp
                <div class="progress-group">
                    Pemasukan
                    <span class="float-right"><b>{{ number_format($persenPemasukan, 1) }}%</b></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: {{ $persenPemasukan }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    Pengeluaran
                    <span class="float-right"><b>{{ number_format($persenPengeluaran, 1) }}%</b></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{ $persenPengeluaran }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('keuanganChart').getContext('2d');
    const keuanganChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($bulanLabels ?? []),
            datasets: [{
                label: 'Pemasukan',
                data: @json($pemasukanBulanan ?? []),
                borderColor: 'rgb(40, 167, 69)',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Pengeluaran',
                data: @json($pengeluaranBulanan ?? []),
                borderColor: 'rgb(220, 53, 69)',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });
</script>
@endpush

