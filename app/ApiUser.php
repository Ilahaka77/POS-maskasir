<?php

namespace App;

use App\Notifications\PasswordResetNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class ApiUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tgl_lahir', 'foto_profil', 'alamat', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship
    public function member()
    {
        return $this->hasOne('App\Member', 'user_id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'kasir');
    }

    //Notification
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }
    public function sendPasswordResetNotification($token)
    {
        
        $this->notify(new PasswordResetNotification($token));
        
    }
}
