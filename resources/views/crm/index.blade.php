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
			<li><a href="{{ route('clientes.direccionFiscal.index', ['cliente' => $cliente]) }}" >Dirección Fiscal</a></li>
			<li><a href="{{ route('clientes.direccionEntrega.index', ['cliente' => $cliente]) }}">Dirección de Entrega</a></li>
			{{-- <li><a href="{{ route('clientes.descuentos.index', ['cliente' => $cliente]) }}">Descuentos</a></li> --}}
			<li class="active"><a href="{{ route('clientes.crm.index', ['cliente' => $cliente]) }}">CRM</a></li>
			<li><a href="{{route('clientes.datosgenerales.index',['cliente' => $cliente])}}">Datos Generales</a></li>
		</ul>
		<form id="crmdesdeanterior" role="form" method="POST" action="{{ route('clientes.crm.store',['cliente'=>$cliente]) }}">
			{{ csrf_field() }}
			<input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
			<div class="panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-4">
							<label class="control-label" for="fecha_act">Fecha Actual:</label>
							<input type="date" class="form-control" id="fecha_act" name="fecha_act" value="{{ date('Y-m-d') }}" readonly>
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label" for="fecha_cont">✱Fecha siguiente contacto:</label>
							<input type="date" class="form-control" id="fecha_cont" name="fecha_cont" required="required" value="">
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label" for="fecha_aviso">✱Fecha Aviso:</label>
							<input type="date" class="form-control" id="fecha_aviso" name="fecha_aviso" required="required" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-4">
							<label class="control-label" for="hora">Hora:</label>
							<input required type="text" class="form-control" id="hora" name="hora" name="hora" value="">
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label" for="tipo_cont">Forma de contacto:</label>
							<select required  class="form-control" type="select" name="tipo_cont" id="tipo_cont" >
								<option value="" selected="">Seleccionar</option>
								<option id="Mail" value="Mail">Email/Correo Electronico</option>
								<option id="Telefono" value="Telefono">Telefono</option>
								<option id="Cita" value="Cita">Cita</option>
								<option id="Whatsapp" value="Whatsapp">Whatsapp</option>
								<option id="Otro" value="Otro">Otro</option>
							</select>
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label" for="status">Estado:</label>
							<select required  class="form-control" type="select" name="status" id="status" >
								<option value="" selected="">Seleccionar</option>
								<option id="Pendiente" value="Pendiente">Pendiente</option>
								<option id="Cotizando" value="Cotizando">En Cotización</option>
								<option id="Cancelado" value="Cancelado">Cancelado</option>
								<option id="Toma_decision" value="Toma_decision">Tomando decisión</option>
								<option id="Espera" value="Espera">En espera</option>
								<option id="Revisa_doc" value="Revisa_doc">Revisando documento</option>
								<option id="Proceso_aceptar" value="Proceso_aceptar">Proceso de Aceptación</option>
								<option id="Entrega" value="Entrega">Para entrega</option>
								<option id="Otro" value="Otro">Otro</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-4">
							<label class="control-label" for="acuerdos">✱Acuerdos: </label>
							<textarea required class="form-control" rows="5" id="acuerdos" name="acuerdos" maxlength="500"></textarea>
						</div>

						<div class="form-group col-sm-4">
							<label class="control-label" for="comentarios">✱Comentarios: </label>
							<textarea required class="form-control" rows="5" id="comentarios" name="comentarios" maxlength="500"></textarea>
						</div>

						<div class="form-group col-sm-4">
							<label class="control-label" for="observaciones">✱Observaciones: </label>
							<textarea required class="form-control" rows="5" id="observaciones" name="observaciones" maxlength="500"></textarea>
						</div>
					</div>
				</div>
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4 text-center">
							<a class="btn btn-danger" id="limpiar" onclick="limpiar()">
								<i class="fa fa-refresh" aria-hidden="true"></i> Limpiar
							</a>
							<a id="modificar" class="btn btn-default" onclick="modificar()" style="display: none;">
								<i class="fa fa-plus" aria-hidden="true"></i> Nuevo
							</a>
							<button id="submit" type="submit" class="btn btn-success">
								<i class="fa fa-check-circle" aria-hidden="true"></i> Guardar
							</button>
						</div>
						<div class="col-sm-4 text-right text-danger">
							<h5>✱Campos Requeridos</h5>
						</div>
					</div>
				</div>
				<div class="panel-body">
					@if (count($crms) > 0)
						<table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
							<tr class="info">
								<th>Fecha contacto</th>
								<th>Fecha aviso</th>
								<th>Hora</th>
								<th>Estado</th>
								<th>Forma de contacto</th>
								<th>Operación</th>
							</tr>
							@foreach ($crms as $crm)
								<tr>
									<td>{{ $crm->fecha_cont }}</td>
									<td>{{ $crm->fecha_aviso }}</td>
									<td>{{ $crm->hora }}</td>
									<td>{{ $crm->status }}</td>
									<td>{{ $crm->tipo_cont }}</td>
									<td class="text-center">
										<a class="btn btn-primary" onclick="crm({{ $crm }})">
											<i class="fa fa-check-circle" aria-hidden="true"></i> Ver
										</a>
									</td>
								</tr>
							@endforeach
						</table>
					@else
						<h5>Aún no tienes CRMs</h5>
					@endif	
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	
	function crm(elemento) {
		document.getElementById("fecha_cont").value = elemento.fecha_cont;
		document.getElementById("fecha_cont").disabled = true;
		document.getElementById("fecha_aviso").value = elemento.fecha_aviso;
		document.getElementById("fecha_aviso").disabled = true;
		document.getElementById("hora").value = elemento.hora;
		document.getElementById("hora").disabled = true;
		document.getElementById("tipo_cont").value = elemento.tipo_cont;
		document.getElementById('tipo_cont').disabled = true;
		document.getElementById('status').value = elemento.status;
		document.getElementById('status').disabled = true;
		document.getElementById('acuerdos').value = elemento.acuerdos;
		document.getElementById('acuerdos').disabled = true;
		document.getElementById('comentarios').value = elemento.comentarios;
		document.getElementById('comentarios').disabled = true;
		document.getElementById('observaciones').value = elemento.observaciones;
		document.getElementById('observaciones').disabled = true;
		document.getElementById('submit').disabled= true
		document.getElementById('modificar').style.display = ''
		document.getElementById('limpiar').style.display = 'none';
	}
	
	function modificar() {
		document.getElementById("crmdesdeanterior").reset();
		document.getElementById("fecha_cont").disabled = false;
		document.getElementById("fecha_aviso").disabled = false;
		document.getElementById("hora").disabled = false;
		document.getElementById("tipo_cont").disabled = false;
		document.getElementById("status").disabled = false;
		document.getElementById("acuerdos").disabled = false;
		document.getElementById("comentarios").disabled = false;
		document.getElementById("observaciones").disabled = false;
		document.getElementById("submit").disabled = false;
		document.getElementById('modificar').style.display = 'none'
		document.getElementById('limpiar').style.display = '';
	}

	function limpiar() {
		document.getElementById("fecha_cont").value = '';
		document.getElementById("fecha_aviso").value = '';
		document.getElementById("hora").value = '';
		document.getElementById("tipo_cont").value = '';
		document.getElementById('status').value = '';
		document.getElementById('acuerdos').value = '';
		document.getElementById('comentarios').value = '';
		document.getElementById('observaciones').value = '';
	}

</script>

@endsection