@extends('layouts.noUpper')
@section('content')

<br>
<div class="container">
	<div class="card">
		{{-- <div class="panel-default"> --}}
			<div class="card-header">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Perfil:</h4>
					</div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('perfil.index') }}"><button class="btn btn-primary"><strong><i class="fa fa-eye" aria-hidden="true"></i> Ver Perfiles</strong></button></a>
                    </div>
				</div>
			</div>
            <div class="card-body">
                <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="control-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" required="" value="{{$perfil->nombre}}" readonly="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4 info">
                                        <label class="control-label">Modulos:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    @php($j = 0)
                                    @foreach($modulos as $modulo)
                                    @if($j % 2 == 0)
                                    <div class="col-sm-6">
                                    @endif
                                        @php($j++)
                                        @if(Auth::user()->perfil->id != 1 && $modulo->nombre == 'seguridad')
                                        @else
                                        <td class="col-sm-4" style="border: none; padding: 0px;">
                                            <table class="table table-hover table-bordered" style="margin-bottom: 0px; background: #fff;">
                                                <tr style="background: #f4f4f4;">
                                                    <th class="col-sm-10">
                                                        <label class="control-label">{{ $modulo->nombre}}</label>
                                                    </th>
                                                    <td class="col-sm-2 text-center">
                                                        <input type="checkbox" name="modulo_id[]"  value="{{ $modulo->id }}" id="mod{{ $j }}"
                                                        <?php
                                                            foreach($perfil->modulos as $mod)
                                                                if($modulo->id == $mod->id)
                                                                    echo "checked";
                                                            ?>
                                                        disabled=""  
                                                        >
                                                    </td>
                                                </tr>
                                                @php($i = 0)
                                            </table>
                                        </td>
                                        @endif
                                     @if($j % 2 == 0)
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 text-center">
                        <a href="{{ route('perfil.edit', ['id' => $perfil->id]) }}"><button class="btn btn-warning"><i class="fa fa-check-pencil" aria-hidden="true"></i> Editar</button></a>
                    </div>
                </div>
            </div>
		{{-- </div> --}}
	</div>
</div>
        
@endsection