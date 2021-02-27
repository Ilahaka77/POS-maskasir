<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode_transaksi','kode_member', 'harga_total', 'bayar', 'kembalian', 'diskon','kasir'];
    
    public function detail()
    {
        return $this->hasMany('App\DetailTransaksi');
    }

    public function kasir()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
