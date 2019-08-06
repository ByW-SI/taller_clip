<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'perfil_id',
        'name',
        'email',
        'password',
        'nombre',
        'appaterno',
        'apmaterno'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function perfil() {
        return $this->belongsTo('App\Perfil');
    }

    public function datosLab() {
        return $this->hasOne('DatosLab\Cliente');
    } 
}

/**
 * Send a password reset email to the user
 */
function sendPasswordResetNotification($token) {
    $this->notify(new MailResetPasswordToken($token));
}