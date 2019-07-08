<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $fillable=[
        'seccion',
        'clave',
		'ancho',
        'alto',
        'espesor',
        'medidas',
		'color',
        'tipo',
        // 'descripcion_id',
        'descripcion',
		'proveedor_id',
        'costo',
        'ganancia',
        'precio',
        'provedor_name'
     ];

     // public function descripcion()
     // {
     //     return $this->belongsTo('App\Descripcion','descripcion_id','id');
     // }
     public function proveedor()
     {
         return $this->belongsTo('App\Proveedor','proveedor_id','id');
     }

    public function obras(){
        return $this->belongsToMany('App\Obra', 'material_obra');
    }

}
