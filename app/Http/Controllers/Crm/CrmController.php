<?php

namespace App\Http\Controllers\Crm;

use App\ClienteCRM;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrmController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crms = ClienteCrm::select('cliente_id','fecha_cont','fecha_aviso', 'fecha_act', 'hora', 'status', 'comentarios', 'acuerdos', 'observaciones','tipo_cont')->groupBy('cliente_id')->get();
        $clientes=Cliente::orderBy('nombre','desc')->get();
        return view('crm.index', ['crms'    =>$crms,
                                  'clientes'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $crms = ClienteCrm::select('cliente_id','fecha_cont','fecha_aviso', 'fecha_act', 'hora', 'status', 'comentarios', 'acuerdos', 'observaciones','tipo_cont')->groupBy('cliente_id')->get();
        $clientes=Cliente::orderBy('nombre','desc')->get();
        return view('crm.indexall', ['crms'    =>$crms,
                                  'clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $crm = ClienteCRM::create($request->all());
        return redirect()->route('crm.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClienteCRM  $clienteCRM
     * @return \Illuminate\Http\Response
     */
    public function show(ClienteCRM $clienteCRM)
    {
        //
    }

    public function porFecha(Request $request){

        //dd($request->fechaH);
        $crms =   ClienteCRM::whereBetween('fecha_cont', [$request->fechaD,$request->fechaH])->orderBy('fecha_cont','asc')->get();
        $todos=   ClienteCRM::get();
        $clientes=Cliente::orderBy('nombre','desc')->get();

        return view('crm.index',['crms'    =>$crms,
                                 'todos'   =>$todos,
                                 'clientes'=>$clientes]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClienteCRM  $clienteCRM
     * @return \Illuminate\Http\Response
     */
    public function edit(ClienteCRM $clienteCRM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClienteCRM  $clienteCRM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteCRM $clienteCRM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClienteCRM  $clienteCRM
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteCRM $clienteCRM)
    {
        //
    }
}
