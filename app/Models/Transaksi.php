<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tgl_transaksi',
        'kategori',
        'keterangan',
        'jenis_transaksi',
        'nominal',
    ];

    protected $casts = [
        'tgl_transaksi' => 'date',
        'nominal' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kategori');
    }
}
