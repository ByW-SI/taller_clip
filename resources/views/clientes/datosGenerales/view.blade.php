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
		 	<div class="panel-body">
		 		<div class="row">
		 			<div class="form-group col-sm-4">
		 				<label class="control-label" for="nombre">Tamaño de la empresa:</label>
						<dd>{{ $datos->tamano }}</dd>
		 			</div>
		 			<div class="form-group col-sm-4">
		 				<label class="control-label" for="nombre">Giro de la empresa:</label>
		 				@if($datos->giro_id == null)
		 					<dd>No tiene giro</dd>
		 				@else
							<dd>{{ $giro->nombre }}</dd>
						@endif
		 			</div>
		 			<div class="form-group col-sm-4">
					 	<label class="control-label" for="nombre">Forma contacto:</label>
						 <dd>{{$formaContacto->nombre}}</dd>
		 			</div>
		 		</div>
		 		<div class="row">
		 			<div class="form-group col-sm-4">
		 				<label class="control-label" for="web">Sitio web:</label>
		 				<dd><a href="{{ $datos->web }}" target="_blank">{{ $datos->web }}</a></dd>
		 			</div>

		 			<div class="form-group col-sm-4">
		 				<label class="control-label" for="comentario">Comentarios:</label>
		 				<dd>{{ $datos->comentario }}</dd>
		 			</div>
		 			<div class="form-group col-sm-4">
		 				<label class="control-label" for="fechacontacto">Fecha de contacto:</label>
		 				<dd>{{ $datos->fechacontacto }}</dd>
		 				
		 			</div>
		 		</div>
		 	</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-12 text-center">
				 		<a class="btn btn-danger" href="{{ route('clientes.datosgenerales.edit', ['cliente' => $cliente, 'generales' => $datos]) }}">
				 			<strong>Editar</strong>
				 		</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection