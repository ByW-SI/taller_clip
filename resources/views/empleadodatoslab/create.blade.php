@extends('layouts.infoempleado')
@section('infoempleado')

<ul class="nav nav-pills nav-justified">
	<li role="presentation" class=""><a href="{{ route('empleados.show', ['empleado' => $empleado]) }}"  class="ui-tabs-anchor">Generales:</a></li>
	<li role="presentation" class="active"><a href="{{ route('empleados.datoslaborales.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Laborales:</a></li>
	<li role="presentation" class=""><a href="{{ route('empleados.estudios.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Estudios:</a></li>
	<li role="presentation" class=""><a href="{{ route('empleados.emergencias.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Emergencias:</a></li>
	<li role="presentation" class=""><a href="{{ route('empleados.vacaciones.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Vacaciones:</a></li>
	<li role="presentation" class=""><a href="{{ route('empleados.faltas.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Administrativo:</a></li>
</ul>
<div class="panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-4">
				<h5>Datos Laborales:</h5>
			</div>
		</div>
	</div>
@if($edit)
	<form role="form" method="POST" action="{{ route('empleados.datoslaborales.store', ['empleado' => $empleado]) }}">
		{{ csrf_field() }}
@else
	<form role="form" method="POST" action="{{ route('empleados.datoslaborales.store', ['empleado' => $empleado]) }}">
		{{ csrf_field() }}
@endif
		<div class="panel-body">
			<input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
			<div class="row">
				<div class="form-group col-sm-3">
					<label class="control-label" for="fechacontratacion">✱Fecha de contratación:</label>
					<input class="form-control" type="date" id="fechacontratacion" name="fechacontratacion" value="{{ $datoslab->fechacontratacion }}" required @if($edit) readonly @endif>
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="contrato">Tipo de contrato:</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3" onclick='getContratos()'><strong>⟳</strong></span>
						<select type="select" class="form-control" name="contrato_id" id="contrato_id">
							<option id="" value="">Sin Definir</option>
							@foreach ($contratos as $contrato)
								<option id="{{ $contrato->id }}" value="{{ $contrato->id }}" @if ($datoslab->contrato_id == $contrato->id) selected="selected" @endif>{{ $contrato->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="area_id">Área:</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3" onclick='getAreas()'><strong>⟳</strong></span>
						<select type="select" class="form-control" name="area_id" id="area_id">
							<option value="">Sin Definir</option>
							@foreach ($areas as $area)
								<option id="{{ $area->id }}" value="{{ $area->id }}" @if ($datoslab->area_id == $area->id) selected="selected" @endif>{{ $area->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="puesto_id">Puesto:</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3" onclick='getPuestos()'><strong>⟳</strong></span>
						<select type="select" name="puesto_id" id="puesto_id" class="form-control" >
							<option value="">Sin Definir</option>
							@foreach ($puestos as $puesto)
								<option id="{{ $puesto->id }}" value="{{ $puesto->id }}" @if ($datoslab->puesto_id == $puesto->id) selected @endif>{{ $puesto->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-3">
					<label class="control-label" for="salarionom">✱Salario Nóminal:</label>
					<input class="form-control" type="text" id="salarionom" name="salarionom" value="{{ $datoslab->salarionom }}" required>
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="salariodia">Salario Diario:</label>
					<input class="form-control" type="text" id="salariodia" name="salariodia" value="{{ $datoslab->salariodia }}">
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="periodopaga">Periodicidad de Pago:</label>
					<select type="select" class="form-control" name="periodopaga" id="periodopaga">
						<option id="1" value="Semanal" @if ($datoslab->periodopaga == "Semanal") selected="selected" @endif>Semanal</option>
						<option id="2" value="Quincenal" @if ($datoslab->periodopaga == "Quincenal") selected="selected" @endif>Quincenal</option>
						<option id="3" value="Mensual" @if ($datoslab->periodopaga == "Mensual") selected="selected" @endif>Mensual</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-3">
					<label class="control-label" for="prestaciones">Prestaciones:</label>
					<select class="form-control" type="select" name="prestaciones" id="prestaciones">
						<option id="1" value="De Ley" @if ($datoslab->prestaciones == "De Ley") selected="selected" @endif>De Ley</option>
					</select>
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="regimen">Régimen de Contratación:</label>
					<select class="form-control" type="select" name="regimen" id="regimen" value="{{ $datoslab->regimen }}">
						<option id="1" value="Sueldos y Salarios" @if ($datoslab->regimen == "Sueldos y Salarios") selected="selected" @endif>Sueldos y Salarios</option>
						<option id="2" value="Jubilados" @if ($datoslab->regimen == "Jubilados") selected="selected" @endif>Jubilados</option>
						<option id="3" value="Pensionados" @if ($datoslab->regimen == "Pensionados") selected="selected" @endif>Pensionados</option>
					</select>
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="hentrada">Hora de Entrada:</label>
					<input class="form-control" type="text" id="hentrada" name="hentrada" value="{{ $datoslab->hentrada }}">
				</div>
				<div class="form-group col-sm-3">
					<label class="control-label" for="hsalida">Hora de Salida:</label>
					<input class="form-control" type="text" id="hsalida" name="hsalida" value="{{ $datoslab->hsalida }}">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label class="control-label" for="hcomida">Tiempo de Comida:</label>
					<select class="form-control" type="select" name="hcomida" id="hcomida" value="{{ $datoslab->hcomida }}">
						<option id="1" value="0 min" @if ($datoslab->hcomida == "0 min") selected="selected" @endif>0 min.</option>
						<option id="2" value="30 min" @if ($datoslab->hcomida == "30 min") selected="selected" @endif>30 min.</option>
						<option id="3" value="45 min" @if ($datoslab->hcomida == "45 min") selected="selected" @endif>45 min.</option>
						<option id="4" value="60 min" @if ($datoslab->hcomida == "60 min") selected="selected" @endif>60 min.</option>
						<option id="5" value="1 hr 15 min" @if ($datoslab->hcomida == "1 hr 15 min") selected="selected" @endif>1 hr 15 min.</option>
						<option id="6" value="1 hr 30 min" @if ($datoslab->hcomida == "1 hr 30 min") selected="selected" @endif>1 hr 30 min.</option>
						<option id="7" value="2 hrs" @if ($datoslab->hcomida == "2 hrs") selected="selected" @endif>2 hrs.</option>
						<option id="8" value="2 hrs 30 min" @if ($datoslab->hcomida == "2 hrs 30 min") selected="selected" @endif>2 hrs 30 min.</option>
						<option id="9" value="3 hrs" @if ($datoslab->hcomida == "3 hrs") selected="selected" @endif>3 hrs.</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label class="control-label" for="banco">Banco:</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3" onclick='getBancos()'><strong>⟳</strong></span>
						<select class="form-control" type="select" name="banco" id="banco">
							<option value="">Sin Definir</option>
							@foreach ($bancos as $banco)<option id="{{ $banco->nombre }}" value="{{ $banco->nombre }}" @if ($datoslab->banco == $banco->nombre) selected="selected" @endif>{{ $banco->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<label class="control-label" for="cuenta">Cuenta:</label>
					<input class="form-control" type="text" id="cuenta" name="cuenta" value="{{ $datoslab->cuenta }}">
				</div>
				<div class="col-sm-3">
					<label class="control-label" for="clabe">CLABE:</label>
					<input class="form-control" type="clabe" name="clabe" id="clabe" value="{{ $datoslab->clabe }}">
				</div>
			</div>
		</div>
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h5>Datos de Baja:</h5>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label" for="fechabaja">Fecha de la baja:</label>
						<input class="form-control" type="date" id="fechabaja" name="fechabaja" value="{{ $datoslab->fechabaja }}">
					</div>

					<div class="col-sm-3">
						<label class="control-label" for="tipobaja_id">Tipo de Baja:</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3" onclick='getBajas()'><strong>⟳</strong></span>
							<select class="form-control" type="select" name="tipobaja_id" id="tipobaja_id">
								<option id="0" value="">No hay baja</option>
								@foreach ($bajas as $baja)
									<option id="{{ $baja->id }}" value="{{ $baja->id }}" @if ($datoslab->tipobaja_id == $baja->id) selected="selected" @endif>{{ $baja->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-3">
						<label class="control-label" for="comentariobaja">Comentarios:</label>
						<textarea class="form-control" id="comentariobaja" name="comentariobaja" maxlength="500">{{ $datoslab->comentariobaja }}</textarea>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4 text-center">
						<button type="submit" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Guardar</button>
					</div>
					<div class="col-sm-4 text-right text-danger">
						<h5>✱Campos Requeridos</h5>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
	function getAreas() {
	  	$.ajaxSetup({
			headers: {
		  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	  	});
		$.ajax({
			url: "{{ url('/getareas') }}",
			type: "GET",
			dataType: "html",
	  	}).done(function(resultado) {
			$("#area_id").html(resultado);
	  	});
	}

	function getContratos() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/getcontratos') }}",
			type: "GET",
			dataType: "html",
		}).done(function(resultado) {
			$("#contrato_id").html(resultado);
		});
	}

	function getPuestos() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/getpuestos') }}",
			type: "GET",
			dataType: "html",
		}).done(function(resultado) {
			$("#puesto_id").html(resultado);
		});
	}

	function getBajas() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/getbajas') }}",
			type: "GET",
			dataType: "html",
		}).done(function(resultado) {
			$("#tipobaja_id").html(resultado);
		});
	}

	function getBancos() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/getbancos') }}",
			type: "GET",
			dataType: "html",
		}).done(function(resultado) {
			$("#banco").html(resultado);
		});
	}

	function getSucursal() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/getSucursal') }}",
			type: "GET",
			dataType: "html",
		}).done(function(resultado) {
			$("#sucursal_id").html(resultado);
		});
	}
</script>

@endsection