@extends('layouts.blank')
@section('content')

<div class="container-fluid">
	{{-- @if($edit)
		<form role="form" method="POST" action="{{ route('empleados.update', ['empleado' => $empleado]) }}">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
	@else --}}
		<form role="form" id="form-empleado" method="POST" action=""  name="form">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="">
	{{-- @endif --}}
		<div role="application" class="panel panel-group">
			<div class="panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4">
							<h4>Datos de la Orden de trabajo:</h4>
						</div>
						<div class="col-sm-4 text-center">
							<a href="{{ route('ordentrabajo.index') }}" class="btn btn-primary">
								<i class="fa fa-bars" aria-hidden="true"></i><strong> Lista de Ordenes de trabajo</strong>
							</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-3">
							<label class="control-label" for="appaterno">✱Numero de cotizacion:</label>
							@if($coleccion)
								<select type="select" id="cotizacion" class="form-control">
									<option value="">Seleccione una opcion</option>
									@foreach ($cotizaciones as $cotizacion)
										<option value="{{$cotizacion->id}}">{{$cotizacion->nocotizacion}}</option>
									@endforeach
								</select>
							@else
								<select type="select" id="cotizacion" readonly class="form-control">			
										<option value="{{$cotizaciones->id}}" selected="selected">{{$cotizaciones->nocotizacion}}</option>
								</select>
							@endif

						</div>
						<div class="col-sm-3">
							<label class="control-label" for="appaterno">Actividades:</label>
							<select type="select" id="act" class="form-control">
								<option value="">Seleccione una opcion</option>
								<option value="Actividad ejemplo">Actividad ejemplo</option>
								{{-- @foreach ($cotizaciones as $cotizacion)
									<option value="{{$cotizacion->id}}">{{$cotizacion->nocotizacion}}</option>
								@endforeach --}}
							</select>
							
						</div>
						<div class="col-4 form-group pt-4 text-center">
								<button id="agregar_act" type="button" class="btn btn-primary" onclick="addAct()">Agregar Actividad</button>
						</div>				
						
					</div>
				</div>
			</div>
			{{-- @if($edit)
			<div>
				<ul class="nav nav-pills nav-justified">
					<li role="presentation" class="active"><a href="{{ route('empleados.show', ['empleado' => $empleado]) }}"  class="ui-tabs-anchor">Generales:</a></li>
					<li role="presentation" class=""><a href="{{ route('empleados.datoslaborales.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Laborales:</a></li>
					<li role="presentation" class=""><a href="{{ route('empleados.emergencias.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Emergencias:</a></li>
					<li role="presentation" class=""><a href="{{ route('empleados.vacaciones.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Vacaciones:</a></li>
					<li role="presentation" class=""><a href="{{ route('empleados.faltas.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Administrativo:</a></li>
				</ul>
			</div>
			@endif --}}
				<div class="panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-sm-4">
								<h5><strong>Actividades agregadas:</strong></h5>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered">
							<thead>
								<tr class="table-info">
									<th scope="col">#</th>
									<th scope="col">Actividad</th>
									<th scope="col">Orden</th>
									<th scope="col">% de la Orden</th>
									<th scope="col">Empleado</th>
								</tr>
							</thead>
							<tbody id="tabla_actividades">
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-sm-4 col-sm-offset-4 text-center">
								<button type="button" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true" ></i> Guardar</button>
							</div>
							<div class="col-sm-4 text-right text-danger">
								<h5>✱Campos Requeridos</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div id='app'></div>
@endsection
<script type="text/javascript">
	var fila=0;
	function addAct() {
		//alert("hola");
		
		var table = document.getElementById("tabla_actividades");
		var act=document.getElementById("act").value;
		if(!act)
		{
			return false;
		}
		//alert(act);
		var row = table.insertRow(fila);
		fila++;
		var cell1 = row.insertCell(0);		
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		cell1.innerHTML = fila;
		cell2.innerHTML = act;
		cell3.innerHTML = '<input type="number">';
		cell4.innerHTML = '<input type="number">%';
		cell5.innerHTML = '<input type="text">';
}

</script>