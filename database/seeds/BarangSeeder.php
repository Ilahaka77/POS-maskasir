<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('barangs')->insert([
            [
                'barcode' => $this->randomNumber(12),
                'nama_barang' => 'Barang 1',
                'kategori_id' => rand(1,3),
                'merek' => 'Merek 1',
                'stok' => rand(1,99),
                'diskon' => mt_rand(0,100)/100,
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
            [
                'barcode' => $this->randomNumber(12),
                'nama_barang' => 'Barang 2',
                'kategori_id' => rand(1,3),
                'merek' => 'Merek 2',
                'stok' => rand(1,99),
                'diskon' => mt_rand(0,100)/100,
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
            [
                'barcode' => $this->randomNumber(12),
                'nama_barang' => 'Barang 3',
                'kategori_id' => rand(1,3),
                'merek' => 'Merek 3',
                'stok' => rand(1,99),
                'diskon' => mt_rand(0,100)/100,
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
            [
                'barcode' => $this->randomNumber(12),
                'nama_barang' => 'Barang 4',
                'kategori_id' => rand(1,3),
                'merek' => 'Merek 4',
                'stok' => rand(1,99),
                'diskon' => mt_rand(0,100)/100,
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
            [
                'barcode' => $this->randomNumber(12),
                'nama_barang' => 'Barang 5',
                'kategori_id' => rand(1,3),
                'merek' => 'Merek 5',
                'stok' => rand(1,99),
                'diskon' => mt_rand(0,100)/100,
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
        ]);
    }

    public function randomNumber($length)
    {
        $result = '';

        for($i=0; $i<$length; $i++){
            $result .= mt_rand(0,9);
        }

        return $result;
    }
}
