<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_kategori',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'kategori', 'id_kategori');
    }
}
