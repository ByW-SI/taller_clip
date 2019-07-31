@extends('layouts.cotizacion')
	@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Registrar Material</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session("alert"))
                    {{-- expr --}}
                    {{-- {{dd(session("alert"))}} --}}
                    <div class="alert alert-{{session("alert")['class']}} alert-dismissible fade show" role="alert">
                       {{session('alert')['message']}}
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                @endif
                <form role="form" method="POST" action="{{ $edit ? route('material.update',['material'=>$material]) : route('material.store') }}">
                    {{ csrf_field() }}
                    @if ($edit)
                        {{ method_field('PUT') }}
                        {{-- expr --}}
                    @endif
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Sección:</label>
                            <select required class="custom-select" name="seccion" id="seccion" required>
                                <option value="">---</option>
                                <option value="Maria Luisa" {{($edit && $material->seccion == "Maria Luisa" || "MARIA LUISA") ? "selected" : ""}}>Maria Luisa</option>
                                <option value="Montaje" {{($edit && $material->seccion == "Montaje"||"MONTAJE") ? "selected" : ""}}>Montaje</option>
                                <option value="Marco" {{($edit && $material->seccion == "Marco"||"MARCO") ? "selected" : ""}}>Marco</option>
                                <option value="Protección" {{($edit && $material->seccion == "Protección"||"PROTECCION") ? "selected" : ""}}>Protección</option>
                                <option value="Generales" {{($edit && $material->seccion == "Generales") ? "selected" : ""}}>Generales</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Descripción:</label>
                            <input type="text" name="descripcion" value="{{($edit && $material) ? $material->descripcion : ""}}" id="descripcion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Clave:</label>
                            <input required type="text" name="clave" value="{{($edit && $material) ? $material->clave : ""}}" id="clave" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label id="ancho-label" class="control-label">Ancho:</label>
                            <input required type="number" name="ancho" id="ancho" value="{{($edit && $material) ? $material->ancho : ""}}" class="form-control" step="0.01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label id="alto-label" class="control-label">Alto:</label>
                            <input required type="number" name="alto" id="alto" value="{{($edit && $material) ? $material->alto : ""}}" class="form-control" step="0.01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label id="espesor-label" class="control-label">Espesor:</label>
                            <input required type="number" name="espesor" id="espesor" value="{{($edit && $material) ? $material->espesor : ""}}" class="form-control" step="0.01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Color:</label>
                            <input required type="text" name="color" id="color" value="{{($edit && $material) ? $material->color : ""}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Proveedor:</label>
                            <select class="custom-select" name="proveedor" id="descripcion">
                                <option value="">---</option>
                                    @foreach($provedores as $provedor)
                                        <option value="{{$provedor->id}}" {{($edit && $material->proveedor_id == $provedor->id) ? "selected" : ""}}>{{$provedor->razonsocial ? $provedor->razonsocial : $provedor->nombre." ".$provedor->apellidopaterno." ".$provedor->apellidomaterno }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Costo:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                    <input type="number" step="0.01" value="{{($edit && $material) ? $material->costo : ""}}" class="form-control" name="costo" id="costo" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">MXN</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Precio(metro cuadrado):</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                    <input type="number" step="0.01" class="form-control" name="precio" id="precio" value="{{($edit && $material) ? $material->precio : ""}}" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">MXN</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center form-group">
                        <button id="submit" type="submit" class="btn btn-success"><strong>Guardar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-3">
    <script>
        var precio_pub = 0;
    $(document).ready(function(){

        $('#seccion').change(function(){
            if($(this).val() == 'Marco'){
                $('#alto-label').text('Frente');
                $('#ancho-label').text('Fondo');
                $('#espesor-label').text('Largo');
            }else{
                $('#alto-label').text('Alto');
                $('#ancho-label').text('Ancho');
                $('#espesor-label').text('Espesor');
            }
            
        });

        $("#ganancia").change(function(){
            costo =parseFloat($("#costo").val());
            ganancia_por=parseFloat($("#ganancia").val());
            ganancia = costo*(ganancia_por/100);
            // console.log(ganancia);
            precio_pub = parseFloat(+costo+ +ganancia);
            // console.log(precio_pub);
            $('#precio').val(precio_pub.toFixed(2));
        });
        $("#costo").change(function(){
            costo =parseFloat($("#costo").val());
            ganancia_por=parseFloat($("#ganancia").val());
            ganancia = parseFloat(costo*(ganancia_por/100));
            // console.log(ganancia);
            var precio_pub = +costo+ +ganancia;
            precio_pub = parseFloat(precio_pub);
            console.log(precio_pub.toFixed(2));
            $('#precio').val(precio_pub.toFixed(2));
        })
    });
    </script>
    </div>
    @endsection