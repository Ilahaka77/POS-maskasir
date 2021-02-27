<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $fillable = ['pembelian_id', 'barang_id', 'jumlah', 'harga'];

    public function pembelian()
    {
        return $this->belongsTo('App\Pembelian');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
