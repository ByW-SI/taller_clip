<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Montaje extends Model
{
    use Sortable, SoftDeletes;
    protected $table = 'montajes';
    protected $fillable=['descripcion',
    					 'clave',
						 'ancho',
                         'alto',
                         'tipo_medidas',
						 'espesor',
						 'color',
						 'proveedor',
						 'precio'];
    protected $hidden=['deleted_at'];
    public $sortable=['clave','created_at'];
}
