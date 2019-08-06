@extends('layouts.blank')
@section('content')

<div class="container-fluid" id="tab">
	<div role="application" class="panel panel-group" >
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Cliente:</h4>
					</div>
					<div class="col-sm-4 text-center">
						<a class="btn btn-success" href="{{ route('clientes.create') }}">
							<i class="fa fa-plus" aria-hidden="true"></i><strong> Agregar Cliente</strong>
						</a>
					</div>
					<div class="col-sm-4 text-center">
						<a class="btn btn-primary" href="{{ route('clientes.index') }}">
							<i class="fa fa-bars" aria-hidden="true"></i><strong> Lista de clientes</strong>
						</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
  					<div class="form-group col-sm-3">
    					<label class="control-label" for="tipopersona">Tipo de Persona:</label>
    					<dd>{{ $cliente->tipopersona }}</dd>
  					</div>
					@if($cliente->tipopersona == "Fisica")
						<div class="form-group col-sm-3">
	  						<label class="control-label" for="nombre">Nombre(s):</label>
	  						<dd>{{ $cliente->nombre }}</dd>
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="apellidopaterno">Apellido Paterno:</label>
	  						<dd>{{ $cliente->apellidopaterno }}</dd>
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="apellidomaterno">Apellido Materno:</label>
	  						<dd>{{ $cliente->apellidomaterno }}</dd>
	  					</div>
					@else
						<div class="form-group col-sm-3">
	  						<label class="control-label" for="razonsocial">Razon Social:</label>
	  						<dd>{{ $cliente->razonsocial }}</dd>
	  					</div>
					@endif
  					<div class="form-group col-sm-3">
  						<label class="control-label" for="rfc">RFC:</label>
  						<dd>{{ $cliente->rfc }}</dd>
  					</div>
				</div>
			</div>
		</div>
		<ul role="tablist" class="nav nav-tabs">
			<li><a href="{{ route('clientes.show', ['cliente' => $cliente]) }}">Dirección Física aqui</a></li>
			<li><a href="{{ route('clientes.direccionFiscal.index', ['cliente' => $cliente]) }}" >Dirección Fiscal</a></li>
			<li><a href="{{ route('clientes.direccionEntrega.index', ['cliente' => $cliente]) }}">Dirección de Entrega</a></li>
			{{-- <li><a href="{{ route('clientes.descuentos.index', ['cliente' => $cliente]) }}">Descuentos</a></li> --}}
			<li><a href="{{ route('clientes.crm.index', ['cliente' => $cliente]) }}">CRM</a></li>
			<li><a href="{{ route('clientes.contacto.index', ['cliente' => $cliente]) }}">Contactos:</a></li>
			<li class="active"><a href="{{route('clientes.datosgenerales.index',['cliente' => $cliente])}}">Datos Generales</a></li>
		</ul>
		<div class="panel panel-default">
		 	<div class="panel-heading">
		 		<div class="row">
		 			<div class="col-sm-4">
		 				<h4>Datos Generales:</h4>
		 			</div>
		 		</div>
		 	</div>
			<form role="form" id="form-cliente" method="POST" action="{{ route('clientes.datosgenerales.store', ['cliente'=>$cliente]) }}" name="form">
				{{ csrf_field() }}
			 	<div class="panel-body">
			 		<div class="row">
			 			<div class="form-group col-sm-4">
				 			<label class="control-label" for="nombre">✱Giro:</label>
				 			<div class="input-group">
		  						<span class="input-group-addon" id="basic-addon3" onclick='getGiros()'><i class="fa fa-refresh" aria-hidden="true"></i></span>
								<select type="select" name="giro_id" class="form-control" id="giro_id" required>
									<option id="sin_definir" value="">Sin Definir</option>
									@foreach ($giros as $giro)
										<option id="'{{$giro->id}}'" value="{{$giro->id}}">{{$giro->nombre}}</option>
									@endforeach
								</select>
							 </div>
			 			</div>
			 			<div class="form-group col-sm-4">
			 			<label class="control-label" for="nombre">✱Tamaño de la empresa:</label>
							<select type="select" name="tamano" class="form-control" id="tamano" required>
								<option value="">Elija el tamaño de la empresa</option>
								<option id="micro" value="micro">Micro</option>
								<option id="pequeña" value="pequeña">Pequeña</option>
								<option id="mediana" value="mediana">Mediana</option>
								<option id="grande" value="grande">Grande</option>
							</select>
			 			</div>
			 			<div class="form-group col-sm-4">
						 <label class="control-label" for="forma_contacto_id">✱Forma de Contacto:</label>
							<select type="select" name="forma_contacto_id" class="form-control" id="forma_contacto_id" required>
								<option value="">Elija forma de contacto</option>
							</select>
			 			</div>
			 		</div>
			 		<div class="row">
			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="web">Sitio web:</label>
			 				<input type="url" class="form-control" id="web" name="web" onblur="checkURL(this)" value="" autofocus>
			 			</div>

			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="comentario">Comentarios:</label>
			 				<textarea  class="form-control" rows="5" id="comentario" name="comentario"></textarea>
			 			</div>
			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="fechacontacto">✱Fecha de contacto:</label>
			 				<input required type="date" class="form-control" id="fechacontacto" name="fechacontacto">
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
			</form>
		</div>
	</div>
</div>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
	
	function getBancos(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getbancos') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#banco").html(resultado);
		});
	}

	function getGiros(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getgiros') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#giro_id").html(resultado);
		});
	}

	$(document).ready(function(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getcontacto') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#forma_contacto_id").html(resultado);
		});

	});

	function checkURL(abc) {
		var string = abc.value;
		if (!~string.indexOf("http")) {
		string = "http://" + string;
		}
		abc.value = string;
		return abc;
	}

</script>

@endsection