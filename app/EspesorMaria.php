<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class EspesorMaria extends Model
{
    use Sortable, SoftDeletes;
    protected $table = 'espesor_marias';
    protected $fillable=['espesor'];
    protected $hidden=[ 'created_at', 'updated_at','deleted_at'];
    public $sortable=['espesor','created_at'];
}
