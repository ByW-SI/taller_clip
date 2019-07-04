<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manodeobra extends Model
{

    protected $table = 'manodeobras';

    protected $fillable=['descripcion',
                         'monto',
                         'nombre',
                         'puesto',
                         'obra_id',
                         'costo',
                        'total'];

    public function obra(){
        return $this->belongsTo('App\Obra');
    }
}
