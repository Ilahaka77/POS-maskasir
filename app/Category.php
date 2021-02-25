<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['kategori'];

    protected $hidden = ['created_at', 'updated_at'];

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }

}
