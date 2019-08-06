<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $fillable = ['modulo_id', 'nombre'];
    // protected $hidden = ['created_at', 'updated_at'];
    // public $sortable = ['id', 'nombre', 'abreviatura'];

    public function modulo(){
        $this->belongsTo('App\Modulo');
    }
}
