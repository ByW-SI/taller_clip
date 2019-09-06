@extends('layouts.blank')
@section('content')

<div class="container-fluid" id="tab">
	<div role="application" class="panel panel-group" >
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del cliente:</h4>
					</div>
					<div class="col-sm-4 text-center">
						<a class="btn btn-success" href="{{ route('clientes.create') }}">
							<i class="fa fa-plus" aria-hidden="true"></i><strong> Agregar cliente</strong>
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
		<ul class="nav nav-tabs">
			<li><a href="{{ route('clientes.show', ['cliente' => $cliente]) }}">Dirección Física</a></li>
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
			<form role="form" id="form-cliente" method="POST" action="{{ route('clientes.datosgenerales.update', ['cliente' => $cliente, 'datos' => $datos]) }}" name="form">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
 				<div class="panel-body">
			 		<div class="row">
			 			<div class="form-group col-sm-4">
				 			<label class="control-label" for="nombre"><i class="fa fa-asterisk" aria-hidden="true"></i>Giro:</label>
							<select type="select" name="giro_id" class="form-control" id="giro_id">
								@foreach ($giros as $giro)
									<option id="'{{$giro->id}}'" value="{{$giro->id}}" @if ($datos->giro_id == $giro->id) selected="selected" @endif >{{$giro->nombre}}</option>
								@endforeach
							</select>
			 			</div>
			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="nombre"><i class="fa fa-asterisk" aria-hidden="true"></i>Tamaño de la empresa:</label>
							<select type="select" name="tamano" class="form-control" id="tamano">
								<option id="micro" value="micro" @if ($datos->tamano == "micro") selected="selected" @endif>Micro</option>
								<option id="pequeña" value="pequeña" @if ($datos->tamano == "pequeña") selected="selected" @endif>Pequeña</option>
								<option id="mediana" value="mediana" @if ($datos->tamano == "mediana") selected="selected" @endif>Mediana</option>
								<option id="grande" value="grande" @if ($datos->tamano == "grande") selected="selected" @endif>Grande</option>
							</select>
			 			</div>
			 			<div class="form-group col-sm-4">
			 				
			 			</div>
			 		</div>
			 		<div class="row">
			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="web">Sitio web:</label>
			 				<input type="text" class="form-control" id="web" name="web" value="{{ $datos->web }}" autofocus>
			 			</div>

			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="comentario">Comentarios:</label>
			 				<textarea  class="form-control" rows="5" id="comentario" name="comentario">{{ $datos->comentario }}</textarea>
			 			</div>
			 			<div class="form-group col-sm-4">
			 				<label class="control-label" for="fechacontacto">Fecha de contacto:</label>
			 				<input type="date" class="form-control" id="fechacontacto" name="fechacontacto" value="{{ $datos->fechacontacto }}">
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

@endsection