<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'stok',
        'satuan',
        'lokasi',
    ];

    // Relasi ke BarangMasuk dan BarangKeluar
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang', 'id_barang');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang', 'id_barang');
    }

    public function getStokAktualAttribute()
    {
        return $this->barangMasuk()->sum('jumlah') - $this->barangKeluar()->sum('jumlah');
    }

    // Validasi stok minimum
    public function scopeStokMinimum($query, $minimum = 5)
    {
        return $query->where('stok', '<=', $minimum);
    }
}