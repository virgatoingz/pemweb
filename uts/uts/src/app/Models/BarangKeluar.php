<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluars';
    protected $primaryKey = 'id_keluar';
    protected $fillable = [
        'id_barang',
        'tanggal_keluar',
        'jumlah',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    protected static function booted()
    {
        static::creating(function ($barangKeluar) {
            $stokTersedia = $barangKeluar->barang->stok;
            
            if ($stokTersedia < $barangKeluar->jumlah) {
                throw new \Exception("Stok tidak mencukupi. Stok tersedia: {$stokTersedia}");
            }
        });

        static::created(function ($barangKeluar) {
            DB::transaction(function () use ($barangKeluar) {
                $barangKeluar->barang->decrement('stok', $barangKeluar->jumlah);
            });
        });

        static::updated(function ($barangKeluar) {
            DB::transaction(function () use ($barangKeluar) {
                $diff = $barangKeluar->getOriginal('jumlah') - $barangKeluar->jumlah;
                $barangKeluar->barang->increment('stok', $diff);
            });
        });

        static::deleted(function ($barangKeluar) {
            DB::transaction(function () use ($barangKeluar) {
                $barangKeluar->barang->increment('stok', $barangKeluar->jumlah);
            });
        });
    }
}