<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $fillable = ['kode_transaksi', 'barang_id', 'jumlah', 'harga'];

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi', 'kode_transaksi');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
