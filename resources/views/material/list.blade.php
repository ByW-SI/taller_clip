@foreach ($materiales as $material)
	{{-- expr --}}
	<tr>
		<td scope="row">
			{{$material->clave}}
		</td>
		<td>{{$material->seccion}}</td>
		<td>{{$material->alto}} cm</td>
		<td>{{$material->ancho}} cm</td>
		<td>{{$material->espesor}} cm</td>
		<td>{{$material->color}}</td>
		<td>${{number_format($material->precio, 2)}}</td>
		<td>
			<div class="row mt-1 mb-1 justify-content-md-center">
				<a href="#/" onclick="addMaterial({{json_encode($material)}} , {{$idtabla}})" class="btn btn-success">
					Agregar
				</a>
			</div>
		</td>
		
	</tr>
@endforeach