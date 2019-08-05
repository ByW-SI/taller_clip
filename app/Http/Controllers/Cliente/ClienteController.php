<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert as Alert;
use App\Cliente;
use App\FormaContacto;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::sortable()->paginate(8);
        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formas_contacto = FormaContacto::get();
        return view('clientes.create', compact('formas_contacto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        Alert::success('Cliente creado con éxito', 'Siga agregando información');
        return redirect()->route('clientes.show', ['cliente' => $cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.view', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        Alert::success('Datos actualizados');
        return redirect()->route('clientes.show', ['cliente' => $cliente]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        $cliente->delete();
        return $this->index();
    }

    public function buscar(Request $request){
        $query = $request->input('busqueda');
        //dd($request->inpu('clientes'));
        if (($request->input('clientes') == "true" && $request->input('prospecto') == "true") || (!$request->input('clientes') && !$request->input('prospecto'))) {
            # code...
            $clientes = Cliente::sortable()->where('nombre','LIKE',"%$query%")
        ->orWhere('apellidopaterno','LIKE',"%$query%")
        ->orWhere('apellidomaterno','LIKE',"%$query%")
        ->orWhere('razonsocial','LIKE',"%$query%")
        ->orWhere('rfc','LIKE',"%$query%")
        ->orWhere('mail','LIKE',"%$query%")
        ->get();
        } 
            # code...
        elseif ($request->input('clientes') == "true") {
            # code...
            $clientes = Cliente::sortable()->where('tipo','=','Cliente')
            ->where(function($busqueda) use($query){
                $busqueda->where('nombre','LIKE',"%$query%")
                ->orWhere('apellidopaterno','LIKE',"%$query%")
                ->orWhere('apellidomaterno','LIKE',"%$query%")
                ->orWhere('razonsocial','LIKE',"%$query%")
                ->orWhere('rfc','LIKE',"%$query%")
                ->orWhere('mail','LIKE',"%$query%");
            })->get();
        }
        elseif ($request->input('prospecto') == 'true') {
             # code...
            $clientes = Cliente::sortable()->where('tipo','=','Prospecto')
            ->where(function($busqueda) use($query){
                $busqueda->where('nombre','LIKE',"%$query%")
                ->orWhere('apellidopaterno','LIKE',"%$query%")
                ->orWhere('apellidomaterno','LIKE',"%$query%")
                ->orWhere('razonsocial','LIKE',"%$query%")
                ->orWhere('rfc','LIKE',"%$query%")
                ->orWhere('mail','LIKE',"%$query%");
            })->get();
         } 
         return view('clientes.busqueda',['clientes'=>$clientes]);
    }

    public function getClient(){
        $clientes = Cliente::get();
        return view('precargas.select',['precargas'=>$clientes]);
    }

    public function getDescuentos(Cliente $cliente)
    {
        $descuentos = $cliente->descuentos;
        $correo = $cliente->mail;

        return response()->json(['descuentos'=>$descuentos, 'correo'=>$correo],200);
    }
}
