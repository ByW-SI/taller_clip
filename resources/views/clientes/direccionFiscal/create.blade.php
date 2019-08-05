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
				</div>
			</div>
		</div>
		<ul role="tablist" class="nav nav-tabs">
			<li><a href="{{ route('clientes.show', ['cliente' => $cliente]) }}">Dirección Física</a></li>
			<li class="active"><a href="{{ route('clientes.direccionFiscal.index', ['cliente' => $cliente]) }}" >Dirección Fiscal</a></li>
			<li><a href="{{ route('clientes.direccionEntrega.index', ['cliente' => $cliente]) }}">Dirección de Entrega</a></li>
			{{-- <li><a href="{{ route('clientes.descuentos.index', ['cliente' => $cliente]) }}">Descuentos</a></li> --}}
			<li><a href="{{ route('clientes.crm.index', ['cliente' => $cliente]) }}">CRM</a></li>
			<li><a href="{{route('clientes.datosgenerales.index',['cliente' => $cliente])}}">Datos Generales</a></li>
		</ul>
		<form action="{{ route('clientes.direccionFiscal.store', ['cliente' => $cliente]) }}" method="post">
			{{ csrf_field() }}
			<div class="panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-3">	
							<label class="control-label" for="calle" id="lbl_calle">Calle:</label>
							<input type="text" class="form-control" id="calle" name="calle">
						</div>
						<div class="form-group col-sm-3">	
							<label class="control-label" for="numext" id="lbl_numext">Número Exterior:</label>
							<input type="number" class="form-control" id="numext" name="numext">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="numinter">Número Interior:</label>
							<input type="number" class="form-control" id="numinter" name="numinter">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="cp" id="lbl_cp">Código Postal:</label>
							<input type="number" class="form-control" id="cp" name="cp">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-3">
							<label class="control-label" for="colonia" id="lbl_colonia">Colonia:</label>
							<input type="text" class="form-control" id="colonia" name="colonia">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="municipio" id="lbl_municipio">Municipio/Delegación:</label>
							<input type="text" class="form-control" id="municipio" name="municipio">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="ciudad" id="lbl_ciudad">Ciudad:</label>
							<input type="text" class="form-control" id="ciudad" name="ciudad">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="estado" id="lbl_estado">Estado:</label>
							<input type="text" class="form-control" id="estado" name="estado">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label" for="calle1">Entre calles:</label>
							<input type="text" class="form-control" id="calle1" name="calles" placeholder="Calle 1, Calle 2">
						</div>
						<div class="col-sm-3">
							<label class="control-label" for="referencia">Referencia:</label>
							<input type="text" class="form-control" id="referencia" name="referencia">
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Guardar</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

@endsection

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">

	function copiarInformacionFisica(e){
		e.preventDefault();
		console.log("COPIAR");
	}

</script>