@extends('layouts.cotizacion')
	@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h5>Registrar Obra:</h5>
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
                <form role="form" method="POST" action="{{ $edit ? route('obra.update',['obra'=>$obra]) : route('obra.store') }}">
                    {{csrf_field()}}
                    @if ($edit)
                        {{ method_field('PUT') }}
                    @endif
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">✱Nombre de la obra:</label>
                            <input required type="text" name="nombre" value="{{($edit && $obra) ? $obra->nombre : ""}}" id="nombre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">✱Número de piezas:</label>
                            <input required type="number" step="1" min="1" name="nopiezas" value="{{($edit && $obra) ? $obra->nopiezas : "1"}}" id="nopiezas" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">✱Alto de la obra:</label>
                            <input required type="number" step="0.01" min="0" name="alto_obra" value="{{($edit && $obra) ? $obra->alto_obra : ""}}" id="alto_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">✱Ancho de la obra:</label>
                            <input required type="number" step="0.01" min="0" name="ancho_obra" value="{{($edit && $obra) ? $obra->ancho_obra : ""}}" id="ancho_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">✱Profundidad de la obra:</label>
                            <input required type="number" step="0.01" min="0" name="profundidad_obra" value="{{($edit && $obra) ? $obra->profundidad_obra : ""}}" id="profundidad_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="control-label">Descripción de la obra:</label>
                            <textarea name="descripcion_obra" id="descripcion_obra" class="form-control">{{($edit && $obra) ? $obra->descripcion_obra : ""}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">✱Sección:</label>
                            <select required class="custom-select" id="seccion" required>
                                <option value="">---</option>
                                <option value="Maria Luisa">Maria Luisa</option>
                                <option value="Montaje">Montaje</option>
                                <option value="Marco">Marco</option>
                                <option value="Protección">Protección</option>
                                <option value="Generales">Generales</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">Clave</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Alto</th>
                                    <th scope="col">Ancho</th>
                                    <th scope="col">Profundidad</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Precio Venta</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="listaM"></tbody>
                        </table>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">Clave</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Alto</th>
                                    <th scope="col">Ancho</th>
                                    <th scope="col">Profundidad</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Precio Venta</th>
                                    <th>Cantidad</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="myMaterials"></tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 text-center form-group">
                        <button id="submit" type="submit" class="btn btn-success"><strong>Guardar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#seccion").change(function(){
            seccion = $("#seccion").val();
            $.ajax({
                url: '../buscarMaterial/'+seccion,
                type:"GET",
                success: function(res){
                    $("#listaM").html(res);
                }
            })
        })
        function addMaterial(material){
            console.log(material);
            var rowHTML = 
            `<tr id="row${material.id}">
                <td scope="row">
                    ${material.clave}
                </td>
                <td>${material.descripcion}</td>
                <td>${material.alto} cm</td>
                <td>${material.ancho} cm</td>
                <td>${material.espesor} cm</td>
                <td>${material.color}</td>
                <td>$${material.precio}</td>
                <td>
                    <input type="hidden" name="materiales[]" value="${material.id}">
                    <input required type="number" step="0.01" min="0" name="cantidad[]" value="1" id="profundidad_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </td>
                <td>
                    <div class="row mt-1 mb-1 justify-content-md-center">
                        <a href="#" onclick="removeMaterial('row${material.id}')" class="btn btn-danger remove_button">
                            Eliminar
                        </a>
                    </div>
                </td>
                
            </tr>`;
            $("#myMaterials").append(rowHTML);
        }
        function removeMaterial(id) {
          
            $(`#${id}`).remove();
            // body...
        }
    </script>
    
    @endsection