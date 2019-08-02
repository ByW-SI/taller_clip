@extends('layouts.cotizacion')
@section('content')
<div class="container-fluid">
    {{-- {{dd($cotizaciones)}} --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h5>Cotizaciones</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-1">
                <table class="table table-bordered table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Cliente / Correo</th>
                            <th scope="col">Número de cotización</th>
                            <th scope="col">fecha de creación</th>
                            <th scope="col">Fecha de entrega</th>
                            <th scope="col">Costo proyecto</th>
                            <th scope="col">Ganancia</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotizaciones as $cotizacion)
                            {{-- expr --}}
                            <tr>
                                <td scope="row">{{ ($cotizacion->cliente->tipopersona == "Fisica" ? $cotizacion->cliente->nombre." ".$cotizacion->cliente->apellidopaterno." ".$cotizacion->cliente->apellidomaterno : $cotizacion->cliente->razonsocial ) }} / {{$cotizacion->correo}}</td>
                                <td>{{ $cotizacion->nocotizacion }}</td>
                                <td>{{ $cotizacion->fechaactual}}</td>
                                <td>{{ $cotizacion->fechaentrega}}</td>
                                <td>${{ number_format($cotizacion->totalproyecto,2)}} MXN</td>
                                <td>{{ $cotizacion->ganancianeto ? "$".$cotizacion->ganancianeto." MXN" : "Sin Ganancia"}}</td>
                                <td>${{number_format($cotizacion->totalordenes,2)}}MXN</td>
                                <td>${{number_format($cotizacion->totalneto,2)}}MXN</td>
                                <td><a href="{{ route('cotizacion.show',['cotizacion'=>$cotizacion]) }}" class="btn btn-info btn-sm">Detalle</a>
                                    <a href="{{ url('cotizacion/downloadPDF/'.$cotizacion->id) }}" class="btn btn-secondary btn-sm">PDF</a>
                                    <a href="{{ url('ordentrabajoconvert/'.$cotizacion->id)}}" class="btn btn-success btn-sm">Generar Orden</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection