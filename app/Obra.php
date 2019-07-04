<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table = "obras";
    protected $fillable = [
        'nombre',
        'nopiezas',
        'alto_obra',
        'ancho_obra',
        'profundidad_obra',
        'unidad_obra',
        'descripcion_obra',
        'precio_obra',
        'ancho_marco',
        'largo_marco',
        'profundidad_marco'
    ];
        
       
    public function materiales(){
        return $this->belongsToMany('App\Material', 'material_obra')->withPivot('cantidad');
    }

    public function ordenes(){
        return $this->belongsToMany('App\Orden', 'obra_orden');
    }

    public function varios(){
        return $this->hasMany('App\Vario');
    }

    public function manodeobras(){
        return $this->hasMany('App\Manodeobra');
    }

    public function envios(){
        return $this->hasMany('App\Envio');
    }

    public function total(){
        $materiales = $this->materiales;
        // return $materiales;
        $total = 0;
        foreach ($materiales as $material) {
            $total = $total +($material->precio *$material->pivot->cantidad);

        }
        $total = $total*$this->nopiezas;

        return $total;
    }
}
