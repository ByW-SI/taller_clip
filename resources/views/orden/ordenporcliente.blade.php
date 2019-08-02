@foreach ($ordenes as $orden)
    <tr class="table-info">
        <th scope="col" colspan="7">Orden</th>
    </tr>
    <tr class="table-info">
        <th scope="col">Número</th>
        <th scope="col">Orden</th>
        <th scope="col">Fecha</th>
        <th scope="col" colspan="2">Descripción</th>
        <th scope="col">Precio</th>
        <th scope="col">Acción</th>
    </tr>
    <tr>
        <td scope="row">{{$orden->noorden}}</td>
        <td>{{$orden->nombre}}</td>
        <td>{{$orden->fecha}}</td>
        <td colspan="2">{{$orden->descripcion}}</td>
        <td>${{number_format($orden->precio_orden,2)}}</td>
        <td>
            <div class="row mt-1 mb-1 justify-content-md-center">
                <a href="#" onclick="addOrden({{json_encode($orden)}})" class="btn btn-success">Agregar</a>
            </div>
            <div class="row mt-1 mb-1 justify-content-md-center">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".collapse{{$orden->id}}" aria-expanded="false" aria-controls="collapseExample">
                    Más detalles
                </button>
            </div>
        </td>
    </tr>
    @foreach ($orden->obras as $index=>$obra)
        <tr class="table-success collapse collapse{{$orden->id}}">
            <th scope="col" colspan="7">Obra(s) de {{$orden->nombre}}</th>
        </tr>
        <tr class="table-success collapse collapse{{$orden->id}}">
            <th scope="col">Nombre</th>
            <th scope="col">Piezas</th>
            <th scope="col" colspan="2">Descripción</th>
            <th scope="col">Medidas Obra</th>
            <th scope="col">Medidas Marco</th>
            <th scope="col">Precio</th>
        </tr> 
        <tr class="collapse collapse{{$orden->id}}">
            <td scope="row">{{$obra->nombre}}</td>
            <td>{{$obra->nopiezas}}</td>
            <td colspan="2">{{$obra->descripcion_obra}}</td>
            <td>
              Alto:{{$obra->alto_obra}} cm x
            Ancho:{{$obra->ancho_obra}} cm
            {{$obra->profundidad_obra != 0.0?'x Profunidad:'.$obra->profundidad_obra.' cm': ''}}
            </td>
            <td><b>
              Alto:{{$obra->largo_marco}} cm x
            Ancho:{{$obra->ancho_marco}} cm
            {{$obra->profundidad_marco != 0.0?'x Profunidad:'.$obra->profundidad_marco.' cm': ''}}
            </b>
            </td>
            <td><b>${{ number_format($obra->total_obra,2) }}</b></td>
        </tr>
        <tr class="table-secondary collapse collapse{{$orden->id}}">
            <th scope="col" colspan="7">Material(es) de {{$obra->nombre}}</th>
        </tr>
        <tr class="table-secondary collapse collapse{{$orden->id}}">
            <th scope="col">Clave</th>
            <th scope="col">Sección</th>
            <th scope="col">Color</th>
            <th scope="col">Medidas</th>
            <th scope="col">Precio</th>
        </tr>
        @foreach ($obra->materiales as $material)
            <tr class="collapse collapse{{$orden->id}}">
                <td scope="row">{{$material->clave}}</td>
                <td>{{$material->seccion}}</td>
                <td>{{$material->color}}</td>
                <td>
                  {{$material->alto}} cm x
                  {{$material->ancho}} cm x
                  {{$material->espesor}} cm
                </td>
                <td>${{$material->precio}}MXN</td>
            </tr>
        @endforeach
    @endforeach
@endforeach

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>