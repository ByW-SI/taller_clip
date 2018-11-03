@extends('layouts.cotizacion')
	@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h5>Crear orden:</h5>
                </div>
            </div>
            <div class="card-body">
                @if (session("alert"))
                    <div class="alert alert-{{session("alert")['class']}} alert-dismissible fade show" role="alert">
                       {{session('alert')['message']}}
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                @endif
                <form role="form" method="POST" action="{{$edit ? route('orden.update',['orden'=>$orden]) : route('orden.store')}} ">
                    {{csrf_field()}}
                    @if ($edit)
                        {{method_field('PUT')}}
                    @endif
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Nombre:</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{($edit && $orden) ? $orden->nombre : ""}}">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Fecha:</label>
                            <input type="date" name="fecha" id="nombre" class="form-control" value="{{($edit && $orden) ? $orden->nombre : date('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Número de orden:</label>
                            <input type="number" step="1" name="noorden" id="noorden" class="form-control" value="{{ ($edit && $orden) ? $orden->noorden : ++$preclave}}" readonly>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Número de obras:</label>
                            <input type="number" step="1" min="1" name="noobras" id="noobras" class="form-control" value="{{ ($edit && $orden) ? $orden->noobras : ""}}" onchange="setHTML(this.value)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-sm-3 col-sm-6">
                            <label class="control-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion">{{ ($edit && $orden) ? $orden->descripcion : ""}}</textarea>
                        </div>
                    </div>
                    <div id="obras"></div>
                    <div class="col-sm-12 mt-2 text-center form-group">
                        <button id="submit" type="submit" class="btn btn-success"><strong>Guardar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function setHTML(obras) {
            // body...
            $("#obras").empty();
            for (var i = 0; i < obras; i++) {
                var rowHTML=`
                    <div class="card-header">
                        <h5>Obra ${i+1}</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Nombre de la obra:</label>
                            <select required class="custom-select" id="obra_id${i}" onchange="getObra(this.value,${i})" name="obra_id[]">
                                <option value="">Seleccione su obra</option>
                                @foreach ($obras as $obra)
                                    <option value="{{$obra->id}}">{{$obra->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Alto:</label>
                            <input readonly class="form-control" type="text" id="alto_obra${i}">
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Ancho:</label>
                            <input readonly class="form-control" type="text" id="ancho_obra${i}">
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Profundidad:</label>
                            <input readonly class="form-control" type="text" id="profundidad_obra${i}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Número de piezas:</label>
                            <input readonly class="form-control" type="text" id="nopiezas${i}">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label">Descripción:</label>
                            <textarea readonly id="descripcion_obra${i}" class="form-control"></textarea>
                        </div>
                        <div class="col-sm-5 form-group">
                            <label class="control-label">Materiales</label>
                            <textarea readonly id="materiales_obra${i}" class="form-control"></textarea>
                        </div>
                    </div>
                `;
                console.log(rowHTML);
                $("#obras").append(rowHTML);
            }
        }
        function getObra(obra_id,index){
            $.ajax({
                url:"../getObra/"+obra_id,
                type:"GET",
                success: function(res){
                    console.log(res);
                    obra= res.obra;
                    if(obra){
                        $("#alto_obra"+index).val(obra.alto_obra+" "+obra.unidad_obra);
                        $("#ancho_obra"+index).val(obra.ancho_obra+" "+obra.unidad_obra);
                        $("#profundidad_obra"+index).val(obra.profundidad_obra+" "+obra.unidad_obra);
                        $("#nopiezas"+index).val(obra.nopiezas+" pz(s)");
                        $("#descripcion_obra"+index).val(obra.descripcion_obra);
                        descripcion_material = "";
                        obra.materiales.forEach(function(material){
                            descripcion_material = descripcion_material.concat(`Clave: ${material.clave}, Sección: ${material.seccion}, Descripción: ${material.descripcion} \n`);
                        })
                        // console.log(descripcion_material);

                        $("#materiales_obra"+index).val(descripcion_material)
                    }
                }
            });
        }
    </script>
    @endsection