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
                <form role="form" method="POST" action="{{$edit ? route('orden.update',['orden'=>$orden]) : route('orden.store')}} " id="formroden">
                    {{csrf_field()}}
                    @if ($edit)
                        {{method_field('PUT')}}
                    @endif
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Nombre:</label>
                            <input required class="form-control" type="text" name="nombre" id="nombre" value="{{($edit && $orden) ? $orden->nombre : ""}}">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Fecha:</label>
                            <input type="date" name="fecha" id="nombre" class="form-control" value="{{($edit && $orden) ? $orden->nombre : date('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Número de orden:</label>
                            <input required type="number" step="1" name="noorden" id="noorden" class="form-control" value="{{ ($edit && $orden) ? $orden->noorden : ++$preclave}}" readonly>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="control-label">Número de obras:</label>
                            <input required type="number" step="1" min="1" name="noobras" id="noobras" class="form-control" value="{{ ($edit && $orden) ? $orden->noobras : ""}}" onchange="setHTML(this.value)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="control-label">Cliente:</label>
                            <select required class="form-control" name="cliente_id" id="cliente_id">
                                <option value="">---</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class=" col-sm-6">
                            <label class="control-label">Descripción:</label>
                            <textarea required class="form-control" name="descripcion" id="descripcion">{{ ($edit && $orden) ? $orden->descripcion : ""}}</textarea>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label class="control-label">Precio total de venta:</label>
                            <input required type="text" id="total" name="precio_orden" class="form-control"  readonly="">
                            <input type="hidden" name="ganancia_orden" id="ganancia_orden">
                        </div>
                    </div>
                    <div id="obras">

                    </div>
                    <div class="col-sm-12 mt-2 text-center form-group">
                        <button id="submit" type="submit" class="btn btn-success"><strong>Guardar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var esprimero = true;

        $(document).ready(function() {
            $('#total').val('0');
        });

        function setHTML(obras) {
            //console.log(obras);
            // body...
            $("#obras").empty();
            for (var i = 0; i < obras; i++) {
                var rowHTML=`
                    <div class="card-header mt-5">
                        <h5>Obra ${i+1}</h5>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home${i+1}-tab" data-toggle="tab" href="#home${i+1}" role="tab" aria-controls="home" aria-selected="true">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="profile${i+1}-tab" data-toggle="tab" href="#profile${i+1}" role="tab" aria-controls="profile" aria-selected="false">Materiales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="mano_obra${i+1}-tab" data-toggle="tab" href="#mano_obra${i+1}" role="tab" aria-controls="mano_obra" aria-selected="false">Mano de obra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="varios${i+1}-tab" data-toggle="tab" href="#varios${i+1}" role="tab" aria-controls="varios" aria-selected="false">Varios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="envios${i+1}-tab" data-toggle="tab" href="#envios${i+1}" role="tab" aria-controls="envios" aria-selected="false">Envíos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home${i+1}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Nombre de la obra:</label>
                                    <input required type="text" name="nombre_obra[]" value="{{($edit && $obra) ? $obra->nombre : ""}}" id="nombre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Número de piezas:</label>
                                    <input required type="number" name="nopiezas_obra[]" step="1" min="1"  value="{{($edit && $obra) ? $obra->nopiezas : "1"}}" class="form-control medidas" id="nopiezas${i+1}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" onchange="actualizarPrecioMedidas(${i+1})" required>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Alto de la obra (cm):</label>
                                    <input required type="number" name="alto_obra[]" step="0.01" min="0"  value="{{($edit && $obra) ? $obra->alto_obra : ""}}" id="alto_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Ancho de la obra (cm):</label>
                                    <input required type="number" name="ancho_obra[]" step="0.01" min="0" value="{{($edit && $obra) ? $obra->ancho_obra : ""}}" id="ancho_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Alto marco (cm):</label>
                                    <input required type="number" onchange="cambiarPrecio(0,${i+1})" name="alto_obra_marco[]" step="0.01" min="0" value="0" id="alto_obra_marco${i+1}" class="form-control controladordeprecio medidas">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Ancho marco (cm):</label>
                                    <input required type="number" onchange="cambiarPrecio(0,${i+1})" name="ancho_obra_marco[]" step="0.01" min="0" value="0" id="ancho_obra_marco${i+1}" class="form-control controladordeprecio medidas">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Profundidad marco (cm):</label>
                                    <input required type="number"  onchange="cambiarPrecio(0,${i+1})" name="profundidad_obra_marco[]" step="0.01" min="0" value="0" id="profundidad_obra_marco${i+1}" class="form-control controladordeprecio medidas">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Profundidad de la obra:</label>
                                    <input required type="number" name="profundidad_obra[]" step="0.01" min="0" value="{{($edit && $obra) ? $obra->profundidad_obra : "0"}}" id="profundidad_obra" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <input type="hidden" class="costomaterial" id="ganancia_obra${i+1}" value="0">
                                    <label class="control-label">Precio por medidas:</label>
                                    <input readonly value="0" class="form-control totalO" type="text" name="total_obra[]" id="total_obra${i+1}"  min="0">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <input type="hidden" class="totals_manodeobra" value="0">
                                    <label class="control-label">Total Mano de Obra ${i+1}:</label>
                                    <input readonly value="0" class="form-control totalMO" type="text" name="total_manodeobra[]" id="total_manodeobra${i+1}"  min="0">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <input type="hidden" class="totals_varios" value="0">
                                    <label class="control-label">Total Varios ${i+1}:</label>
                                    <input readonly value="0" class="form-control totalV" type="text" name="totals_varios[]" id="totals_varios${i+1}"  min="0">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <input type="hidden" class="totals_envio" value="0">
                                    <label class="control-label">Total Envíos ${i+1}:</label>
                                    <input readonly value="0" class="form-control totalE" type="text" name="totals_envio[]" id="totals_envio${i+1}"  min="0">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <input type="hidden" class="totals_obra" value="0">
                                    <label class="control-label">Total Obra ${i+1}:</label>
                                    <input readonly value="0" class="form-control totalObra" type="text" name="totals_obra[]" id="totals_obra${i+1}"  min="0">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label">Descripción de la obra:</label>
                                    <textarea required name="descripcion_obra[]" id="descripcion_obra" class="form-control">{{($edit && $obra) ? $obra->descripcion_obra : ""}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile${i+1}" role="tabpanel" aria-labelledby="profile${i+1}-tab">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label class="control-label">Buscar material:</label>
                                    <select required class="custom-select seccion2" id="seccion${i+1}" required onchange="agregarATabla(this.id)">
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
                                <h3>Resultados de búsqueda</h3>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-info">
                                            <th scope="col">Clave</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Alto</th>
                                            <th scope="col">Ancho</th>
                                            <th scope="col">Profundidad</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Precio metro cuadrado</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="listaM" id="listaM${i+1}"></tbody>
                                </table>
                            </div>
                            <div class="row">
                                <h3>Materiales de la obra ${i+1}</h3>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-info">
                                            <th scope="col">Clave</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Alto</th>
                                            <th scope="col">Ancho</th>
                                            <th scope="col">Profundidad</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Precio metro cuadrado</th>
                                            <th>Cantidad</th>
                                            <th>Precio de acuerdo a medidas</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myMaterials${i+1}"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="mano_obra${i+1}" role="tabpanel" aria-labelledby="mano_obra${i+1}-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Mano de obra:</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="smanodeobra">
                                        <div class="col-4 form-group">
                                            <label class="control-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombremanodeobra">
                                        </div>
                                        <div class="col-4 form-group">
                                            <label class="control-label">Descripción:</label>
                                            <textarea type="text" class="form-control"
                                                id="desmanodeobra"></textarea>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label class="control-label">Puesto:</label>
                                            <input type="text" class="form-control" id="puestomanodeobra">
                                        </div>
                                        <div class="col-4 form-group">
                                            <label class="control-label">Venta</label>
                                            <input type="number" step="0.01" step="0.01" class="form-control"
                                                id="montomanodeobra">
                                        </div>
                                        <div class="col-4 form-group">
                                            <label class="control-label">Costo</label>
                                            <input type="number" step="0.01" step="0.01" class="form-control"
                                                id="costomanodeobra">
                                        </div>
                                        <div class="col-4 form-group pt-4 text-center">
                                            <button type="button" class="btn btn-primary agregarmanodeobra" id="btn-mo-${i+1}">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Puesto</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Venta</th>
                                                    <th scope="col">Costo</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablamanodeobras${i+1}">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="totalmanodeobra">Suma mano de obra</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input readonly type="number" step="0.01" class="form-control"
                                                    id="totalmanodeobra" value="0.0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="descmano">Descuento mano obra</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" value="0" step="0.01" class="form-control descuento_manodeobra" onchange="calcular()"
                                                    id="descuento_manodeobra">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="ganancia_manodeobra">Ganancia mano obra</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" value="0" step="0.01" class="form-control ganancia_manodeobra" onchange="calcular()"
                                                    id="ganancia_manodeobra">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="varios${i+1}" role="tabpanel" aria-labelledby="varios${i+1}-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Varios:</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="svarios">
                                        <div class="col-3 form-group">
                                            <label class="control-label">Descripción:</label>
                                            <input type="text" class="form-control" id="desvario">
                                        </div>
                                        <div class="col-3 form-group">
                                            <label class="control-label">Venta:</label>
                                            <input type="number" step="0.01" class="form-control" id="montovario">
                                        </div>
                                        <div class="col-3 form-group">
                                            <label class="control-label">Costo:</label>
                                            <input type="number" step="0.01" class="form-control" id="costovario">
                                        </div>
                                        <div class="col-3 form-group">
                                            <button id="btn-v-${i+1}" type="button"
                                                class="mt-4 btn btn-primary agregarvario">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <table class="table  table-striped table-bordered">
                                            <thead class="table-info">
                                                <tr>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Venta</th>
                                                    <th scope="col">Costo</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablavarios">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="totlavario">Suma varios</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input readonly type="number" step="0.01" class="form-control"
                                                    id="totalvarios">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="desvario">Descuento Varios</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" value="0" step="0.01" class="form-control descuento_varios" onchange="calcular()"
                                                    id="descuento_varios">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="ganancia_varios">Ganancia Varios</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" value="0" step="0.01" class="form-control ganancia_varios" onchange="calcular()"
                                                    id="ganancia_varios">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="envios${i+1}" role="tabpanel" aria-labelledby="envios${i+1}-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Envios:</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="renvios">
                                        <div class="col-3 form-group">
                                            <label class="control-label">Descripción:</label>
                                            <input type="text" class="form-control" id="desenvio">
                                        </div>
                                        <div class="col-3 form-group">
                                            <label class="control-label">Venta:</label>
                                            <input type="number" step="0.01" class="form-control" id="montoenvio">
                                        </div>
                                        <div class="col-3 form-group">
                                            <label class="control-label">Costo:</label>
                                            <input type="number" step="0.01" class="form-control" id="costoenvio">
                                        </div>
                                        <div class="col-3 form-group">
                                            <label class="control-label">Dirección:</label>
                                            <textarea class="form-control" id="direccionenvio" rows="3"></textarea>
                                        </div>
                                        <div class="col-3 form-group">
                                            <button id="btn-e-${i+1}" type="button" class="mt-4 btn btn-primary agregarenvio">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped table-bordered">
                                            <thead class="table-info">
                                                <tr>
                                                    <th scope="col">Dirección</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Venta</th>
                                                    <th scope="col">Costo</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaenvios">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="totalenvio">Suma envíos</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input readonly type="number" step="0.01" class="form-control"
                                                    id="totalenvios">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="descenvio">Descuento Envios</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" value="0" step="0.01" class="form-control descuento_envios" onchange="calcular()"
                                                    id="descuento_envios">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="ganancia_envios">Ganancia Envios</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" value="0" step="0.01" class="form-control ganancia_envios" onchange="calcular()"
                                                    id="ganancia_envios">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                `;
                
                $("#obras").append(rowHTML);
                $('#total').val('0');
                
            }
            
        }

        $(document).on('change', '.medidas', function(event) {
            let obra_id = parseInt($(this).prop('id').replace(/[a-z_]+/, ""));
            let links = $(this).parents('div#obras').find('ul#myTab').eq(obra_id-1).children('li').children();
            //console.log($('#nopiezas'+obra_id).val());
            if ($('#alto_obra_marco'+obra_id).val() != '0' && $('#ancho_obra_marco'+obra_id).val() != '0' ) {
                let clase = $(links[1]).prop('class');
                clase = clase.replace("disabled", "");
                $(links[1]).prop('class', clase);
            }
        });

        function agregarATabla(id){
            $.ajax({
                url: '../buscarMaterial/'+$('#'+id).val() + '/'+ id.replace('seccion',''),
                type:"GET",
                success: function(res){
                    $("#listaM" + id.replace('seccion','')).html(res);
                },
                error: function(){
                }
            })

        }
        function getObra(obra_id,index){
            $.ajax({
                url:"../getObra/"+obra_id,
                type:"GET",
                success: function(res){
                    obra= res.obra;
                    if(obra){
                        $("#alto_obra"+index).val(obra.alto_obra+" cm");
                        $("#ancho_obra"+index).val(obra.ancho_obra+" cm");
                        $("#profundidad_obra"+index).val(obra.profundidad_obra+" cm");
                        $("#nopiezas"+index).val(obra.nopiezas+" pz(s)");
                        $("#precio_obra"+index).val("$"+obra.precio_obra+"MXN");
                        $("#descripcion_obra"+index).val(obra.descripcion_obra);
                        descripcion_material = "";
                        obra.materiales.forEach(function(material){
                            descripcion_material = descripcion_material.concat(`Clave: ${material.clave}, Sección: ${material.seccion}, Descripción: ${material.descripcion} \n`);
                        })
                        $("#materiales_obra"+index).val(descripcion_material);
                    }
                }
            });
        }
    
           

        function addMaterial(material, id){
            var ancho_marco = parseFloat($('#ancho_obra_marco' + id).val()) / 100;
            var alto_marco = parseFloat($('#alto_obra_marco' + id).val()) / 100;
            //var profundidad_marco = parseFloat($('#profundidad_obra_marco' + id).val());
            /*if (profundidad_marco != 0) {
                var volumen = (ancho_marco * alto_marco * profundidad_marco);
            }
            else{*/
            //}
            if (material.seccion == "MARCO"){
                var volumen = ((ancho_marco * 2) + (alto_marco*2));
            }
            else
                var volumen = (ancho_marco * alto_marco);
            var rowHTML = 
            `<tr id="row${material.id}">
                <td scope="row">
                    ${material.clave}
                </td>
                <td>${material.seccion}</td>
                <td>${material.alto} cm</td>
                <td>${material.ancho} cm</td>
                <td>${material.espesor} cm</td>
                <td>${material.color}</td>
                <td class="precioporm2">$${new Intl.NumberFormat('es-MX').format(material.precio)}</td>
                <td>
                    <input type="hidden" class="costo${id}" value="${material.costo}">
                    <input type="hidden" name="materiales_obra[` +  (id - 1 ) + `][]" value="${material.id}">
                    <input required type="number" step="1" min="0" name="cantidad_material_obra[` +  (id-1 ) + `][]" value="1" id="cantidad_material" class="form-control cant_input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required onchange="actualizarPrecioMedidas(${id})">
                </td>
                <td class="precioFmaterial">$`+new Intl.NumberFormat('es-MX').format((volumen * material.precio))+`</td>
                <td>
                    <div class="row mt-1 mb-1 justify-content-md-center">
                        <a href="#/" onclick="removeMaterial('row${material.id}')" class="btn btn-danger remove_button">
                            Eliminar
                        </a>
                    </div>
                </td>
                
            </tr>`;
            $("#myMaterials" + id).append(rowHTML);
            console.log('material.costo: ' + material.costo);
            cambiarPrecio(material.precio, id, material.costo, material);

            // para habilitar la mano de obra, varios y envio
            let links = $('ul#myTab').eq(id-1).children('li').children();
            let clase = $(links[2]).prop('class');
            clase = clase.replace("disabled", "");
            $(links[2]).prop('class', clase);
            $(links[3]).prop('class', clase);
            $(links[4]).prop('class', clase);
            //alert(id);
            calcularObraTotal(id);
        }
        
        function removeMaterial(id) {
            var cantaquitar = parseFloat($('#'+id).find('td.precioporm2').text().replace(/(\$|,)+/g,''));
            //Obtenemos el td donde se encuantra el costo del material
            var celda = $('#'+id).find('td')[7];

            //obtenemos el costo del material en float
            celda = parseFloat(celda.children[0].value);
            
            console.log('cantidad a quitar: ' + cantaquitar);
            var obra = $('#'+id).parent().attr('id').replace('myMaterials','');
            console.log('obra: ' + obra);
            //alert('cantidad a quitar:\n' + cantaquitar + '\nid obra:\n' + obra);
            cambiarPrecio(-cantaquitar, obra, -celda);
            $(`#${id}`).remove();
            calcularObraTotal(obra);
        }

        function cambiarPrecio(preciom2, obra_id, costo_material, material=1){
            var ancho_marco = parseFloat($('#ancho_obra_marco' + obra_id).val()) / 100;
            var alto_marco = parseFloat($('#alto_obra_marco' + obra_id).val()) / 100;
            //var profundidad_marco = parseFloat($('#profundidad_obra_marco' + obra_id).val()) / 100;
            var cantidad_material = 0;

            for (var i = 0; i < $('.cant_input').length; i++) {
                var num_obra = $('.cant_input').eq(i).attr('name').replace('cantidad_material_obra\[', '').replace(/\]\[\]/, '').replace(',', '');
                var precio_m2 = parseFloat($('.cant_input')[i].parentElement.parentElement.children[6].innerHTML.replace(/(\$|,)+/g, ''));
                //var costomaterial = $('#costo' + obra_id).val();

                if (obra_id-1 == num_obra && precio_m2 == Math.abs(preciom2)) {
                    cantidad_material = parseInt($('.cant_input')[i].value);
                }
            }

            /*if (profundidad_marco != 0) {
                var volumen = (ancho_marco * alto_marco * profundidad_marco);
            }
            else{*/
            //}
            if (material != 1 &&  material.seccion == "MARCO"){
                var volumen = ((ancho_marco * 2) + (alto_marco*2));
            }
            else
                var volumen = (ancho_marco * alto_marco);

            var temp = volumen *preciom2 * cantidad_material;
            var ganaciamaterial = 0.0;
            if (!isNaN(costo_material)) 
                 ganaciamaterial = volumen *costo_material * cantidad_material;
            //console.log('ganaciamaterial: ' + ganaciamaterial);
            //console.log('ganancia_obra: ' + $('#ganancia_obra' + obra_id).val());
            $('#ganancia_obra' + obra_id).val(parseFloat($('#ganancia_obra' + obra_id).val()) + ganaciamaterial);
            console.log('temp: ' + temp);
            var valor =  parseFloat($('#total_obra'+obra_id).val().replace(',', '')) + (temp);
            var valor_anterior = parseFloat($('#total_obra'+obra_id).val().replace(',', ''));
            var precio_total = parseFloat($('#total').val().replace(',', ''));
            if (valor > 0.5){
                valor *= $('#nopiezas' + obra_id).val();
                precio_total -= valor_anterior;
                $('#total_obra'+obra_id).val(new Intl.NumberFormat('es-MX').format(valor));
                precio_total += valor;

                $('#total').val(new Intl.NumberFormat('es-MX').format(precio_total));
            }else{
                $('#total_obra'+obra_id).val(0);
                precio_total += (temp);
                if (precio_total < 0.5) 
                    $('#total').val('0');
                else
                    $('#total').val(new Intl.NumberFormat('es-MX').format(precio_total));
            }

            // ######### Calcular ganancia de acuerdo al material
            let ganancia_orden = 0.0;
            $('.costomaterial').each(function() {
                ganancia_orden += parseFloat($(this).val());
            });
            $('#ganancia_orden').val(ganancia_orden.toString());

            
        }

        function actualizarPrecioMedidas(obra_id) {
            //console.log('obraid  ' + obra_id);
            var total_obra = 0;
            for (var i = 0; i < $('.cant_input').length; i++) {
                var num_obra = $('.cant_input').eq(i).attr('name').replace('cantidad_material_obra\[', '').replace(/\]\[\]/, '').replace(',', '');
                if (obra_id-1 == num_obra) {
                    var precio_m2 = parseFloat($('.cant_input')[i].parentElement.parentElement.children[6].innerHTML.replace(/(\$|,)+/g, ''));
                    var cantidad_material = parseInt($('.cant_input')[i].value);
                    var ancho_marco = parseFloat($('#ancho_obra_marco' + obra_id).val()) / 100;
                    var alto_marco = parseFloat($('#alto_obra_marco' + obra_id).val()) / 100;
                    var seccion = $('.cant_input').eq(i).parents('tr').children().eq(1).text();
                    //var profundidad_marco = parseFloat($('#profundidad_obra_marco' + obra_id).val()) / 100;

                    /*if (profundidad_marco != 0) {
                        var volumen = (ancho_marco * alto_marco * profundidad_marco);
                    }
                    else{*/
                    //}
                    console.log(seccion);
                    if (seccion == "MARCO")
                        var volumen = ((ancho_marco * 2) + (alto_marco*2));
                    else
                        var volumen = (ancho_marco * alto_marco);

                    total_obra += (precio_m2 * cantidad_material * volumen );
                    let precioMaterial = (precio_m2 * cantidad_material * volumen).toFixed(4);
                    precioMaterial = new Intl.NumberFormat('es-MX').format(parseFloat(precioMaterial));
                    $('.precioFmaterial').eq(i).text('$' + precioMaterial);
                }
            }
            total_obra *= $('#nopiezas' + obra_id).val();

            $('#total_obra' + obra_id).val(new Intl.NumberFormat('es-MX').format(total_obra));
            var total_orden = 0;
            //console.log($('.totalO'));
            for (var i = 0; i < $('.totalO').length; i++) {
                //console.log('totalO' + i + '  ' + $('.totalO').eq(i).val());
                //console.log('total_orden ' + total_orden);
                total_orden += parseFloat($('.totalO').eq(i).val().replace(',', ''));
                //console.log('total_orden ' + total_orden);
            }

            total_MO = 0.0;
            $('.totalMO').each(function(index, el) {
                total_MO += parseFloat($(el).val());
            });
            //console.log(total_MO);

            total_V = 0.0;
            $('.totalV').each(function(index, el) {
                total_V += parseFloat($(el).val());
            });
            //console.log(total_V);

            total_E = 0.0;
            $('.totalE').each(function(index, el) {
                total_E += parseFloat($(el).val());
            });
            //console.log(total_E);
            total_orden += total_MO + total_V + total_E;

            $('#total').val(new Intl.NumberFormat('es-MX').format(total_orden));

            calcularObraTotal(obra_id);
        }

        /*
        ******SCRIPTS PARA MANO DE OBRA, VARIOS Y ENVIOS ******
        */
        let contador = 0;
        $(document).on('click', '.agregarmanodeobra', function () {
            let totalmo = 0.00;
            let obra_id = $(this).prop('id').split("-")[2];
            //Se obtiene todo el card para acceder a los elementos de las pestañas en una obra dada por obra_id
            let card = $(this).parents('div#mano_obra' + obra_id + ' div.card');

            let inputs = card.children('div.card-body').find('input');
            let descripcion = card.children('div.card-body').find('textarea');
            let totales = card.children('div.card-footer').find('input');
            let row_totales = $(this).parents('div#myTabContent').children('div#home'+obra_id).children().eq(2);
            //-** Campos usados para los calculos y la visualizacion del usuario
            let input_total_mano_hidden = row_totales.find('input.totals_manodeobra');
            let input_total_mano = $('#total_manodeobra'+obra_id);
            
            
            //-** Fin campos
            
            contador++
            if (!inputs.eq(0).val() || !inputs.eq(1).val() || !inputs.eq(2).val() || !inputs.eq(3).val() || !descripcion.val()) {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ingresa todos los datos de mano de obra!'
                });
                return 0;
            }
            let total = parseFloat(inputs.eq(2).val());// - parseFloat($('#costomanodeobra').val());
            var ht = '<tr id="algo' + contador + '"><td> <input type="hidden" form="formroden" name="manodeobrasn['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(0).val() + '"> ' + inputs.eq(0).val() + '</td>' +
                ' <td><input type="hidden" form="formroden" name="manodeobrasp['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(1).val() + '" >' + inputs.eq(1).val() + '</td>' +
                '<td><input type="hidden" form="formroden" name="manodeobrasd['+(parseInt(obra_id) - 1)+'][]" value="' + $('#desmanodeobra').val() + '"> ' + $('#desmanodeobra').val() + '</td>' +
                '<td class="montomanodeobra"> <input type="hidden" form="formroden" name="manodeobrasm['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(2).val() + '">' + inputs.eq(2).val() +
                '<td><input type="hidden" form="formroden" name="manodeobrasc['+(parseInt(obra_id) - 1)+'][]" class="costos_manodeobra" value="' + inputs.eq(3).val() + '"> ' + inputs.eq(3).val() + '</td>' +
                '<td><input type="hidden" form="formroden" name="manodeobrast['+(parseInt(obra_id) - 1)+'][]" class="totals_manodeobra" value="' + total + '"> ' + total + '</td>' +
                '<td><button class="btn btn-danger" id="btn-elim-mo-'+obra_id+'" type="button" onclick="removeManoO(' + "'algo" + contador + "'" + ',' + inputs.eq(2).val() + ')">Eliminar</button></td></tr>';
            card.find('tbody#tablamanodeobras'+obra_id).append(ht);
            card.find('tbody#tablamanodeobras'+obra_id+ ' tr').each(function(index, el) {
                totalmo = +totalmo + +parseFloat($(el).find('.montomanodeobra input').val());
            });

            totales.eq(0).val((totalmo.toFixed(2)));
            calcularSumaMO(totales.eq(0));
            input_total_mano_hidden.val(totalmo.toFixed(2));
            input_total_mano.val(totalmo.toFixed(2));
            actualizarPrecioMedidas(obra_id);
            
        });

        function removeManoO(id, precio) {
            let obra_id = $('#'+ id).find('button').prop('id').split("-")[3];
            let card = $('#'+ id).find('button').parents('div#mano_obra' + obra_id + ' div.card');
            let total = card.children('div.card-footer').find('input').eq(0);
            let row_totales = $('#'+ id).find('button').parents('div#myTabContent').children('div#home'+obra_id).children().eq(2);
            let input_total_mano_hidden = row_totales.find('input.totals_manodeobra');
            let input_total_mano = $('#total_manodeobra'+obra_id);
            let totalmo = 0.0;

            card.find('tbody#tablamanodeobras'+obra_id+ ' tr').each(function(index, el) {
                totalmo = +totalmo + +parseFloat($(el).find('.montomanodeobra input').val());
            });
            totalmo = +totalmo + -precio;
            total.val(totalmo.toFixed(2));
            input_total_mano_hidden.val(totalmo.toFixed(2));
            input_total_mano.val(totalmo.toFixed(2));
            $(`#${id}`).remove();
            calcularSumaMO(total.eq(0));
            actualizarPrecioMedidas(obra_id);
            //calcular()
        }

        $(document).on('click', '.agregarvario', function () {
            contador++
            let totalva = 0.00;
            let obra_id = $(this).prop('id').split("-")[2];
            //Se obtiene todo el card para acceder a los elementos de las pestañas en una obra dada por obra_id
            let card = $(this).parents('div#varios' + obra_id + ' div.card');

            let inputs = card.children('div.card-body').find('input');
            let totales = card.children('div.card-footer').find('input');
            let row_totales = $(this).parents('div#myTabContent').children('div#home'+obra_id).children().eq(2);

            let input_total_varios_hidden = row_totales.find('input.totals_varios');
            let input_total_varios = $('#totals_varios'+obra_id);
            //console.log(totales);
            if (!inputs.eq(0).val() || !inputs.eq(1).val() || !inputs.eq(2).val()) {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ingresa todos los datos!'
                });
                return 0;
            }
            var ht = ' <tr id="algo' + contador + '"><td> <input type="hidden" form="formroden" name="variosd['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(0).val() + '" > ' + inputs.eq(0).val() + '</td>' +
                '<td class="montovario"><input type="hidden" form="formroden" name="variosm['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(1).val() + '" > ' + inputs.eq(1).val() + '</td>' +
                ' <td> <input type="hidden" form="formroden" class="costos_varios" name="variosc['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(2).val() + '" > ' + inputs.eq(2).val() + '</td>' +
                ' <td> <input type="hidden" form="formroden" class="totals_varios" name="variost['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(1).val() + '" > ' + inputs.eq(1).val() + '</td>' +
                '<td><button class="btn btn-danger" id="btn-elim-v-'+obra_id+'" onclick="removeVario(' + "'algo" + contador + "'" + ',' + inputs.eq(1).val() + ')">Eliminar</button></td></tr>';

            card.find('#tablavarios').append(ht);
            card.find('tbody#tablavarios tr').each(function(index, el) {
                totalva = +totalva + +parseFloat($(el).find('.montovario input').val());
            });

            totales.eq(0).val(totalva.toFixed(2));
            calcularSumaVarios(totales.eq(0));
            input_total_varios_hidden.val(totalva.toFixed(2));
            input_total_varios.val(totalva.toFixed(2));
            actualizarPrecioMedidas(obra_id);
            //calcular();
        });

        function removeVario(id, precio) {
            let obra_id = $('#'+ id).find('button').prop('id').split("-")[3];
            let totalva = 0.0;
            let card = $('#'+ id).find('button').parents('div#varios' + obra_id + ' div.card');
            let total = card.children('div.card-footer').find('input').eq(0);
            let row_totales = $('#'+ id).find('button').parents('div#myTabContent').children('div#home'+obra_id).children().eq(2);
            let input_total_varios_hidden = row_totales.find('input.totals_varios');
            let input_total_varios = $('#total_varios'+obra_id);

            
            card.find('tbody#tablavarios tr').each(function(index, el) {
                totalva = +totalva + +parseFloat($(el).find('.montovario input').val());
            });
            totalva = +totalva + -precio;
            total.val(totalva.toFixed(2));
            input_total_varios_hidden.val(totalva.toFixed(2));
            input_total_varios.val(totalva.toFixed(2));
            $(`#${id}`).remove();
            calcularSumaVarios(total.eq(0));
            actualizarPrecioMedidas(obra_id);
            //calcular();
        }

        $(document).on('click', '.agregarenvio', function () {
            var totalenvio = 0.00;
            let obra_id = $(this).prop('id').split("-")[2];
            //Se obtiene todo el card para acceder a los elementos de las pestañas en una obra dada por obra_id
            let card = $(this).parents('div#envios' + obra_id + ' div.card');

            let inputs = card.children('div.card-body').find('input');
            let direccion = card.children('div.card-body').find('textarea');
            let totales = card.children('div.card-footer').find('input');
            let row_totales = $(this).parents('div#myTabContent').children('div#home'+obra_id).children().eq(2);

            let input_total_envio_hidden = row_totales.find('input.totals_envio');
            let input_total_envio = $('#totals_envio'+obra_id);

            contador++
            //console.log(inputs);
            if (!inputs.eq(0).val() || !inputs.eq(1).val() || !inputs.eq(2).val() || !direccion.val()) {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ingresa todos los datos!'
                });
                return 0;
            }

            var ht = '<tr id="algo' + contador + '"><td> <input type="hidden" form="formroden" name="enviosdi['+(parseInt(obra_id) - 1)+'][]" value="' + direccion.val() + '" > ' + direccion.val() + '</td>' +
                ' <td> <input type="hidden" form="formroden" name="enviosd['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(0).val() + '" >' + inputs.eq(0).val() + '</td>' +
                ' <td class="montoenvio"> <input type="hidden" form="formroden" name="enviosm['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(1).val() + '"  > ' + inputs.eq(1).val() + '</td>' +
                ' <td class=""> <input type="hidden" form="formroden" class="costos_envio" name="enviosc['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(2).val() + '"  > ' + inputs.eq(2).val() + '</td>' +
                ' <td class=""> <input type="hidden" form="formroden" class="totals_envio" name="enviost['+(parseInt(obra_id) - 1)+'][]" value="' + inputs.eq(1).val() + '"  > ' + inputs.eq(1).val() + '</td>' +
                '<td><button class="btn btn-danger" id="btn-elim-e-'+obra_id+'" onclick="removeEnvio(' + "'algo" + contador + "'" + ',' + $("#montoenvio").val() + ')">Eliminar</button></td></tr>';
            card.find('#tablaenvios').append(ht);
            card.find('tbody#tablaenvios tr').each(function(index, el) {
                totalenvio = +totalenvio + +parseFloat($(el).find('.montoenvio input').val());
            });

            totales.eq(0).val(totalenvio.toFixed(2));
            calcularSumaEnvio(totales.eq(0));
            input_total_envio_hidden.val(totalenvio.toFixed(2));
            input_total_envio.val(totalenvio.toFixed(2));
            actualizarPrecioMedidas(obra_id);
            //calcular();
        });

        function removeEnvio(id, precio) {
            let obra_id = $('#'+ id).find('button').prop('id').split("-")[3];
            let totalenvio = 0.0;
            let card = $('#'+ id).find('button').parents('div#envios' + obra_id + ' div.card');
            let total = card.children('div.card-footer').find('input').eq(0);
            let row_totales = $('#'+ id).find('button').parents('div#myTabContent').children('div#home'+obra_id).children().eq(2);
            let input_total_envio_hidden = row_totales.find('input.totals_envio');
            let input_total_envio = $('#total_envio'+obra_id);

            card.find('tbody#tablaenvios tr').each(function(index, el) {
                totalenvio = +totalenvio + +parseFloat($(el).find('.montovario input').val());
            });
            //console.log(precio);
            totalenvio = +totalenvio + -precio;
            //console.lof(totalenvio);
            total.val(totalenvio.toFixed(2));
            input_total_envio_hidden.val(totalenvio.toFixed(2));
            input_total_envio.val(totalenvio.toFixed(2));
            $(`#${id}`).remove();
            calcularSumaEnvio(total);
            actualizarPrecioMedidas(obra_id);
            //calcular();
        }

        $(document).on('change', '.totalsV', function(event) {
            console.log('si cambio');
            let totalvarios = 0.0;
            totalvarios += parseFloat($(this).val());
            var precio_total = parseFloat($('#total').val().replace(',', ''));
            precio_total += totalsvarios;
            $('#total').val(new Intl.NumberFormat('es-MX').format(precio_total));
        });

        // ----  PARA ACTUALIZAR LA SUMA DE MANO DE OBRA CON LOS DESCUENTOS Y GANANCIAS
        $(document).on('change', ".descuento_manodeobra", function(event) {
            calcularSumaMO(this);
        });
        $(document).on('change', ".ganancia_manodeobra", function(event) {
            calcularSumaMO(this);
        });

        $(document).on('change', ".descuento_varios", function(event) {
            calcularSumaVarios(this);
        });
        $(document).on('change', ".ganancia_varios", function(event) {
            calcularSumaVarios(this);
        });

        $(document).on('change', ".descuento_envios", function(event) {
            calcularSumaEnvio(this);
        });
        $(document).on('change', ".ganancia_envios", function(event) {
            calcularSumaEnvio(this);
        });

        // ---- Para actualizar el total de la orden.
        $(document).on('change', '.totalsMO', function(event) {
            console.log('si cambio');
            let totalmanoobra = 0.0;
            totalmanoobra += parseFloat($(this).val());
            var precio_total = parseFloat($('#total').val().replace(/,/g, ''));
            precio_total += totalmanoobra;
            $('#total').val(new Intl.NumberFormat('es-MX').format(precio_total));
        });
        $(document).on('change', '.totalsE', function(event) {
            console.log('si cambio');
            let totalenvios = 0.0;
            totalenvios += parseFloat($(this).val());
            var precio_total = parseFloat($('#total').val().replace(/,/g, ''));
            precio_total += totalenvios;
            $('#total').val(new Intl.NumberFormat('es-MX').format(precio_total));
        });
        $(document).on('change', '.totalsO', function(event) {
            console.log('si cambio');
            let totalordens = 0.0;
            totalordens += parseFloat($(this).val());
            var precio_total = parseFloat($('#total').val().replace(/,/g, ''));
            precio_total += precio_total;
            $('#total').val(new Intl.NumberFormat('es-MX').format(precio_total));
        });

        function calcular() {
            let totalvarios = 0.0;
            let totalmanoobra = 0.0;
            let totalenvios = 0.0;
            let totalordens = 0.0;
            /***SUMAS***/
            $('.totalsV').each(function () {
                totalvarios += parseFloat($(this).val());
            });
            $('.totalMO').each(function () {
                totalmanoobra += parseFloat($(this).val());
            });
            $('.totalE').each(function () {
                totalenvios += parseFloat($(this).val());
            });
            $('.totalO').each(function () {
                totalordens += parseFloat($(this).val());
            });
            //totalordens = parseFloat($('#totalordenes').text());
            // $('#totalenvios').text(totalenvios);
            // $('#totalvarios').text(totalvarios);
            // $('#totalmanodeobra').text(totalmanoobra);

            /***GANANCIAS Y DESCUENTOS***/
            let a = parseFloat($('#totalordenes').text()) - parseFloat($('#descuento_ordenes').val()) + parseFloat($('#ganancia_ordenes').val());
            $("#inputtotalordenes").val(a);
            let b = parseFloat($('#totalmanodeobra').text()) - parseFloat($('#descuento_manodeobra').val()) + parseFloat($('#ganancia_manodeobra').val());
            $('#tmanodeobra').val(b);
            let c = parseFloat($('#totalvarios').text()) - parseFloat($('#descuento_varios').val()) + parseFloat($('#ganancia_varios').val());
            $('#tvarios').val(c);
            let d = parseFloat($('#totalenvios').text()) - parseFloat($('#descuento_envios').val()) + parseFloat($('#ganancia_envios').val());
            $('#tenvios').val(d);
            
            /***FINAL***/
            $('#totalproyecto').val(a+b+c+d)

            /***  Ganancias Netas  ***/
            let gananciaordenes = a;
            let gananciamanoobra = b;
            let gananciavarios = c;
            let gananciaenvios = d;
            $('.costos_orden').each(function() {
                gananciaordenes -= parseFloat($(this).val());
            });
            $('.costos_manodeobra').each(function() {
                gananciamanoobra -= parseFloat($(this).val());
            });
            $('.costos_varios').each(function() {
                gananciavarios -= parseFloat($(this).val());
            });
            $('.costos_envio').each(function() {
                gananciaenvios -= parseFloat($(this).val());
            });

            $('#gordenes').val(gananciaordenes);
            $('#gmanodeobra').val(gananciamanoobra);
            $('#gvarios').val(gananciavarios);
            $('#genvios').val(gananciaenvios);       
        }

        function calcularSumaMO(elemento){
            //console.log(elemento);
            let obra_id = $(elemento).parents('div.card').eq(0).children().find('button.agregarmanodeobra').prop('id').split("-")[2];
            let filas = $(elemento).parents('div.card').eq(0).children('div.card-body').find('table tbody tr');
            let input_total = $(elemento).parents('div.row').find('input').eq(0);
            let descuento = parseFloat($(elemento).parents('div.row').find('input').eq(1).val());
            let ganancia = parseFloat($(elemento).parents('div.row').find('input').eq(2).val());
            let aux = 0.0;
            filas.find('.montomanodeobra input').each(function(index, el) {
                aux += parseFloat($(el).val());
            });
            aux = aux - descuento + ganancia;
            input_total.val(aux.toFixed(2));
            $('#total_manodeobra'+obra_id).val(aux.toFixed(2));
            actualizarPrecioMedidas(obra_id);
        }
        function calcularSumaVarios(elemento){
            let obra_id = $(elemento).parents('div.card').eq(0).children().find('button.agregarvario').prop('id').split("-")[2];
            //console.log(obra_id);
            let filas = $(elemento).parents('div.card').eq(1).children('div.card-body').find('table tbody tr');
            let input_total = $(elemento).parents('div.row').find('input').eq(0);
            let descuento = parseFloat($(elemento).parents('div.row').find('input').eq(1).val());
            let ganancia = parseFloat($(elemento).parents('div.row').find('input').eq(2).val());
            let aux = 0.0;
            //console.log(input_total);
            filas.find('.montovario input').each(function(index, el) {
                aux += parseFloat($(el).val());
            });
            aux = aux - descuento + ganancia;
            input_total.val(aux.toFixed(2));
            $('#totals_varios'+obra_id).val(aux.toFixed(2));
            actualizarPrecioMedidas(obra_id);
        }
        function calcularSumaEnvio(elemento){
            console.log(elemento);
            let obra_id = $(elemento).parents('div.card').eq(0).children().find('button.agregarenvio').prop('id').split("-")[2];
            let filas = $(elemento).parents('div.card').eq(0).children('div.card-body').find('table tbody tr');
            let input_total = $(elemento).parents('div.row').find('input').eq(0);
            let descuento = parseFloat($(elemento).parents('div.row').find('input').eq(1).val());
            let ganancia = parseFloat($(elemento).parents('div.row').find('input').eq(2).val());
            let aux = 0.0;
            filas.find('.montoenvio input').each(function(index, el) {
                aux += parseFloat($(el).val());
            });
            aux = aux - descuento + ganancia;
            input_total.val(aux.toFixed(2));
            $('#totals_envio'+obra_id).val(aux.toFixed(2));
            actualizarPrecioMedidas(obra_id);
        }

        /*+
        * New Update se agrega un campo para el total de la obra
        * La funcion de abajo realiza la sumna y coloca el total en el campo.
        */
        function calcularObraTotal(obra_id) {
            let divObra = $('#home'+ obra_id);
            let input_total = $(divObra).find('#totals_obra' + obra_id);
            let input_precioxmedidas = parseFloat($(divObra).find('#total_obra' + obra_id).val().replace(/,/g, ''));
            let input_total_mano = parseFloat($(divObra).find('#total_manodeobra' + obra_id).val());
            let input_total_varios = parseFloat($(divObra).find('#totals_varios' + obra_id).val());
            let input_total_envio = parseFloat($(divObra).find('#totals_envio' + obra_id).val());
            let total = input_precioxmedidas + input_total_mano + input_total_varios + input_total_envio;
            //console.log(total);
            input_total.val(new Intl.NumberFormat('es-MX').format(total));
        }


    </script>
    @endsection