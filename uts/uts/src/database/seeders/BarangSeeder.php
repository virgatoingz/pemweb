<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Barang::truncate();
        BarangMasuk::truncate();
        BarangKeluar::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Data barang
        $barangData = [
            [
                'kode_barang' => 'BRG-001',
                'nama_barang' => 'Laptop ASUS X441NA',
                'jenis_barang' => 'Elektronik',
                'stok' => 15,
                'satuan' => 'unit',
                'lokasi' => 'Rak A1'
            ],
            [
                'kode_barang' => 'BRG-002',
                'nama_barang' => 'Mouse Wireless Logitech',
                'jenis_barang' => 'Aksesoris',
                'stok' => 30,
                'satuan' => 'pcs',
                'lokasi' => 'Rak B2'
            ],
            [
                'kode_barang' => 'BRG-003',
                'nama_barang' => 'Kabel HDMI 2m',
                'jenis_barang' => 'Kabel',
                'stok' => 50,
                'satuan' => 'pcs',
                'lokasi' => 'Rak C3'
            ],
            [
                'kode_barang' => 'BRG-004',
                'nama_barang' => 'Toner Printer HP 85A',
                'jenis_barang' => 'Peralatan Kantor',
                'stok' => 10,
                'satuan' => 'box',
                'lokasi' => 'Rak D4'
            ],
            [
                'kode_barang' => 'BRG-005',
                'nama_barang' => 'Kertas A4 70gr',
                'jenis_barang' => 'Kertas',
                'stok' => 20,
                'satuan' => 'rim',
                'lokasi' => 'Rak E5'
            ]
        ];

        foreach ($barangData as $data) {
            $barang = Barang::create($data);

            // Buat 3-5 transaksi masuk untuk setiap barang
            $jumlahMasuk = rand(3, 5);
            for ($i = 0; $i < $jumlahMasuk; $i++) {
                BarangMasuk::create([
                    'id_barang' => $barang->id_barang,
                    'tanggal_masuk' => now()->subDays(rand(1, 30)),
                    'jumlah' => rand(5, 20)
                ]);
            }

            // Buat 2-4 transaksi keluar untuk setiap barang
            $jumlahKeluar = rand(2, 4);
            for ($i = 0; $i < $jumlahKeluar; $i++) {
                BarangKeluar::create([
                    'id_barang' => $barang->id_barang,
                    'tanggal_keluar' => now()->subDays(rand(1, 30)),
                    'jumlah' => rand(1, 10)
                ]);
            }
        }

        // Update stok barang berdasarkan transaksi
        $this->updateStokBarang();
    }

    // database/seeders/BarangSeeder.php

    protected function updateStokBarang()
    {
        Barang::chunk(100, function ($barangs) {
            foreach ($barangs as $barang) {
                $totalMasuk = BarangMasuk::where('id_barang', $barang->id_barang)
                    ->sum('jumlah');
                
                $totalKeluar = BarangKeluar::where('id_barang', $barang->id_barang)
                    ->sum('jumlah');
                
                $stokAkhir = $totalMasuk - $totalKeluar;
                
                // Pastikan stok tidak negatif
                $barang->update([
                    'stok' => max(0, $stokAkhir)
                ]);
            }
        });
    }
}