<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama_barang', 'barcode', 'kategori_id', 'merek', 'stok', 'diskon', 'harga_beli', 'harga_jual'];

    public function getDiskonAttribute($value)
    {
        return (float) $this->diskon;
    }
}
