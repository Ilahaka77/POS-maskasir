<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = ['supplier_id', 'total_bayar'];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function detail()
    {
        return $this->hasMany('App\DetailPembelian', 'pembelian_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($transaksi){
            $transaksi->detail()->delete();
        });
    }
}
