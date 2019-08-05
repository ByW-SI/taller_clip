@extends('layouts.blank')
@section('content')

<div class="container-fluid">
	<form role="form" id="form-cliente" method="POST" action="{{ route('clientes.store') }}" name="form">
		{{ csrf_field() }}
		<div role="application" class="panel panel-group">
			<div class="panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4">
							<h4>Datos del Cliente:</h4>
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
	    						<option id="Fisica" value="Fisica" selected="">Fisica</option>
	    						<option id="Moral" value="Moral">Moral</option>
	    					</select>
	  					</div>
						<div id="perfisica">
							<div class="form-group col-sm-3">
		  						<label class="control-label" for="nombre">✱Nombre(s):</label>
		  						<input  type="text" class="form-control" id="idnombre" name="nombre" required="">
		  					</div>
		  					<div class="form-group col-sm-3">
		  						<label class="control-label" for="apellidopaterno">✱Apellido Paterno:</label>
		  						<input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" required="">
		  					</div>
		  					<div class="form-group col-sm-3">
		  						<label class="control-label" for="apellidomaterno">Apellido Materno:</label>
		  						<input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno">
		  					</div>
						</div>
						<div id="permoral" style="display:none;">
							<div class="form-group col-sm-3">
		  						<label class="control-label" for="razonsocial">✱Razon Social:</label>
		  						<input type="text" class="form-control" id="razonsocial" name="razonsocial">
		  					</div>
						</div>
					</div>
					<div class="row">
	  					<div class="form-group col-sm-3">
	  						<label class="control-label" for="contactop">Contacto Principal:</label>
	  						<input type="text" class="form-control" id="contactop" name="contactop">
	  					</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="mail"> Correo:</label>
							<input type="email" class="form-control" id="mail" name="mail" >
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="rfc"> RFC:</label>
							<input type="text" class="form-control" id="varrfc" name="rfc"  minlength="12" maxlength="13" pattern="^[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" placeholder="Ingrese 13 caracteres" title="Siga el formato 4 letras seguidas por 6 digitos y 3 caracteres">
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label" for="telefono">Teléfono de Casa:</label>
							<input type="number" class="form-control" name="tel_casa" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label" for="telefono">Teléfono de Oficina:</label>
							<input type="number" class="form-control" name="tel_oficina" >
						</div>
						<div class="col-sm-3">
							<label class="control-label" for="telefono">Teléfono Celular:</label>
							<input type="number" class="form-control" name="tel_celular" >
						</div>
						<div class="col-sm-3">
							<label class="control-label" for="formac">Forma de contacto:</label>
							{{-- <input type="text" class="form-control" name="formac" > --}}
							<select name="formac" class="form-control">
								<option value="">Seleccionar</option>
								@foreach ($formas_contacto as $forma_contacto)
									<option value="{{$forma_contacto->nombre}}">{{$forma_contacto->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
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