<?php

namespace App\Imports;

use App\Material;
use Maatwebsite\Excel\Concerns\ToModel;

class MaterialImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new Material([
            'seccion'     => $row[0],
            'clave'    => $row[1], 
            'ancho' => $row[2],
            'alto' => $row[3],
            'espesor' => $row[4],
            'tipo_unidad' => $row[5],
            'color' => $row[6],
            'proveedor_name' => $row[7],
            'precio' => $row[8]
        ]);
    }
}
