<?php

namespace App\Http\Controllers\Orden;

use App\Orden;
use App\Obra;
use App\Material;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $preclave = Orden::get()->count();
        $obras = Obra::get();
        $edit=false;
        return view('orden.create', ['edit'=>$edit,'preclave'=>$preclave,'obras'=>$obras]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $orden = Orden::create($request->all());
        for ($i = 0; $i < sizeof($request->obra_id); $i++) {
            $orden->obras()->attach($request->obra_id[$i]);
        }
        $alert = ['message'=>"Orden ".$orden->nombre." registrado", 'class'=>'success'];
        return redirect()->route('orden.create')->with('alert',$alert);
        // $orden = new Orden;
        // $orden->nombre = $request->nombre;
        // $orden->fecha = $request->fecha;
        // $orden->noorden = $request->noorden;
        // $orden->descripcion = $request->descripcion;
        // $orden->noobras = $request->noobras;
        // $orden->save();
        // $materiales = Material::get();
        return view('obra.create',['orden_id'=>$orden->id, 'noabras'=>$orden->nopiezas, 'materiales'=>$materiales]);
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
