<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Falta extends Model 
{
    //
    use Sortable, SoftDeletes;
    protected $table = 'faltas';
    protected $fillable=['id','nombre','etiqueta'];
    protected $hidden=[ 'created_at', 'updated_at','deleted_at'];
    public $sortable=['id','nombre', 'etiqueta'];

    
}
