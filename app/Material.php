<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $fillable=[
        'clave',
        'seccion',
		'ancho',
        'alto',
        'espesor',
		'color',
        'tipo',
        'descripcion',
        // 'descripcion_id',
		'proveedor_id',
        'costo',
        'precio',
        'provedor_name',
        'tipo_unidad'
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
