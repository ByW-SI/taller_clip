<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Proveedor extends Model
{
    use Sortable;

    protected $table='proveedores';

    protected $fillable = [
        'id',
        'nombre',
        'apellidopaterno',
        'apellidomaterno',
        'razonsocial',
        'tipopersona',
        'rfc',
        'email',
        'calle',
        'numext',
        'numinter',
        'cp',
        'colonia',
        'municipio',
        'ciudad',
        'estado',
        'calles',
        'referencia'
    ];
    
    public $sortable = ['id', 'nombre','apellidopaterno','apellidomaterno', 'razonsocial', 'email', 'tipopersona'];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function fiscal() {
        return $this->hasOne('App\ProveedorDireccionFiscal');
    }

    public function contactos() {
        return $this->hasMany('App\ContactoProveedor', 'provedor_id');
    }

    public function generales() {
        return $this->hasOne('App\DatosGeneralesProveedor', 'provedor_id');
    }

    public function bancarios() {
        return $this->hasOne('App\DatosBancariosProveedor', 'provedor_id');
    }

    public function materiales() {
        return $this->hasMany('App\Material');
    }
}