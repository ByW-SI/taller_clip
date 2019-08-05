@extends('layouts.blank')
@section('content')

<div class="container-fluid">
	<div role="application" class="panel panel-group">
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Cliente:</h4>
					</div>
					<div class="col-sm-4 text-center">
						<a href="{{ route('clientes.create') }}" class="btn btn-success">
							<i class="fa fa-plus" aria-hidden="true"></i><strong> Agregar Cliente</strong>
						</a>
					</div>
					<div class="col-sm-4 text-center">
						<a href="{{ route('clientes.index') }}" class="btn btn-warning">
							<i class="fa fa-bars" aria-hidden="true"></i><strong> Lista de Clientes</strong>
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
					@if ($cliente->tipopersona == "Fisica")
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
				</div>
				<div class="row">
					<div class="form-group col-sm-3">
						<label class="control-label" for="telefono">Contacto Principal:</label>
						<dd>{{ $cliente->contactop }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="mail">Correo:</label>
						<dd>{{ $cliente->mail }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="rfc">RFC:</label>
						<dd>{{ $cliente->rfc }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="telefono">Telefono de Casa:</label>
						<dd>{{ $cliente->tel_casa }}</dd>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label" for="telefono">Telefono de Oficina:</label>
						<dd>{{ $cliente->tel_oficina }}</dd>
					</div>
					<div class="col-sm-3">
						<label class="control-label" for="celular">Telefono Celular:</label>
						<dd>{{ $cliente->tel_celular }}</dd>
					</div>
					<div class="col-sm-3">
						<label class="control-label" for="celular">Forma de contacto:</label>
						<dd>{{ $cliente->formac }}</dd>
					</div>
				</div>
			</div>
		</div>
		<ul role="tablist" class="nav nav-tabs">
			<li class="active"><a href="{{ route('clientes.show', ['cliente' => $cliente]) }}">Dirección Física</a></li>
			<li><a href="{{ route('clientes.direccionFiscal.index', ['cliente' => $cliente]) }}" >Dirección Fiscal</a></li>
			<li><a href="{{ route('clientes.direccionEntrega.index', ['cliente' => $cliente]) }}">Dirección de Entrega</a></li>
			{{-- <li><a href="{{ route('clientes.descuentos.index', ['cliente' => $cliente]) }}">Descuentos</a></li> --}}
			<li><a href="{{ route('clientes.crm.index', ['cliente' => $cliente]) }}">CRM</a></li>
			<li><a href="{{ route('clientes.contacto.index', ['cliente' => $cliente]) }}">Contactos:</a></li>
			<li><a href="{{route('clientes.datosgenerales.index',['cliente' => $cliente])}}">Datos Generales</a></li>
			
		</ul>
		<div class="panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="form-group col-sm-3">	
						<label class="control-label" for="calle">Calle:</label>
						<dd>{{ $cliente->calle }}</dd>
					</div>
					<div class="form-group col-sm-3">	
						<label class="control-label" for="numext" >Número Exterior:</label>
						<dd>{{ $cliente->numext }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="numinter">Número Interior:</label>
						<dd>{{ $cliente->numinter }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="cp">Código Postal:</label>
						<dd>{{ $cliente->cp }}</dd>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-3">
						<label class="control-label" for="colonia">Colonia:</label>
						<dd>{{ $cliente->colonia }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="municipio">Municipio/Delegación:</label>
						<dd>{{ $cliente->municipio }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="ciudad">Ciudad:</label>
						<dd>{{ $cliente->ciudad }}</dd>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" for="estado">Estado:</label>
						<dd>{{ $cliente->estado }}</dd>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label" for="calle1">Entre calles:</label>
						<dd>{{ $cliente->calles }}</dd>
					</div>
					<div class="col-sm-3">
						<label class="control-label" for="referencia">Referencia:</label>
						<dd>{{ $cliente->referencia }}</dd>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-12 text-center">
						<a class="btn btn-danger btn-md" href="{{ route('clientes.edit', ['cliente' => $cliente]) }}">
							<i class="fa fa-check-pencil" aria-hidden="true"></i> Editar
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection