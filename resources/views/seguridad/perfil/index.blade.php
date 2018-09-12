@extends('layouts.noUpper')
@section('content')

<div class="container">
	<div class="panel panel-group">
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h4>Perfiles:</h4>
					</div>
                    <div class="col-sm-4 text-center">
                        <a class="btn btn-success" href="{{ route('perfil.create') }}"><strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Perfil</strong></a>
                    </div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-striped table-bordered" style="margin-bottom: 0;">
                            @foreach($perfiles as $perfil)
                            @if($perfil->id == 1)
                            @else
                            <?php $seguridad = false; ?>
                            @foreach($perfil->modulos as $modulo)
                            @if($modulo->nombre == "seguridad")
                            <?php $seguridad = true; ?>
                            @endif
                            @endforeach
                            @if(Auth::user()->perfil->id != 1 && $seguridad)
                            @else
                            <tr>
                                <td class="col-sm-9">{{ $perfil->nombre }}</td>
                                <td class="text-center col-sm-3">
                                    <form method="post" action="{{ route('perfil.destroy', ['id' => $perfil->id]) }}" style="">
                                    <a class="btn btn-primary btn-sm" href="{{ route('perfil.show', ['id' => $perfil->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i><strong> Ver</strong></a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('perfil.edit', ['id' => $perfil->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i><strong> Editar</strong></a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash" aria-hidden="true"></i><strong> Borrar</strong></button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection