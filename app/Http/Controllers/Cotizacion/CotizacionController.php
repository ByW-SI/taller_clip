<?php

namespace App\Http\Controllers\Cotizacion;

use App\Cotizacion;
use App\Vario;
use App\Manodeobra;
use App\Envio;
use App\Orden;
use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cotizaciones = Cotizacion::get();
        //dd($cotizaciones[0]->ordens);
        return view('cotizacion.index', ['cotizaciones'=>$cotizaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nocotizacion = Cotizacion::count() + 1;
        $ordenes = Orden::get();
        $clientes = Cliente::get();
        $edit=false;
        return view('cotizacion.create',['ordenes'=>$ordenes,'clientes'=>$clientes,'edit'=>$edit, 'nocotizaciones'=>$nocotizacion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request->PDF);
        $cotizacion = Cotizacion::create($request->all());
        // if($request->manodeobrasd){
        //     for($i = 0; $i < sizeof($request->manodeobrasd); $i++){
        //         $cotizacion->manodeobras()->create([
        //             'descripcion'=>$request->manodeobrasd[$i],
        //             'monto'=>$request->manodeobrasm[$i],
        //             'nombre'=>$request->manodeobrasn[$i],
        //             'puesto'=>$request->manodeobrasp[$i],
        //             'costo'=>$request->manodeobrasc[$i],
        //             'total'=>$request->manodeobrast[$i]
        //         ]);
        //     }
        // }
        // if($request->variosm){
        //     for ($i = 0; $i < sizeof($request->variosm) ; $i++) {
        //         $cotizacion->varios()->create([
        //             'descripcion'=>$request->variosd[$i],
        //             'monto'=>$request->variosm[$i],
        //             'costo'=>$request->variosc[$i],
        //             'total'=>$request->variost[$i]
        //         ]);
        //     }
        // }
        // if($request->enviosdi){
        //     for ($i = 0; $i < sizeof($request->enviosdi) ; $i++) {
        //         $cotizacion->envios()->create([
        //             'descripcion'=>$request->enviosd[$i],
        //             'monto'=>$request->enviosm[$i],
        //             'direccion'=>$request->enviosdi[$i],
        //             'costo'=>$request->enviosc[$i],
        //             'total'=>$request->enviost[$i]
        //         ]);
        //     }
        // }
        for ($i = 0; $i < sizeof($request->ordenes) ; $i++) {
            $cotizacion->ordens()->attach($request->ordenes[$i]);
        }
        $alert = ['message'=>"Cotizacion ".$cotizacion->nocotizacion." registrado", 'class'=>'success'];
        if($request->PDF){
            $this->downloadPDF($cotizacion->id);
        }

        return redirect()->route('cotizacion.create')->with('alert',$alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizacion $cotizacion)
    {
        //
        // dd($cotizacion);
        return view('cotizacion.show',['cotizacion'=>$cotizacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }

    public function downloadPDF($id){
      $cotizacion = Cotizacion::find($id);
      //dd($cotizacion->ordens[0]->obras);
      $pdf = PDF::loadView('cotizacion.pdf', compact('cotizacion'));
      return $pdf->download('Cotizacion '.$id.'.pdf');

    }

    // public function storeAndDownloadPDF(Request $request){
    //   $cotizacion = Cotizacion::find($id);
    //   //dd($cotizacion->ordens);
    //   $pdf = PDF::loadView('cotizacion.pdf', compact('cotizacion'));
    //   return $pdf->download('invoice.pdf');

    // }
}
