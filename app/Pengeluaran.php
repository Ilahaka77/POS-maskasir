<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = ['jenis_pengeluaran', 'nominal'];
    
}
