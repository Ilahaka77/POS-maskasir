<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $fillable = ['transaksi_id', 'barang_id', 'jumlah', 'harga'];

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
