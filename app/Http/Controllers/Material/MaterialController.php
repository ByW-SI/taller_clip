<?php

namespace App\Http\Controllers\Material;

use App\Descripcion;
use App\Http\Controllers\Controller;
use App\Material;
use App\Proveedor;
use App\Imports\MaterialImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert as Alert;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $materiales = Material::get();
        return view('material.index',['materiales'=>$materiales]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit=false;
        $proveedores = Proveedor::get();
        $alert = null;
        return view('material.create', ['edit'=>$edit, 'alert'=>$alert, "provedores"=>$proveedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Material;
        $material->seccion = $request->seccion;
        $material->descripcion = $request->descripcion;
        $material->clave = $request->clave;
        $material->ancho = $request->ancho;
        $material->alto = $request->alto;
        $material->espesor = $request->espesor;
        $material->color = $request->color;
        $material->proveedor_id = $request->proveedor;
        $material->precio = $request->precio;
        $material->costo = $request->costo;
        // ¿por que tipo1?
        $material->tipo = 'tipo1';

        $material->save();
        $alert = ['message'=>"Material ".$material->clave." registrado", 'class'=>'success'];
        return redirect()->route('material.create')->with('alert',$alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
        $edit=true;
        $proveedores = Proveedor::get();
        // dd($material);
        $alert= null;
        return view('material.create', ['edit'=>$edit,'alert'=>$alert, "material"=>$material, "provedores"=>$proveedores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
        $material->seccion = $request->seccion;
        $material->descripcion = $request->descripcion;
        $material->clave = $request->clave;
        $material->ancho = $request->ancho;
        $material->alto = $request->alto;
        $material->espesor = $request->espesor;
        $material->color = $request->color;
        $material->proveedor_id = $request->proveedor;
        $material->precio = $request->precio;
        $material->costo = $request->costo;
        $material->save();
        return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }

    public function buscarMateriales($seccion, $idtabla){
        $materiales = Material::where('seccion',$seccion)->get();
        // dd($materiales);
        return view('material.list',['materiales'=>$materiales, 'idtabla' => $idtabla]);
         $materiales = Material::where('seccion', $req->seccion)->with(['descripcion'])->get();
            return $materiales;
    }

    public function importExportExcel() {
        return view('excel.importar');
    }

    public function guardarExcel(Request $request)
    {
        //Excel::import(new MaterialImport, $request->file('sample_file'));
        //return redirect('/')->with('success', 'All good!');

        // ########
        if($request->hasFile('sample_file')) {
            //$path = $request->file('sample_file')->getPathName();
            //$data = \Excel::load($path, null, null, true, null)->get();
            $data = Excel::toArray(new MaterialImport, request()->file('sample_file'));
            $data = $data[0];
            unset($data[0]);
            if(count($data)) {
                foreach ($data as $row) {
                    $arr = [
                        'seccion' => $row[1],
                        'clave' => $row[2], 
                        'ancho' => $row[3]?$row[3]:0,
                        'alto' => $row[4]?$row[4]:0,
                        'espesor' => $row[5]?$row[5]:0,
                        'tipo_unidad' => $row[6]?$row[6]:"N/A",
                        'color' => $row[7]?$row[7]:"N/A",
                        'provedor_name' => $row[8],
                        'costo' => $row[9]?$row[9]:0,
                        'precio' => $row[9]?$row[9]:0,
                        'created_at' => date('Y-m-d h:m:s'),
                        'updated_at' => date('Y-m-d h:m:s'),
                    ];
                    Material::updateOrCreate($arr);
                }
                if (!empty($arr)) {
                    // dd($arr);
                    Alert::success('Archivo subido correctamente.');
                    return redirect()->back();
                } else
                    return redirect()->back()->with('error', 'Error al subir el archivo.');
            } else
                return redirect()->back()->with('error', 'Error al subir el archivo.');
        } else
            return redirect()->back()->with('error', 'No se subio ningun archivo');
        return redirect()->back()->with('error', 'Error al subir el archivo.');
    }
}
