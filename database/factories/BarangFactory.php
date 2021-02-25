<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Barang;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Barang::class, function (Faker $faker) {
    return [
        'barcode' => randomNumber(10),
        'nama_barang' => Str::random(10),
        'kategori_id' => rand(1,3),
        'merek' => Str::random(5),
        'stok' => rand(1,99),
        'diskon' => mt_rand(0,100)/100,
        'harga_beli' => rand(100000, 100000000),
        'harga_jual' => rand(100000, 100000000)
    ];
});

function randomNumber($length)
{
    $result = '';

    for($i=0; $i<$length; $i++){
        $result .= mt_rand(0,9);
    }

    return $result;
}