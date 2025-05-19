<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';
    protected $primaryKey = 'id_masuk';
    protected $fillable = [
        'id_barang',
        'tanggal_masuk',
        'jumlah',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
    
    protected static function booted()
    {
        static::created(function ($barangMasuk) {
            DB::transaction(function () use ($barangMasuk) {
                $barangMasuk->barang->increment('stok', $barangMasuk->jumlah);
            });
        });

        static::updated(function ($barangMasuk) {
            DB::transaction(function () use ($barangMasuk) {
                $diff = $barangMasuk->jumlah - $barangMasuk->getOriginal('jumlah');
                $barangMasuk->barang->increment('stok', $diff);
            });
        });

        static::deleted(function ($barangMasuk) {
            DB::transaction(function () use ($barangMasuk) {
                $barangMasuk->barang->decrement('stok', $barangMasuk->jumlah);
            });
        });
    }
}