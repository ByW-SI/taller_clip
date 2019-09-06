@extends('layouts.blank')
@section('content')

<div class="container-fluid" id="tab">
	<form method="POST" action="{{ route('clientes.contacto.store', ['cliente' => $cliente]) }}">
		{{ csrf_field() }}
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
				<li class="active"><a href="{{ route('clientes.contacto.index', ['cliente' => $cliente]) }}">Contactos:</a></li>
				<li><a href="{{route('clientes.datosgenerales.index',['cliente' => $cliente])}}">Datos Generales</a></li>
			</ul>
		</ul>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h5>Contacto:</h5>
					</div>
				</div>
			</div>
			<form role="form" method="POST" action="{{ route('clientes.contacto.store', ['cliente' => $cliente]) }}">
				<div class="panel-body">
					{{ csrf_field() }}
					<div class="row">
						<div class="form-group col-sm-3">
	    					<label class="control-label" for="nombre">✱Nombre(s):</label>
	    					<input type="text" class="form-control" id="nombre" name="nombre" value="" required autofocus>
	  					</div>
	  					<div class="form-group col-sm-3">
	    					<label class="control-label" for="apater">✱Apellido paterno:</label>
	    					<input type="text" class="form-control" id="apater" name="apater" value="" required>
	  					</div>	
	  					<div class="form-group col-sm-3">
	    					<label class="control-label" for="amater">Apellido materno:</label>
	    					<input type="text" class="form-control" id="amater" name="amater" value="">
	  					</div>		
					</div>
					<div class="row">
						<div class="form-group col-sm-3">
	  						<label class="control-label" for="area">Área:</label>
	  						<input type="text" class="form-control" id="area" name="area" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="puesto">Puesto:</label>
	  						<input type="text" class="form-control" id="puesto" name="puesto" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
  							<label class="control-label" for="telefono1">Telefono:</label>
	  						<input type="text" class="form-control" id="telefono1" name="telefono1" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="ext1">Extensión:</label>
	  						<input type="text" class="form-control" id="ext1" name="ext1" size="6" value="">
	  					</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-3">
	  						<label class="control-label" for="telefono2">Telefono :</label>
	  						<input type="text" class="form-control" id="telefono2" name="telefono2" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="ext2">Extensión:</label>
	  						<input type="text" class="form-control" id="ext2" name="ext2" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="telefonodir">Telefono directo:</label>
	  						<input type="text" class="form-control" id="telefonodir" name="telefonodir" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="celular1">Celular:</label>
	  						<input type="text" class="form-control" id="celular1" name="celular1" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="celular2">Celular:</label>
	  						<input type="text" class="form-control" id="celular2" name="celular2" value="">
	  					</div>
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="email1">Correo electronico:</label>
	  						<input type="email" class="form-control" id="email1" name="email1" value="">
	  					</div>

	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="email2">Correo electronico:</label>
	  						<input type="email" class="form-control" id="email2" name="email2" value="">
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
@endsection