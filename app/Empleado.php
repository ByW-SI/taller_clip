<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Empleado extends Model
{
	use Sortable;
    //
    protected $table = 'empleados';

    protected $fillable = ['id',
                           'nombre',
                           'appaterno',
                           'apmaterno',
                           'rfc',
                           'telefono',
                           'movil',
                           'email',
                           'nss',
                           'curp',
                           'infonavit',
                           'fnac',
                           'cp',
                           'calle',
                           'numext',
                           'numint',
                           'colonia',
                           'municipio',
                           'estado',
                           'calles',
                           'referencia'];
    public $sortable = [
    	'identificador','nombre','appaterno','apmaterno','rfc'
    ];

    protected $hidden=[
    	'created_at','updated_at'
    ];
    
    public function datosLaborales(){
        return $this->hasMany('App\EmpleadosDatosLab');
    }
    public function estudios(){
        return $this->hasOne('App\EmpleadosEstudios');
    }
    public function emergencias(){
        return $this->hasOne('App\EmpleadosEmergencias');
    }
    public function vacaciones(){
        return $this->hasMany('App\EmpleadosVacaciones');
    }
    public function faltasAdmin(){
        return $this->hasMany('App\EmpleadosFaltasAdministrativas');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

    /**
     * Scope methods
     */

    public function scopeActivos($query){
        return $query->where('status','activo');
    }

    public function scopeNoUsers($query){
        $users_id = User::whereNotNull('empleado_id')->pluck('empleado_id')->all();
        return $query->whereNotIn('id',$users_id);
    }
    
    public function scopeFindByText($query, $word){
        $columns = Schema::getColumnListing('empleados');
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', "%$word%");
            // echo $query->get();
        }
    }
}
