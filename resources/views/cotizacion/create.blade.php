@extends('layouts.cotizacion')
@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<h5>Crear Cotización:</h5>
			</div>
		</div>
		<div class="card-body">
			@if (session("alert"))
			<div class="alert alert-{{session("alert")['class']}} alert-dismissible fade show" role="alert">
				{{session('alert')['message']}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			<form role="form" method="POST" id="formcotizacion"
				action="{{$edit ? route('cotizacion.update',['cotizacion'=>$cotizacion]) : route('cotizacion.store')}}">
				{{csrf_field()}}
				@if ($edit)
				{{method_field('PUT')}}
				@endif
				<div class="row">
					<div class="col-sm-3 form-group">
						<label class="control-label">Cliente destino:</label>
						<select required class="form-control" name="cliente_id" onchange="searchDescuentos(this.value)">
							<option value="">Selecciona el cliente</option>
							@foreach ($clientes as $cliente)
							<option value="{{$cliente->id}}">
								{{($cliente->tipopersona == "Moral" ? $cliente->razonsocial : $cliente->nombre." ".$cliente->apellidopaterno." ".$cliente->apellidomaterno)}}
							</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Número de cotización:</label>
						<input required readonly type="number" class="form-control" name="nocotizacion"
							id="nocotizacion" value="{{$nocotizaciones}}" placeholder="Ejemp: 0001">
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Fecha:</label>
						<input required type="date" readonly class="form-control" name="fechaactual" id="fechaactual"
							value="{{date('Y-m-d')}}">
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Fecha de entrega:</label>
						<input required type="date" class="form-control" name="fechaentrega" id="fechaentrega"
							min="{{date('Y-m-d')}}">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label class="control-label">Correo de cliente:</label>
						<input required type="text" class="form-control" name="correo" id="correo"
							placeholder="Sin correo">
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
									href="#nav-obras" role="tab" aria-controls="nav-home">Obras</a>
								{{-- <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab"
									href="#nav-mano_de_obra" role="tab" aria-controls="nav-home">Mano de obra</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-varios"
									role="tab" aria-controls="nav-profile">Varios</a>
								<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-envios"
									role="tab" aria-controls="nav-contact">Envíos</a> --}}
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">

							<div class="tab-pane fade show active" id="nav-obras" role="tabpanel">
								<div class="card">
									<div class="card-header">
										<h5>Ordenes:</h5>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-4 form-group">
												<label class="control-label">Órdenes de Cliente:</label>
												<select required class="form-control" id="cliente_id">
													<option value="">Selecciona el cliente</option>
													@foreach ($clientes as $cliente)
													<option value="{{$cliente->id}}">
														{{($cliente->tipopersona == "Moral" ? $cliente->razonsocial : $cliente->nombre." ".$cliente->apellidopaterno." ".$cliente->apellidomaterno)}}
													</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="row">
											<table class="table table-striped table-bordered">
												<tbody id="ordenesdelcliente">

												</tbody>
											</table>
										</div>
									</div>
									<div class="card-footer text-muted">
										<div class="row">
											<table class="table table-striped table-bordered">
												<thead>
													<tr class="table-info">
														<th scope="col" colspan="7">Orden en cotización</th>
													</tr>
													<tr class="table-info">
														<th scope="col">Número</th>
														<th scope="col">Orden</th>
														<th scope="col">Fecha</th>
														<th scope="col" colspan="2">Descripción</th>
														<th scope="col">Precio</th>
														<th scope="col">Acción</th>
													</tr>
													<tr>
												</thead>
												<tbody id="myOrdenes"></tbody>
											</table>
										</div>
										<div class="row">
											<div class="col-4">
												<label for="totalordenes">Suma de ordenes</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<label readonly type="number" step="0.01" class="form-control"
														id="totalordenes"></label>
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
												<label for="desordenes">Descuento de ordenes</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" step="0.01" class="form-control" value="0" onchange="calcular()" id="descuento_ordenes">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
													<label for="ganancia_ordenes">Ganancia de ordenes</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text">$</span>
														</div>
														<input type="number" step="0.01" class="form-control" value="0" onchange="calcular()"
															id="ganancia_ordenes">
														<div class="input-group-append">
															<span class="input-group-text">MXN</span>
														</div>
													</div>
												</div>
											
										</div>
									</div>
								</div>


							</div>
							{{-- <div class="tab-pane fade" id="nav-mano_de_obra" role="tabpanel">

								<div class="card">
									<div class="card-header">
										<h5>Mano de obra:</h5>
									</div>
									<div class="card-body">
										<div class="row" id="smanodeobra">
											<div class="col-4 form-group">
												<label class="control-label">Nombre:</label>
												<input type="text" class="form-control" id="nombremanodeobra">
											</div>
											<div class="col-4 form-group">
												<label class="control-label">Descripción:</label>
												<textarea type="text" class="form-control"
													id="desmanodeobra"></textarea>
											</div>
											<div class="col-4 form-group">
												<label class="control-label">Puesto:</label>
												<input type="text" class="form-control" id="puestomanodeobra">
											</div>
											<div class="col-4 form-group">
												<label class="control-label">Venta</label>
												<input type="number" step="0.01" step="0.01" class="form-control"
													id="montomanodeobra">
											</div>
											<div class="col-4 form-group">
												<label class="control-label">Costo</label>
												<input type="number" step="0.01" step="0.01" class="form-control"
													id="costomanodeobra">
											</div>
											<div class="col-4 form-group pt-4 text-center">
												<button id="agregarmanodeobra" type="button"
													class="btn btn-primary">Agregar</button>
											</div>
										</div>
										<div class="row">
											<table class="table table-striped table-bordered">
												<thead>
													<tr class="table-info">
														<th scope="col">Nombre</th>
														<th scope="col">Puesto</th>
														<th scope="col">Descripción</th>
														<th scope="col">Venta</th>
														<th scope="col">Costo</th>
														<th scope="col">Total</th>
														<th scope="col">Eliminar</th>
													</tr>
												</thead>
												<tbody id="tablamanodeobras">
												</tbody>
											</table>
										</div>
									</div>
									<div class="card-footer text-muted">
										<div class="row">
											<div class="col-4">
												<label for="totalmanodeobra">Suma mano de obra</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<label readonly type="number" step="0.01" class="form-control"
														id="totalmanodeobra">0.0</label>
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
												<label for="descmano">Descuento mano obra</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" value="0" step="0.01" class="form-control" onchange="calcular()"
														id="descuento_manodeobra">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
												<label for="ganancia_manodeobra">Ganancia mano obra</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" value="0" step="0.01" class="form-control" onchange="calcular()"
														id="ganancia_manodeobra">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-varios" role="tabpanel">
								<div class="card">
									<div class="card-header">
										<h5>Varios:</h5>
									</div>
									<div class="card-body">
										<div class="row" id="svarios">
											<div class="col-3 form-group">
												<label class="control-label">Descripción:</label>
												<input type="text" class="form-control" id="desvario">
											</div>
											<div class="col-3 form-group">
												<label class="control-label">Venta:</label>
												<input type="number" step="0.01" class="form-control" id="montovario">
											</div>
											<div class="col-3 form-group">
												<label class="control-label">Costo:</label>
												<input type="number" step="0.01" class="form-control" id="costovario">
											</div>
											<div class="col-3 form-group">
												<button id="agregarvario" type="button"
													class="mt-4 btn btn-primary">Agregar</button>
											</div>
										</div>
										<div class="row">
											<table class="table  table-striped table-bordered">
												<thead class="table-info">
													<tr>
														<th scope="col">Descripción</th>
														<th scope="col">Venta</th>
														<th scope="col">Costo</th>
														<th scope="col">Total</th>
														<th scope="col">Eliminar</th>
													</tr>
												</thead>
												<tbody id="tablavarios">
												</tbody>
											</table>
										</div>
									</div>
									<div class="card-footer text-muted">
										<div class="row">
											<div class="col-4">
												<label for="totlavario">Suma varios</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<label readonly type="number" step="0.01" class="form-control"
														id="totalvarios"></label>
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
												<label for="desvario">Descuento Varios</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" value="0" step="0.01" class="form-control" onchange="calcular()"
														id="descuento_varios">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											
											<div class="col-4">
												<label for="ganancia_varios">Ganancia Varios</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" value="0" step="0.01" class="form-control" onchange="calcular()"
														id="ganancia_varios">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>


							</div>
							<div class="tab-pane fade" id="nav-envios" role="tabpanel">

								<div class="card">
									<div class="card-header">
										<h5>Envios:</h5>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-3 form-group">
												<label class="control-label">Descripción:</label>
												<input type="text" class="form-control" id="desenvio">
											</div>
											<div class="col-3 form-group">
												<label class="control-label">Venta:</label>
												<input type="number" step="0.01" class="form-control" id="montoenvio">
											</div>
											<div class="col-3 form-group">
												<label class="control-label">Costo:</label>
												<input type="number" step="0.01" class="form-control" id="costoenvio">
											</div>
											<div class="col-3 form-group">
												<label class="control-label">Dirección:</label>
												<textarea class="form-control" id="direccionenvio" rows="3"></textarea>
											</div>
											<div class="col-3 form-group">
												<button id="agregarenvio" type="button" class="mt-4 btn btn-primary">
													Agregar
												</button>
											</div>
										</div>
										<div class="row">
											<table class="table table-striped table-bordered">
												<thead class="table-info">
													<tr>
														<th scope="col">Dirección</th>
														<th scope="col">Descripción</th>
														<th scope="col">Venta</th>
														<th scope="col">Costo</th>
														<th scope="col">Total</th>
														<th scope="col">Eliminar</th>
													</tr>
												</thead>
												<tbody id="tablaenvios">
												</tbody>
											</table>
										</div>
									</div>
									<div class="card-footer text-muted">
										<div class="row">
											<div class="col-4">
												<label for="totalenvio">Suma envíos</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<label readonly type="number" step="0.01" class="form-control"
														id="totalenvios"></label>
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
												<label for="descenvio">Descuento Envios</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" value="0" step="0.01" class="form-control" onchange="calcular()"
														id="descuento_envios">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
											<div class="col-4">
												<label for="ganancia_envios">Ganancia Envios</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" value="0" step="0.01" class="form-control" onchange="calcular()"
														id="ganancia_envios">
													<div class="input-group-append">
														<span class="input-group-text">MXN</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
 --}}						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<h4>Total:</h4>
				</div>
				<div class="row">
					<div class="col-sm-3 form-group">
						<label for="inputtotalordenes" class="control-label">Total orden(es):</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="totalordenes"
							id="inputtotalordenes">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div>
					{{-- <div class="col-sm-3 form-group">
						<label for="tmanodeobra" class="control-label">Total mano(s) de obra(s):</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="totalmanodeobra"
								id="tmanodeobra" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div>
					<div class="col-sm-3 form-group">
						<label for="tvarios" class="control-label">Total varios:</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="totalvarios"
								id="tvarios" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div>
					<div class="col-sm-3 form-group">
						<label for="tenvios" class="control-label">Total envio(s):</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="totalenvios"
								id="tenvios" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div> --}}
				</div>
				<!--########################## Ganancias del pryecto#######################-->
				<div class="row">
					<h4>Ganancias:</h4>
				</div>
				<div class="row">
					<div class="col-sm-3 text form-group">
						<label for="tenvios" class="control-label">Ganancia orden(s):</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="Ganancia_orden"
								id="gordenes" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div>
					{{-- <div class="col-sm-3 text form-group">
						<label for="tenvios" class="control-label">Ganancia mano(s) de obra(s):</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="Ganancia_manodeobra"
								id="gmanodeobra" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div>
					<div class="col-sm-3 text form-group">
						<label for="tenvios" class="control-label">Ganancia varios:</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="Ganancia_varios"
								id="gvarios" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div>
					<div class="col-sm-3 text form-group">
						<label for="tenvios" class="control-label">Ganancia envio(s):</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input readonly type="number" step="0.01" class="form-control" name="Gananciaenvios"
								id="genvios" value="0">
							<div class="input-group-append">
								<span class="input-group-text">MXN</span>
							</div>
						</div>
					</div> --}}
				</div>
				<div class="row">
					<div class="form-group col-3">
						<label for="totalproyecto">Venta Proyecto</label>
						<input required readonly form="formcotizacion" name="totalproyecto" type="number" step="0.01"
							class="form-control" id="totalproyecto">
					</div>
					<div class="form-group col-3 pt-4 ">
						<div class="form-check">
							<input required form="formcotizacion" class="form-check-input" type="radio" name="iva"
								id="coniva" value="16">
							<label class="form-check-label" for="coniva">
								con IVA
							</label>
						</div>
						<div class="form-check">
							<input required form="formcotizacion" class="form-check-input" type="radio" name="iva"
								id="siniva" value="1">
							<label class="form-check-label" for="siniva">
								sin IVA
							</label>
						</div>
					</div>
					<div class="form-group col col-md-3">
						<label for="totalneto">Ganacia Neto:</label>
						<input required readonly form="formcotizacion" type="number" step="0.01" name="ganancianeto"
							class="form-control" id="ganancianeto">
					</div>
					<div class="form-group col col-md-3">
						<label for="totalneto">Total Neto:</label>
						<input required readonly form="formcotizacion" type="number" step="0.01" name="totalneto"
							class="form-control" id="totalneto">
					</div>
				</div>
				
				<div class="row">
					<label class="switch ">
						<input type="checkbox" name="PDF" value="1" >Generar PDF
					</label>
					<div class="col-sm-12 text-center form-group">			
						<button id="submit" type="submit" onclick="checar()"
							class="btn btn-success"><strong>Guardar</strong></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function checar() {
		if ($('#tablamanodeobras').children().length == 0) {
			// swal({
			//     type: 'error',
			//     title: 'Ups...',
			//     text: 'Ingresa por lo menos una mano de obra!'
			//   });
			//return false;
		}
		if ($('#myOrdenes').children().length == 0) {
			swal({
				type: 'error',
				title: 'Ups...',
				text: 'Ingresa por lo menos una orden!'
			});
			return false;
		}
		return false;
	}
	$('#cliente_id').change(function () {
		$('#ordenesdelcliente').empty();
		var cliente = $(this).val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/buscarordenporcliente') }}",
			data: {
				cliente_id: cliente
			},
			type: "GET",
			dataType: "html",
		}).done(function (resultado) {
			$("#ordenesdelcliente").html(resultado);
		});

	});

	var totalcotizacion = 0.00;
	function addOrden(orden) {
		console.log(orden);
		var rowHTML =
			`<tr id="row${orden.id}">
          <td scope="row">
              ${orden.noorden}
          </td>
          <td>${orden.nombre}</td>
          <td>${orden.fecha}</td>
          <td colspan="2">${orden.descripcion}</td>
          <td>
          	<input type="hidden" class="gananciaO" value="${orden.ganancia_orden}">
          	$${orden.precio_orden}
          </td>
          <td>
          	<input type="hidden" class="costos_orden" value="${orden.ganancia_orden}">
            <input type="hidden" name="ordenes[]" value="${orden.id}">
              <div class="row mt-1 mb-1 justify-content-md-center">
                  <a href="#" onclick="removeOrden('row${orden.id}',${orden.precio_orden})" class="btn btn-danger remove_button">
                      Eliminar
                  </a>
              </div>
          </td>
          
      </tr>`;
		$("#myOrdenes").append(rowHTML);
		totalcotizacion = +totalcotizacion + +parseFloat(orden.precio_orden);
		$("#totalordenes").text(totalcotizacion.toFixed(2));
		$('#cliente_id').val('');
		$('#ordenesdelcliente').empty();
		calcular();
	}
	function removeOrden(id, precio) {
		totalcotizacion = +totalcotizacion + -precio;
		$("#totalordenes").text(totalcotizacion.toFixed(2));
		$(`#${id}`).remove();
		calcular();
		// body...
	}
	var contador = 0;
	var totalmo = 0.00;
	$('#agregarmanodeobra').click(function () {
		contador++
		if (!$('#nombremanodeobra').val() || !$('#puestomanodeobra').val() || !$('#montomanodeobra').val() || !$('#desmanodeobra').val() || !$('#costomanodeobra').val()) {
			swal({
				type: 'error',
				title: 'Ups...',
				text: 'Ingresa todos los datos de mano de obra!'
			});
			return 0;
		}
		let total = parseFloat($('#montomanodeobra').val());// - parseFloat($('#costomanodeobra').val());
		var ht = '<tr id="algo' + contador + '"><td> <input type="hidden" form="formcotizacion" name="manodeobrasn[]" value="' + $('#nombremanodeobra').val() + '"> ' + $('#nombremanodeobra').val() + '</td>' +
			' <td><input type="hidden" form="formcotizacion" name="manodeobrasp[]" value="' + $('#puestomanodeobra').val() + '" >' + $('#puestomanodeobra').val() + '</td>' +
			'<td><input type="hidden" form="formcotizacion" name="manodeobrasd[]" value="' + $('#desmanodeobra').val() + '"> ' + $('#desmanodeobra').val() + '</td>' +
			'<td class="montomanodeobra"> <input type="hidden" form="formcotizacion" name="manodeobrasm[]" value="' + $('#montomanodeobra').val() + '">' + $('#montomanodeobra').val() +
			'<td><input type="hidden" form="formcotizacion" name="manodeobrasc[]" class="costos_manodeobra" value="' + $('#costomanodeobra').val() + '"> ' + $('#costomanodeobra').val() + '</td>' +
			'<td><input type="hidden" form="formcotizacion" name="manodeobrast[]" class="totals_manodeobra" value="' + total + '"> ' + total + '</td>' +
			'<td><button class="btn btn-danger" type="button" onclick="removeManoO(' + "'algo" + contador + "'" + ',' + $("#montomanodeobra").val() + ')">Eliminar</button></td></tr>';
		console.log(parseFloat($('#montomanodeobra').val()));
		totalmo = +totalmo + +parseFloat($('#montomanodeobra').val());
		console.log(totalmo);
		$("#totalmanodeobra").text(totalmo.toFixed(2));
		$("#inputtotalmanodeobra").val(totalmo.toFixed(2));
		$('#tablamanodeobras').append(ht);
		calcular();
	});

	function removeManoO(id, precio) {
		totalmo = +totalmo + -precio;
		$("#totalmanodeobra").text(totalmo.toFixed(2));
		$("#inputtotalmanodeobra").val(totalmo.toFixed(2));
		console.log(id);
		$(`#${id}`).remove();
		calcular()
	}

	var totalva = 0.00;
	$('#agregarvario').click(function () {
		contador++
		if (!$('#desvario').val() || !$('#montovario').val() || !$('#costovario').val()) {
			swal({
				type: 'error',
				title: 'Ups...',
				text: 'Ingresa todos los datos!'
			});
			return 0;
		}
		let total = parseFloat($('#montovario').val());// - parseFloat($('#costovario').val());
		var ht = ' <tr id="algo' + contador + '"><td> <input type="hidden" form="formcotizacion" name="variosd[]" value="' + $('#desvario').val() + '" > ' + $('#desvario').val() + '</td>' +
			'<td class="montovario"><input type="hidden" form="formcotizacion" name="variosm[]" value="' + $('#montovario').val() + '" > ' + $('#montovario').val() + '</td>' +
			' <td> <input type="hidden" form="formcotizacion" class="costos_varios" name="variosc[]" value="' + $('#costovario').val() + '" > ' + $('#costovario').val() + '</td>' +
			' <td> <input type="hidden" form="formcotizacion" class="totals_varios" name="variost[]" value="' + total + '" > ' + total + '</td>' +
			'<td><button class="btn btn-danger" onclick="removeVario(' + "'algo" + contador + "'" + ',' + $("#montovario").val() + ')">Eliminar</button></td></tr>';

		$('#tablavarios').append(ht);
		calcular();
	});

	function removeVario(id, precio) {
		$(`#${id}`).remove();
		calcular();
	}

	var totalenvio = 0.00;
	$('#agregarenvio').click(function () {
		contador++
		if (!$('#desenvio').val() || !$('#montoenvio').val() || !$('#direccionenvio').val() || !$('#costoenvio').val()) {
			swal({
				type: 'error',
				title: 'Ups...',
				text: 'Ingresa todos los datos!'
			});
			return 0;
		}
		let total = parseFloat($('#montoenvio').val());// - parseFloat($('#costoenvio').val());
		var ht = '<tr id="algo' + contador + '"><td> <input type="hidden" form="formcotizacion" name="enviosdi[]" value="' + $('#direccionenvio').val() + '" > ' + $('#direccionenvio').val() + '</td>' +
			' <td> <input type="hidden" form="formcotizacion" name="enviosd[]" value="' + $('#desenvio').val() + '" >' + $('#desenvio').val() + '</td>' +
			' <td class="montoenvio"> <input type="hidden" form="formcotizacion" name="enviosm[]" value="' + $('#montoenvio').val() + '"  > ' + $('#montoenvio').val() + '</td>' +
			' <td class="montoenvio"> <input type="hidden" form="formcotizacion" class="costos_envio" name="enviosc[]" value="' + $('#costoenvio').val() + '"  > ' + $('#costoenvio').val() + '</td>' +
			' <td class="montoenvio"> <input type="hidden" form="formcotizacion" class="totals_envio" name="enviost[]" value="' + total + '"  > ' + total + '</td>' +
			'<td><button class="btn btn-danger" onclick="removeEnvio(' + "'algo" + contador + "'" + ',' + $("#montoenvio").val() + ')">Eliminar</button></td></tr>';
		$('#tablaenvios').append(ht);
		calcular();
	});

	function removeEnvio(id, precio) {
		$(`#${id}`).remove();
		calcular();
	}

	$('.form-check-input').change(function () {
		calcular();
	});

	function agregaratabla(cosa) {
		var row = $('#' + cosa);
		var ht = '<tr id="esoeso' + cosa + '"><td>' + row.find('.nombre').text() + '</td>' +
			'<input type="hidden" form="formcotizacion" name="ordenids[]" value="' + row.find('.idere').val().replace('orden', '') + '"> <td>' + row.find('.fecha').text() + '</td>' +
			'<td>' + row.find('.noorden').text() + '</td>' +
			'<td>' + row.find('.descripcion').text() + '</td>' +
			'<td>' + row.find('.nopiezas').text() + '</td>' +
			'<td><button class="btn btn-danger" onclick="quitar1(' + cosa + ')">Eliminar</button></td></td>'
		'</tr>';
		$('#tablaordenes').append(ht);
		calcular();
	}

	function quitar(e) {
		$('#algo' + e).remove();
		calcular();
	}
	function quitar1(e) {
		$('#esoeso' + e.id).remove();
		calcular();
	}

	function calcular() {
		let totalvarios = 0.0;
		// let totalmanoobra = 0.0;
		// let totalenvios = 0.0;
		// let totalordens = 0.0;
		/***SUMAS***/
		// $('.totals_varios').each(function () {
		// 	totalvarios += parseFloat($(this).val());
		// });
		// $('.totals_manodeobra').each(function () {
		// 	totalmanoobra += parseFloat($(this).val());
		// });
		// $('.totals_envio').each(function () {
		// 	totalenvios += parseFloat($(this).val());
		// });
		totalordens = parseFloat($('#totalordenes').text());
		// $('#totalenvios').text(totalenvios);
		// $('#totalvarios').text(totalvarios);
		// $('#totalmanodeobra').text(totalmanoobra);

		/***GANANCIAS Y DESCUENTOS***/
		let a = parseFloat($('#totalordenes').text()) - parseFloat($('#descuento_ordenes').val()) + parseFloat($('#ganancia_ordenes').val());
		$("#inputtotalordenes").val(a);
		// let b = parseFloat($('#totalmanodeobra').text()) - parseFloat($('#descuento_manodeobra').val()) + parseFloat($('#ganancia_manodeobra').val());
		// $('#tmanodeobra').val(b);
		// let c = parseFloat($('#totalvarios').text()) - parseFloat($('#descuento_varios').val()) + parseFloat($('#ganancia_varios').val());
		// $('#tvarios').val(c);
		// let d = parseFloat($('#totalenvios').text()) - parseFloat($('#descuento_envios').val()) + parseFloat($('#ganancia_envios').val());
		// $('#tenvios').val(d);
		
		/***FINAL***/
		$('#totalproyecto').val(a);

		/***  Ganancias Netas  ***/
		let gananciaordenes = a;
		// let gananciamanoobra = b;
		// let gananciavarios = c;
		// let gananciaenvios = d;
		$('.costos_orden').each(function() {
			gananciaordenes -= parseFloat($(this).val());
		});
		// $('.costos_manodeobra').each(function() {
		// 	gananciamanoobra -= parseFloat($(this).val());
		// });
		// $('.costos_varios').each(function() {
		// 	gananciavarios -= parseFloat($(this).val());
		// });
		// $('.costos_envio').each(function() {
		// 	gananciaenvios -= parseFloat($(this).val());
		// });

		$('#gordenes').val(gananciaordenes);
		// $('#gmanodeobra').val(gananciamanoobra);
		// $('#gvarios').val(gananciavarios);
		// $('#genvios').val(gananciaenvios);

		
	}
	$('input[name=iva]').change(function(){
		let bruto = parseFloat($('#totalproyecto').val());
		let gneto = parseFloat($('#gordenes').val());
		if(document.getElementById('coniva').checked){
			$('#totalneto').val(bruto*1.16);
			$('#ganancianeto').val(gneto);
		}else{
			$('#totalneto').val(bruto);
			$('#ganancianeto').val(gneto);
		}

	})
</script>


@endsection