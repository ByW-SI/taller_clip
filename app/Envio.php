<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{

    protected $table = 'envios';

    protected $fillable=['descripcion',
                         'monto',
                         'direccion',
                         'obra_id',
                        'costo',
                    'total'];

    public function obra(){
        return $this->belongsTo('App\Obra');
    }
}
