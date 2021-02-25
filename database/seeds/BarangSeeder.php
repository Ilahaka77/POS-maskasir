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
                'barcode' => $this->randomNumber(10),
                'nama_barang' => Str::random(10),
                'kategori_id' => rand(1,3),
                'merek' => Str::random(5),
                'stok' => rand(1,99),
                'diskon' => mt_rand(0,100)/100,
                'harga_beli' => rand(100000, 100000000),
                'harga_jual' => rand(100000, 100000000),
            ]
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
