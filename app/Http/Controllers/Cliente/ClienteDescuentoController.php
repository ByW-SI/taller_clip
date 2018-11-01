<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Cliente;
use App\ClienteDescuento;
use App\Http\Controllers\Controller;

class ClienteDescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cliente $cliente)
    {
        if(count($cliente->descuentos) > 0)
            return view('clientes.descuentos.index', ['cliente' => $cliente]);
        return redirect()->route('clientes.descuentos.create', ['cliente' => $cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cliente $cliente)
    {
        return view('clientes.descuentos.create', ['cliente' => $cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cliente $cliente)
    {
        $descuento = new ClienteDescuento($request->all());
        $cliente->entrega()->save($descuento);
        return redirect()->route('clientes.descuentos.index', ['cliente' => $cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClienteDescuento $cliente)
    {
        return view('clientes.descuentos.view', ['cliente' => $cliente->cliente, 'descuento' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClienteDescuento $cliente)
    {
        return view('clientes.descuentos.edit', ['cliente' => $cliente->cliente, 'descuento' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteDescuento $cliente)
    {
        $cliente->update($request->all());
        return redirect()->route('clientes.descuentos.index', ['cliente' => $cliente]);
    }

}
