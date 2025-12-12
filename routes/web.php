<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $transaksis = \App\Models\Transaksi::with('kategori')->latest()->take(5)->get();
    $totalPemasukan = \App\Models\Transaksi::where('jenis_transaksi', 'pemasukan')->sum('nominal');
    $totalPengeluaran = \App\Models\Transaksi::where('jenis_transaksi', 'pengeluaran')->sum('nominal');
    $saldo = $totalPemasukan - $totalPengeluaran;
    $totalTransaksi = \App\Models\Transaksi::count();
    $totalKategori = \App\Models\Kategori::count();
    $pemasukanBulanIni = \App\Models\Transaksi::where('jenis_transaksi', 'pemasukan')
        ->whereMonth('tgl_transaksi', now()->month)
        ->whereYear('tgl_transaksi', now()->year)
        ->sum('nominal');
    $pengeluaranBulanIni = \App\Models\Transaksi::where('jenis_transaksi', 'pengeluaran')
        ->whereMonth('tgl_transaksi', now()->month)
        ->whereYear('tgl_transaksi', now()->year)
        ->sum('nominal');
    
    // Data grafik 6 bulan terakhir
    $grafikData = [];
    $bulanLabels = [];
    $pemasukanBulanan = [];
    $pengeluaranBulanan = [];
    
    for ($i = 5; $i >= 0; $i--) {
        $tanggal = now()->subMonths($i);
        $bulanLabels[] = $tanggal->format('M Y');
        
        $pemasukanBulanan[] = \App\Models\Transaksi::where('jenis_transaksi', 'pemasukan')
            ->whereMonth('tgl_transaksi', $tanggal->month)
            ->whereYear('tgl_transaksi', $tanggal->year)
            ->sum('nominal');
        
        $pengeluaranBulanan[] = \App\Models\Transaksi::where('jenis_transaksi', 'pengeluaran')
            ->whereMonth('tgl_transaksi', $tanggal->month)
            ->whereYear('tgl_transaksi', $tanggal->year)
            ->sum('nominal');
    }
    
    return view('dashboard', compact(
        'transaksis', 
        'totalPemasukan', 
        'totalPengeluaran', 
        'saldo', 
        'totalTransaksi', 
        'totalKategori',
        'pemasukanBulanIni',
        'pengeluaranBulanIni',
        'bulanLabels',
        'pemasukanBulanan',
        'pengeluaranBulanan'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori routes
    Route::resource('kategori', KategoriController::class);

    // Transaksi routes
    Route::resource('transaksi', TransaksiController::class);
});

require __DIR__.'/auth.php';
