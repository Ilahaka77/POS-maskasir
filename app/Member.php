<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['user_id', 'kode_member', 'saldo'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
