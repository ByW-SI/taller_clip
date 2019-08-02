@extends('layouts.cotizacion')
	@section('content')
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <div class="col-sm-4">
          <h5>Ordenes:</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="mt-1">
          <table id="tablaordenes" class="table table-bordered table-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No. de orden</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha</th>
                <th scope="col">Descripción</th>
                <th scope="col">Total Orden</th>
                <th scope="col">Ganancia Orden</th>
                <th scope="col">Obras</th>
                <!-- <th scope="col">Acción</th> -->
                <th scope="col">Cliente</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ordenes as $orden)
              <tr>
                <td scope="row">
                  {{$orden->noorden}}
                </td>
                <td>
                  {{$orden->nombre}}
                </td>
                <td>
                  {{$orden->fecha}}
                </td>
                <td>{{$orden->descripcion}}</td>
                <td>$ {{number_format($orden->precio_orden,4)}}</td>
                <td>$ {{ number_format(($orden->precio_orden - $orden->ganancia_orden),2) }}</td>
                <td>
                    {{$orden->noobras}} obra(s): <br>
                    @foreach ($orden->obras as $obra)
                      {{$obra->nombre}} <br>
                    @endforeach
                  <div class="modal fade" tabindex="-1" role="dialog" id="infObra{{$orden->id}}" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="width: 90%;margin: 3% auto">
                    <div class="modal-dialog" role="document" style="min-width: 100%!important;margin: 0!important;">
                      <div class="modal-content" style="min-height: 50vh!important;">
                        <div class="modal-header">
                          <h5 class="modal-title">Obras de {{$orden->nombre}}:</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          @foreach ($orden->obras as $index=>$obra)
                            <table class="table">
                              <tbody>
                                <tr class="table-info">
                                  <th class="span" colspan="8" scope="colgroup">Obra {{$index+1}}</th>
                                </tr>
                                <tr class="table-info">
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Piezas</th>
                                  <th scope="col" colspan="2">Descripción</th>
                                  <th scope="col">Alto</th>
                                  <th scope="col">Ancho</th>
                                  <th scope="col">Profundidad</th>
                                  <th scope="col">Precio Obra</th>
                                </tr>
                                <tr>
                                  <td scope="row">
                                    {{$obra->nombre}}
                                  </td>
                                  <td>{{$obra->nopiezas}}</td>
                                  <td colspan="2">{{$obra->descripcion_obra}}</td>
                                  <td>{{$obra->alto_marco}} cm</td>
                                  <td>{{$obra->ancho_marco}} cm</td>
                                  <td>{{$obra->profundidad_marco}} cm</td>
                                  <td>$ {{ number_format($obra->total_obra,2) }}</td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table">
                              <tbody>
                                <tr class="table-secondary">
                                  <th class="span" colspan="8" scope="colgroup">Materiales</th>
                                </tr>
                                <tr class="table-secondary">
                                  <th scope="col">Clave</th>
                                  <th scope="col">Sección</th>
                                  <th scope="col">Color</th>
                                  <th scope="col">Alto</th>
                                  <th scope="col">Ancho</th>
                                  <th scope="col">Espesor</th>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Precio del material</th>
                                </tr>
                                @foreach ($obra->materiales as $material)
                                <tr>
                                  <td scope="row">{{$material->clave}}</td>
                                  <td>{{$material->seccion}}</td>
                                  <td>{{$material->color}}</td>
                                  <td>{{$material->alto}} cm</td>
                                  <td>{{$material->ancho}} cm</td>
                                  <td>{{$material->espesor}} cm</td>
                                  <td>{{ $material->pivot->cantidad }}</td>
                                  <td>$ {{number_format($material->precio, 2)}} MXN</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <hr>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-1 justify-content-md-center">
                    <button type="button" data-toggle="modal" data-target="#infObra{{$orden->id}}" href="#" class="btn btn-info">Ver</button>
                  </div>
                </td>
                <td>
                  {{$orden->cliente->nombre}}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready( function () {
        $('#tablaordenes').DataTable({
          "language": {
            "search": "Buscar:",
            "emptyTable":     "Tabla vacía",
          }
        });
    } );
  </script>
  <style>
    hr{
      border-width: 5px;
      background: #787878;
    }

  </style>
  @endsection