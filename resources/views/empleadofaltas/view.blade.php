@extends('layouts.infoempleado')
@section('infoempleado')
	{{-- expr --}}
	<div>
		<ul class="nav nav-pills nav-justified">
			<li role="presentation" class=""><a href="{{ route('empleados.show',['empleado'=>$empleado]) }}"  class="ui-tabs-anchor">Generales:</a></li>

			<li role="presentation" class=""><a href="{{ route('empleados.datoslaborales.index',['empleado'=>$empleado]) }}" class="ui-tabs-anchor">Laborales:</a></li>

			<li role="presentation" class=""><a href="{{ route('empleados.estudios.index', ['empleado' => $empleado]) }}" class="ui-tabs-anchor">Estudios:</a></li>

			<li role="presentation" class=""><a href="{{ route('empleados.emergencias.index',['empleado'=>$empleado]) }}" class="ui-tabs-anchor">Emergencias:</a></li>

			<li role="presentation" class=""><a href="{{ route('empleados.vacaciones.index',['empleado'=>$empleado]) }}" class="ui-tabs-anchor">Vacaciones:</a></li>

			<li role="presentation" class="active"><a href="{{ route('empleados.faltas.index',['empleado'=>$empleado]) }}" class="ui-tabs-anchor">Administrativo:</a></li>
		</ul>
	</div>
	<div class="panel-default">
		<div class="panel-heading"><h5>Administrativo:
		&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-asterisk" aria-hidden="true"></i>Campos Requeridos</h5></div>
		<div class="panel-body">
			<form role="for" method="POST" action="{{ route('empleados.faltas.store',['empleado'=>$empleado]) }}">
				{{ csrf_field() }}
				<input type="hidden" name="empleado_id" value="{{$empleado->id}}">
				<div class="col-xs-12 offset-md-2 mt-3">
					<div class="form-group col-xs-4">
						<label class="control-label" for="fecha" id="lbl_fecha"><i class="fa fa-asterisk" aria-hidden="true"></i>Fecha:</label>
						<input type="date" class="form-control" id="id_fecha" name="fecha">
					</div>
					<div class="form-group col-xs-3">
						<label class="control-label" for="comentarios" id="lbl_comen">Comentarios:</label>
						<textarea class="form-control" id="id_coment" name="comentarios" maxlength="500"></textarea>
					</div>
					<div class="form-group col-xs-3">
						<label class="control-label" for="problema" id="lbl_problema"><i class="fa fa-asterisk" aria-hidden="true"></i>Problema:</label>
						<textarea class="form-control" id="id_problema" name="problema" maxlength="500"></textarea>
					</div>
				</div>
				<div class="col-xs-12 offset-md-2 mt-3">
					<div class="form-group col-xs-3">
						<label class="control-label" for="tipofalta" id="lbl_falta"><i class="fa fa-asterisk" aria-hidden="true"></i>Tipo de falta:</label>
						 <div class="input-group">
						 <span class="input-group-addon" id="basic-addon3" onclick='getFaltas()'><i class="fa fa-refresh" aria-hidden="true"></i></span>
						<select type="select" name="tipofalta" class="form-control" id="tipofalta" required>
	  							<option id="Sin Definir" value="" selected="selected">Sin Definir</option>
	  							@foreach($faltasp as $falta)
	  							<option id="{{$falta->id}}" value="{{$falta->nombre}}">{{$falta->nombre}}</option>
	  							@endforeach
	  						</select>
					</div>
					</div>
				</div>
				<div class="col-xs-12 offset-md-2 mt-3">
					<div class="form-group col-xs-4">
	    					<label class="control-label" for="reporto">Quién lo reportó:</label>
	    					<input type="text" class="form-control" id="reporto" name="reporto" required>
	  				</div>
	  			</div>
	  			<button type="submit" class="btn btn-success">Guardar</button>
				
			</form>
			
			<table class="table table-striped table-bordered table-hover" style="color:rgb(51,51,51); border-collapse: collapse; margin-bottom: 0px">
						<thead>
							<tr class="info">
								<th>@sortablelink('fecha','Fecha:')</th> 
								<th>@sortablelink('tipofalta','Tipo:')</th>
								<th>@sortablelink('reporto','Quién Reporto:')</th>
								<th>@sortablelink('problema','Problema:')</th>
							</tr>
						</thead>
						@foreach ($faltas as $falta)
							{{-- expr --}}
							<tr class="active">
								<td>{{$falta->fecha}}</td>
								<td>{{$falta->tipofalta}}</td>
								<td>{{$falta->reporto}}</td>
								<td>{{$falta->problema}}</td>
							</tr>
						@endforeach
			</table>
			</div>
				<script type="text/javascript">
		function getFaltas()
		{
		  $.ajaxSetup({
		    headers: {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		  });
		  $.ajax({
		    url: "{{ url('/getfaltas') }}",
		    type: "GET",
		    dataType: "html",
		  }).done(function(resultado){
		    $("#tipofalta").html(resultado);
		  });
		}
				</script>
@endsection