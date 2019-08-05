@extends('layouts.blank')
@section('content')

<div class="container-fluid">
	<form role="form" id="form-cliente" method="POST" action="{{ route('clientes.update',['cliente' => $cliente]) }}" name="form">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT">
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
	    					<select type="select" name="tipopersona" class="form-control" id="tipopersona" onchange="persona(this)">
	    						<option id="Fisica" value="Fisica" @if($cliente->tipopersona == "Fisica") selected="" @endif>Fisica</option>
	    						<option id="Moral" value="Moral" @if($cliente->tipopersona == "Moral") selected="" @endif>Moral</option>
	    					</select>
	  					</div>
						<div id="perfisica" @if($cliente->tipopersona == "Moral") style="display: none;" @endif>
							<div class="form-group col-sm-3">
		  						<label class="control-label" for="nombre">✱Nombre(s):</label>
		  						<input  type="text" class="form-control" id="idnombre" name="nombre" @if($cliente->tipopersona == "Fisica") required="" @endif value="{{ $cliente->nombre }}">
		  					</div>
		  					<div class="form-group col-sm-3">
		  						<label class="control-label" for="apellidopaterno">✱Apellido Paterno:</label>
		  						<input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" @if($cliente->tipopersona == "Fisica") required="" @endif value="{{ $cliente->apellidopaterno }}">
		  					</div>
		  					<div class="form-group col-sm-3">
		  						<label class="control-label" for="apellidomaterno">Apellido Materno:</label>
		  						<input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" value="{{ $cliente->apellidomaterno }}">
		  					</div>
						</div>
						<div id="permoral" @if($cliente->tipopersona == "Fisica") style="display: none;" @endif>
							<div class="form-group col-sm-3">
		  						<label class="control-label" for="razonsocial">✱Razon Social:</label>
		  						<input type="text" class="form-control" id="razonsocial" name="razonsocial" @if($cliente->tipopersona == "Moral") required="" @endif value="{{ $cliente->razonsocial }}">
		  					</div>
						</div>
					</div>
					<div class="row">
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="contactop">Contacto Principal:</label>
	  						<input type="text" class="form-control" id="contactop" name="contactop" value="{{ $cliente->contactop }}">
	  					</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="mail"> Correo:</label>
							<input type="email" class="form-control" id="mail" name="mail" value="{{ $cliente->mail }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="rfc"> RFC:</label>
							<input type="text" class="form-control" id="varrfc" name="rfc"  minlength="12" maxlength="13" pattern="^[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" placeholder="Ingrese 13 caracteres" title="Siga el formato 4 letras seguidas por 6 digitos y 3 caracteres" value="{{ $cliente->rfc }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="telefono">Teléfono de Casa:</label>
							<input type="number" class="form-control" name="tel_casa" value="{{ $cliente->tel_casa }}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label" for="telefono">Teléfono de Oficina:</label>
							<input type="number" class="form-control" name="tel_oficina" value="{{ $cliente->tel_oficina }}">
						</div>
						<div class="col-sm-3">
							<label class="control-label" for="telefono">Teléfono Celular:</label>
							<input type="number" class="form-control" name="tel_celular" value="{{ $cliente->tel_celular }}">
						</div>
						<div class="col-sm-3">
							<label class="control-label" for="formac">Forma de contacto:</label>
							<input type="text" class="form-control" name="formac" >
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
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4">
							<h5>Dirección Física:</h5>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-3">	
							<label class="control-label" for="calle" id="lbl_calle">Calle:</label>
							<input type="text" class="form-control" id="calle" name="calle" value="{{ $cliente->calle }}">
						</div>
						<div class="form-group col-sm-3">	
							<label class="control-label" for="numext" id="lbl_numext">Número Exterior:</label>
							<input type="number" class="form-control" id="numext" name="numext" value="{{ $cliente->numext }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="numinter">Número Interior:</label>
							<input type="number" class="form-control" id="numinter" name="numinter" value="{{ $cliente->numinter }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="cp" id="lbl_cp">Código Postal:</label>
							<input type="number" class="form-control" id="cp" name="cp" value="{{ $cliente->cp }}">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-3">
							<label class="control-label" for="colonia" id="lbl_colonia">Colonia:</label>
							<input type="text" class="form-control" id="colonia" name="colonia" value="{{ $cliente->colonia }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="municipio" id="lbl_municipio">Municipio/Delegación:</label>
							<input type="text" class="form-control" id="municipio" name="municipio" value="{{ $cliente->municipio }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="ciudad" id="lbl_ciudad">Ciudad:</label>
							<input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $cliente->ciudad }}">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="estado" id="lbl_estado">Estado:</label>
							<input type="text" class="form-control" id="estado" name="estado" value="{{ $cliente->estado }}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label" for="calle1">Entre calles:</label>
							<input type="text" class="form-control" id="calle1" name="calles" placeholder="Calle 1, Calle 2" value="{{ $cliente->calles }}">
						</div>
						<div class="col-sm-3">
							<label class="control-label" for="referencia">Referencia:</label>
							<input type="text" class="form-control" id="referencia" name="referencia" value="{{ $cliente->referencia }}">
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
		</div>
	</form>
</div>
@endsection