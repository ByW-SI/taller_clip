<?php

namespace App\Http\Controllers\Orden;

use App\Orden;
use App\Obra;
use App\Material;
use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Orden::get();
        return view('orden.index', ['ordenes'=>$ordenes]);
    }

    public function buscarporcliente(Request $req){
        $ordenes = Orden::where('cliente_id', $req->cliente_id)->get();
        $cliente = Cliente::where('id', $req->cliente_id)->get();
        return view('orden.ordenporcliente', ['ordenes'=>$ordenes, 'cliente'=>$cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::get();
        $preclave = Orden::get()->count();
        $obras = Obra::get();
        $edit=false;
        return view('orden.create', ['edit'=>$edit,'preclave'=>$preclave,'obras'=>$obras, 'clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return dd($request->all());

        $precio_orden = str_replace(",", "",$request->precio_orden);
        $orden = Orden::create($request->all());
        $orden->ganancia_orden = $request->ganancia_orden;
        $orden->precio_orden = $precio_orden;
        $orden->save();

        for($i = 0; $i < sizeof($request->nombre_obra); $i++){
            $obra = new Obra(['nombre' => $request->nombre_obra[$i],
                              'nopiezas' => $request->nopiezas_obra[$i],
                              'alto_obra' => $request->alto_obra[$i],
                              'ancho_obra' => $request->ancho_obra[$i],
                              'profundidad_obra' => $request->profundidad_obra[$i],
                              'descripcion_obra' => $request->descripcion_obra[$i],
                              'ancho_marco' => $request->ancho_obra_marco[$i],
                              'largo_marco' => $request->alto_obra_marco[$i],
                              'profundidad_marco' => $request->profundidad_obra_marco[$i],
                              'precio_obra' => str_replace(",", "",$request->total_obra[$i]) ]);
            $obra->save();
            
            for($j = 0; $j < sizeof($request->materiales_obra[$i]); $j++){
                $obra->materiales()->attach( $request->materiales_obra[$i][$j] , ['cantidad'=>$request->cantidad_material_obra[$i][$j]]);
            }

            $orden->obras()->attach($obra->id);
            
        }

        
        $alert = ['message'=>"Orden ".$orden->nombre." registrado", 'class'=>'success'];
        return redirect()->route('orden.create')->with('alert',$alert);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
