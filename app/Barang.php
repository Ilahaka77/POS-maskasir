<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama_barang', 'barcode', 'kategori_id', 'merek', 'stok', 'diskon', 'harga_beli', 'harga_jual'];

    public function kategori()
    {
        return $this->belongsTo('App\Category');
    }

    public function detailPembelian()
    {
        return $this->hasMany('App\DetailPembelian', 'barang_id');
    }
}
