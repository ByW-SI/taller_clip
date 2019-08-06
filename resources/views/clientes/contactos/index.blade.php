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
			<ul role="tablist" class="nav nav-tabs">
				<li><a href="{{ route('clientes.show', ['cliente' => $cliente]) }}">Dirección Física</a></li>
				<li><a href="{{ route('clientes.direccionFiscal.index', ['cliente' => $cliente]) }}" >Dirección Fiscal</a></li>
				<li><a href="{{ route('clientes.direccionEntrega.index', ['cliente' => $cliente]) }}">Dirección de Entrega</a></li>
				{{-- <li><a href="{{ route('clientes.descuentos.index', ['cliente' => $cliente]) }}">Descuentos</a></li> --}}
				<li><a href="{{ route('clientes.crm.index', ['cliente' => $cliente]) }}">CRM</a></li>
				<li class="active"><a href="{{ route('clientes.contacto.index', ['cliente' => $cliente]) }}">Contactos:</a></li>
				<li><a href="{{route('clientes.datosgenerales.index',['cliente' => $cliente])}}">Datos Generales</a></li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4">
							<h5>Contactos:</h5>
						</div>
						<div class="col-sm-4 text-center">
							<a type="button" class="btn btn-success" href="{{ route('clientes.contacto.create', ['cliente' => $cliente]) }}">
								<strong>Agregar</strong>
							</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					@if(count($contactos) == 0)
						<h4>Aún no tienes contactos</h4>
					@else
						<table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px">
							<tr class="info">
								<th>Nombre del contacto</th>
								<th>Telefono Directo</th>
								<th>Celular</th>
								<th>Correo Electronico</th>
								<th>Operaciones</th>
							</tr>
							@foreach ($contactos as $contacto)
								<tr class="active">
									<td>{{ $contacto->nombre }} {{ $contacto->apater }} {{ $contacto->amater }}</td>
									<td>{{ $contacto->telefonodir }}</td>
									<td>{{ $contacto->celular1 }}</td>
									<td>{{ $contacto->email1 }}</td>
									<td>
										<a class="btn btn-success btn-sm" href="{{ route('clientes.contacto.show', ['cliente' => $cliente, 'contacto' => $contacto]) }}">
											<strong>Ver</strong>
										</a>
										<a class="btn btn-info btn-sm" href="{{ route('clientes.contacto.edit', ['cliente' => $cliente, 'contacto' => $contacto]) }}">
											<strong>Editar</strong>
										</a>
										<form role="form" method="POST" action="{{ route('clientes.contacto.destroy', ['cliente' => $cliente, 'contactoid' => $contacto]) }}">
											{{ csrf_field() }}
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" class="btn btn-danger btn-sm" >
												<strong>Borrar</strong>
											</button>
										</form>
									</td>
								</tr>
							@endforeach
						</table>
					@endif
				</div>
			</div>
		</div>
</div>

@endsection