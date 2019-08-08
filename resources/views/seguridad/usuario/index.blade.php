@extends('layouts.noUpper')
@section('content')

<div class="container">
	<div class="panel panel-group">
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
                    {{-- Titulo --}}
					<div class="col-sm-3">
						<h4>Usuarios:</h4>
                    </div>
                    {{-- Botón de búsqueda --}}
                    {{-- @if(count($usuarios) > 0) --}}
						<div class="col-sm-5">
							<form action="{{route('usuario.index')}}" class="form-inline">
								<div class="input-group">
									<input type="text" name="query" id="cliente" class="form-control" value="{{Request::input('query')}}">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
									</span>
								</div>
							</form>
						</div>
					{{-- @endif --}}
                    {{-- Botón para agregar usuario --}}
                    <div class="col-sm-4 text-center">
                        <a class="btn btn-success" href="{{ route('usuario.create') }}"><strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Usuario</strong></a>
                    </div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-striped table-bordered" style="margin-bottom: 0;">
                            <tr class="info">
                                <th>Perfil</th>
                                <th class="col-sm-3">Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th class="text-center col-sm-3">Acciones</th>
                            </tr>
                            @forelse($usuarios as $usuario)
                            @if($usuario->perfil->id == 1)
                            @else
                            <?php $seguridad = false; ?>
                            @foreach($usuario->perfil->modulos as $modulo)
                            @if($modulo->nombre == "seguridad")
                            <?php $seguridad = true; ?>
                            @endif
                            @endforeach
                            @if(Auth::user()->perfil->id != 1 && $seguridad)
                            @else
                            <tr>
                                <td>{{ $usuario->perfil->nombre }}</td>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->appaterno }}</td>
                                <td>{{ $usuario->apmaterno }}</td>
                                <td class="text-center">
                                    {{-- <form method="post" action="{{ route('usuario.destroy', ['id' => $usuario->id]) }}" style=""> --}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('usuario.show', ['id' => $usuario->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i><strong> Ver</strong></a>
                                        <a class="btn btn-warning btn-sm" href="{{ route('usuario.edit', ['id' => $usuario->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i><strong> Editar</strong></a>
                                        {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                        {{-- {{ csrf_field() }} --}}
                                        {{-- <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash" aria-hidden="true"></i><strong> Borrar</strong></button> --}}
                                    {{-- </form> --}}
                                </td>
                            </tr>
                            @endif
                            @endif
                            @empty
                            <p>No se encontró ningún usuario</p>
                            @endforelse
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection