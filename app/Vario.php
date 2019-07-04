<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vario extends Model
{

    protected $table = 'varios';

    protected $fillable=['descripcion',
                         'monto',
                        'obra_id',
                        'costo',
                    	'total'];

    public function obra(){
        return $this->belongsTo('App\Obra');
    }
}
