@extends('layouts.noUpper')
@section('content')

<div class="container">
	<div class="panel panel-group">
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Perfil:</h4>
					</div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('perfil.index') }}"><button class="btn btn-primary"><strong><i class="fa fa-eye" aria-hidden="true"></i> Ver Perfiles</strong></button></a>
                    </div>
				</div>
			</div>
            <form action="{{ route('perfil.update', ['id' => $perfil->id]) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $perfil->nombre }}" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="control-label">Modulos:</label>
                            @foreach($modulos as $modulo)
                            @if(Auth::user()->perfil->id != 1 && $modulo->nombre == 'seguridad')
                            @else
                            <div class="row">
                                <div class="col-sm-5 text-right">
                                    {{ $modulo->nombre }}
                                </div>
                                <div class="col-sm-4 text-left">
                                    <input type="checkbox" name="modulo_id[]" value="{{ $modulo->id }}"
                                    <?php
                                        foreach($perfil->modulos as $mod)
                                            if($modulo->id == $mod->id)
                                                echo "checked";
                                    ?>
                                    >
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4 text-center">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div>

@endsection