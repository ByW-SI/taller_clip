<?php

namespace App\Http\Controllers\Cliente;

use App\Cliente;
use App\ContactoCliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cliente = Cliente::find($id);
        $contactos = $cliente->contactos;
        return view('clientes.contactos.index', ['cliente' => $cliente, 'contactos' => $contactos]);
    
    }

    public function busqueda() {
        $contactos = $cliente->contactso;
        return view('cliente.contacto.busqueda', ['cliente'=>$cliente, 'contactos'=>$contactos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.contactos.create', ['cliente' => $cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->contactos()->create($request->all());
        return redirect()->route('clientes.contacto.index', ['cliente' => $cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactoCliente  $contactoCliente
     * @return \Illuminate\Http\Response
     */
    public function show($cliente, $contacto)
    {
        $cliente = Cliente::find($cliente);
        $contacto = ContactoCliente::find($contacto);
        // dd('aqui2');
        return view('clientes.contactos.view', ['cliente' => $cliente, 'contacto' => $contacto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactoCliente  $contactoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit($cliente, $contacto)
    {
        $cliente = Cliente::find($cliente);
        $contacto = ContactoCliente::find($contacto);
        return view('clientes.contactos.edit', ['cliente' => $cliente, 'contacto' => $contacto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactoCliente  $contactoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $proveedor, $contacto)
    {
        $cliente = Cliente::find($cliente);
        $contacto = ContactoCliente::find($contacto);
        $contacto->update($request->all());
        return redirect()->route('clientes.contacto.index', ['cliente' => $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactoCliente  $contactoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente, $contacto)
    {
        $contacto = ContactoCliente::find($contacto);
        $cliente = Cliente::find($cliente);
        $contacto->delete();
        return redirect()->route('clientes.contacto.index', ['cliente' => $cliente]);
    }
}
