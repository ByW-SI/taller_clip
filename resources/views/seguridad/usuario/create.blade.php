@extends('layouts.noUpper')
@section('content')

<div class="container">
    <br>
    {{-- Sección se creación --}}
	<div class="panel panel-group" id="seccion-nuevo-usuario" style="display: none;">
		<div class="panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Usuario:</h4>
					</div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('usuario.index') }}"><button class="btn btn-primary"><strong><i class="fa fa-eye" aria-hidden="true"></i> Ver Usuarios</strong></button></a>
                    </div>
				</div>
			</div>
        </div>
        <form action="{{ route('usuario.store') }}" method="post">    
        {{ csrf_field() }}
            <div class="panel-default">
                <div class="panel-body">
                    <div class="row">
                        {{-- <div class="form-group col-sm-4"> --}}
                            {{-- <label class="control-label">*Nombre de Usuario:</label> --}}
                            <input type="hidden" id="empleado_id" name="empleado_id" class="form-control" required="" readonly>
                        {{-- </div> --}}
                        <div class="form-group col-sm-4">
                            <label class="control-label">*Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required="" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label">*Apellido Paterno:</label>
                            <input type="text" id="appaterno" name="appaterno" class="form-control" required="" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label">Apellido Materno:</label>
                            <input type="text" id="apmaterno" name="apmaterno" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label">*Correo/Usuario:</label>
                            <input type="text" id="email" name="email" class="form-control" required="" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label">*Perfil:</label>
                            <select class="form-control" name="perfil_id" required="">
                                <option selected="" value="">Seleccionar</option>
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
                                <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label">*Contraseña:</label>
                            <input type="text" name="password" class="form-control" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4 text-center">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <h4><small><small><small><i class="fa fa-asterisk" aria-hidden="true"></i></small> Campos Requeridos</small></small></h4>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="panel panel-group">
        <div class="panel-default">
            <div class="panel-heading">
				<div class="row">
					{{-- Titulo --}}
					<div class="col-sm-3">
						<h4>Empleados:</h4>
					</div>
					{{-- Boton de búsqueda --}}
                    <div class="col-sm-5">
                        <form action="{{route('usuario.create')}}" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="query" id="cliente" class="form-control" value="{{Request::input('query')}}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
				</div>
            </div>
            {{-- Lista de empleados que no son usuarios --}}
    <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    @if(count($empleados) > 0)
                        <table class="table table-striped table-bordered table-hover" style="color: rgb(51,51,51); border-collapse: collapse; margin-bottom: 0px;">
                            <thead>
                                <tr class="info">
                                    <th>@sortablelink('identificador', '#')</th>
                                    <th>@sortablelink('nombre', 'Nombre')</th>
                                    <th>@sortablelink('appaterno', 'Apellido Paterno')</th>
                                    <th>@sortablelink('apmaterno', 'Apellido Materno')</th>
                                    <th>@sortablelink('rfc', 'R.F.C.')</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            @foreach ($empleados as $empleado)
                                <tr class="active" title="Has Click Aquì para Ver" style="cursor: pointer" href="#{{$empleado->id}}">
                                    <td>{{$empleado->id}}</td>
                                    <td>{{$empleado->nombre}}</td>
                                    <td>{{$empleado->appaterno}}</td>
                                    <td>{{$empleado->apmaterno}}</td>
                                    <td>{{$empleado->rfc}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm" id="{{$empleado->id}}" onClick="crearUsuario(this.id)">
                                            <i class="fa fa-plus" aria-hidden="true"></i><strong> Crear usuario</strong>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h4>Ningún usuario encontrado.</h4>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function crearUsuario(empleado_id){

    const base_url = document.location.origin;

    $.ajax({
        url: base_url+'/empleado/'+empleado_id,
        type: 'GET',
        contentType: "application/json",
        success: function(empleado){
            $('#empleado_id').val(empleado.id);
            $('#email').val(empleado.email);
            $('#name').val(empleado.email);
            $('#nombre').val(empleado.nombre);
            $('#appaterno').val(empleado.appaterno);
            $('#apmaterno').val(empleado.apmaterno);

            document.getElementById("seccion-nuevo-usuario").style.display = "block";
        },
        error: function(error){
            alert('ERROR');
        }
    });
}

</script>

@endsection