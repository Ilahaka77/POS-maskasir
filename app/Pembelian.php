<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = ['kode_pembelian', 'supplier_id', 'total_bayar'];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function detail()
    {
        return $this->hasMany('App\DetailPembelian', 'pembelian_id');
    }
}
