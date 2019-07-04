<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{

    protected $table = 'cotizacions';

    protected $fillable=[
        "id",
        "cliente_id",
        "nocotizacion",
        "fechaactual",
        "fechaentrega",
        "totalordenes",
        "totalmanodeobra",
        "totalvarios",
        "totalenvios",
        "totalproyecto",
        "totalneto",
        "correo"
    ];


    // public function varios(){
    //     return $this->hasMany('App\Vario');
    // }

    // public function manodeobras(){
    //     return $this->hasMany('App\Manodeobra');
    // }

    // public function envios(){
    //     return $this->hasMany('App\Envio');
    // }

    public function ordens(){
        return $this->belongsToMany('App\Orden', 'cotizacion_orden');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
