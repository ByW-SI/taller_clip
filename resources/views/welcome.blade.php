<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    </style>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>
    <style>
              a{
                color: black;
                text-decoration: none;
              } 
              a:hover{
                color: black;
                text-decoration: none;
              }
              li{
                  cursor:pointer;
              }

              li.list-group-item:hover{
                  background-color:#00000008;
              }
      
              .card-header.active {
                    background-color: #22178D;
                    color: white;
                }
    

        #frameg{
            width: 100%;
            height: 360%;
            z-index: unset;
        }
        
    </style>

    
        <div class="row" id="acoreond2">
        
            

            <div id="principal" class="col-12">
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary m-3" style="display: none;" id="mostrador">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger m-3" id="ocultador">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </button>
                        <img src="{{asset('img/header.jpg')}}" class="img-fluid" alt="Clip Taller.">
                    </div>



                    <div class="col-3" id="acoreond">

            

                        @auth
                        <!-- LOGIN -->
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase8" class="card-header nave" data-toggle="collapse" data-target="#collapseExample8">
                                        <p class="mb-0" style="float: left;">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample8" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <li class="list-group-item">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- SEGURIDAD -->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "seguridad")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase9" class="card-header nave" data-toggle="collapse" data-target="#collapseExample9">
                                        <p class="mb-0" style="float: left;">Seguridad&nbsp<i class="fa fa-lock" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample9" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave9" onclick="AgregarNuevoTab('{{ url('perfil')}}', 'Perfiles')" href="#">
                                            <li class="list-group-item">
                                                Perfiles&nbsp<i class="fa fa-universal-access" aria-hidden="true"></i>
                                            </li>
                                        </a>
                                        <a class="nave9" onclick="AgregarNuevoTab('{{ url('usuario') }}', 'Usuario')" href="#">
                                            <li class="list-group-item">
                                                Usuarios&nbsp<i class="fa fa-user-circle" aria-hidden="true"></i>
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--Clientes-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "clientes")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase6" class="card-header  nave" data-toggle="collapse" data-target="#collapseExample6">
                                        <p class="mb-0" style="float: left;">Clientes&nbsp<i class="fa fa-users" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample6" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave6" onclick="AgregarNuevoTab('{{ url('/clientes/create')}}', 'Alta Cliente')" href="#"><li class="list-group-item">Alta&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></li></a>
                                        <a class="nave6" onclick="AgregarNuevoTab('{{ url('/clientes') }}', 'Búsqueda Cliente')" href="#"><li class="list-group-item">Búsqueda&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- --------------- -->
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase10" class="card-header  nave" data-toggle="collapse" data-target="#collapseExample10">
                                        <p class="mb-0" style="float: left;">CRM&nbsp<i class="fa fa-calendar" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample10" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave10"  onclick="AgregarNuevoTab('{{ url('/crm/create')}}', 'CRMS')" href="#"><li class="list-group-item">CRMS&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--RH-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "rh")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase5" class="card-header nave" data-toggle="collapse" data-target="#collapseExample5">
                                        <p class="mb-0" style="float: left;">Recursos Humanos&nbsp<i class="fa fa-briefcase" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample5" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave5"  onclick="AgregarNuevoTab('{{url('empleados/create')}}', 'Alta RH')" href="#"><li class="list-group-item">Alta&nbsp<i class="fa fa-plus"></i></li></a>
                                        <a class="nave5"  onclick="AgregarNuevoTab('{{ url('empleados') }}', 'Búsqueda RH')" href="#"><li class="list-group-item">Búsqueda&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--Materiales-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "materiales")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase3" class="card-header nave" data-toggle="collapse" data-target="#collapseExample3">
                                        <p class="mb-0" style="float: left;">Materiales&nbsp<i class="fa fa-cubes"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample3" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave3"  onclick="AgregarNuevoTab('{{ url('/material/create/') }}', 'Crear Materiales')" href="#"><li class="list-group-item">Crear material&nbsp<i class="fa fa-object-group"></i></li></a>
                                        <a class="nave3"  onclick="AgregarNuevoTab('{{ url('material') }}', 'Materiales')" href="#"><li class="list-group-item">Búsqueda&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>
                                        <a class="nave3"  onclick="AgregarNuevoTab('{{ route('excel.import') }}', 'Alta Excel')" href="#"><li class="list-group-item">Alta Excel&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--Obras-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "obras")
                        <!-- <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase3" class="card-header nave" data-toggle="collapse" data-target="#obras">
                                        <p class="mb-0" style="float: left;">Obras&nbsp<i class="fa fa-cubes"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="obras" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave3"  onclick="AgregarNuevoTab('{{ url('obra') }}', 'Obras')" href="#"><li class="list-group-item">Obras&nbsp<i class="fa fa-clone"></i></li></a>
                                        <a class="nave3"  onclick="AgregarNuevoTab('{{ url('/obra/create/') }}', 'Crear Obras')" href="#"><li class="list-group-item">Crear obra&nbsp<i class="fa fa-object-group"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                        @endif
                        @endforeach
                        <!--Órdenes-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "ordenes")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase4" class="card-header nave" data-toggle="collapse" data-target="#collapseExample4">
                                        <p class="mb-0" style="float: left;">Órdenes&nbsp<i class="fa fa-shopping-cart" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample4" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave4"  onclick="AgregarNuevoTab('{{ url('/orden/create') }}', 'Generar Orden')" href="#"><li class="list-group-item">Generar orden&nbsp<i class="fa fa-plus"></i></li></a>
                                            <a class="nave4"  onclick="AgregarNuevoTab('{{ url('/orden') }}', 'Historial Ordenes')" href="#"><li class="list-group-item">Historial órdenes&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>
                                            <!--<a class="nave4"  onclick="AgregarNuevoTab('{{ url('/clientes') }}', 'Clientes')" href="#"{{ url('productos')}}"><li class="list-group-item">Búsqueda&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--Cotización-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "cotizacion")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase7" class="card-header nave" data-toggle="collapse" data-target="#collapseExample7">
                                        <p class="mb-0" style="float: left;">Cotización&nbsp<i class="fa fa-dollar" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample7" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave7"  onclick="AgregarNuevoTab('{{ route('cotizacion.create') }}', 'Cotizar')" href="#"><li class="list-group-item">Cotizar</li></a>
                                        <a class="nave7"  onclick="AgregarNuevoTab('{{ route('cotizacion.index') }}', 'Historial Cotización')" href="#"><li class="list-group-item">Historial</li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--Proveedores-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "proveedores")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase1" class="card-header nave" data-toggle="collapse" data-target="#collapseExample1">
                                        <p class="mb-0" style="float: left;">Proveedores&nbsp<i class="fa fa-users"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample1" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave1"  onclick="AgregarNuevoTab('{{ url('/proveedores/create')}}', 'Alta Proveedores')" href="#"><li class="list-group-item">Alta&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></li></a>
                                        <a class="nave1"  onclick="AgregarNuevoTab('{{ url('/proveedores') }}', 'Historial Proveedores')" href="#"><li class="list-group-item">Búsqueda&nbsp<i class="fa fa-search" aria-hidden="true"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!--Tipo de cambio-->
                        @foreach(Auth::user()->perfil->modulos as $modulo)
                        @if($modulo->nombre == "cambio")
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase2" class="card-header nave" data-toggle="collapse" data-target="#collapseExample2">
                                        <p class="mb-0" style="float: left;">Tipo de Cambio&nbsp<i class="fa fa-dollar"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample2" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave2"  onclick="AgregarNuevoTab('{{ url('/cambio/create') }}', 'Tipo de Cambio')" href="#"><li class="list-group-item">Gestión de tipo de cambio&nbsp<i class="fa fa-dollar" aria-hidden="true"></i></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase11" class="card-header nave" data-toggle="collapse" data-target="#collapseExample11">
                                        <p class="mb-0" style="float: left;">Precargas <i class="fa fa-refresh" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample11" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('/giros') }}', 'Giros')" href="#"><li class="list-group-item">Giros <b>Proveedores</b> </li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('bajas') }}', 'Bajas')" href="#"><li class="list-group-item">Bajas <b>RH</b></li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('contratos') }}', 'Contratos')" href="#"><li class="list-group-item">Contratos <b>RH</b></li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('/areas') }}', 'Áreas')" href="#"><li class="list-group-item">Áreas <b>RH</b></li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('/puestos') }}', 'Puestos')" href="#"><li class="list-group-item">Puestos <b>RH</b></li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('/bancos') }}', 'Bancos')" href="#"><li class="list-group-item">Bancos <b>Proveedores</b></li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ url('/faltas') }}', 'Faltas')" href="#"><li class="list-group-item">Faltas <b>RH</b></li></a>
                                        <a class="nave11" class="dropdown-item"  onclick="AgregarNuevoTab('{{ url('/formacontactos') }}', 'Forma de contacto')" href="#"><li class="list-group-item">Forma de Contacto <b>Clientes</b></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <div class="card">
                                    <div id="clase11" class="card-header nave" data-toggle="collapse" data-target="#collapseExample12">
                                        <p class="mb-0" style="float: left;">Orden de trabajo <i class="fa fa-refresh" aria-hidden="true"></i></p>
                                        <p class="mb-0" style="float: right;"><i class="fa fa-angle-double-down"></i></p>
                                    </div>
                                    <ul id="collapseExample12" class="list-group list-group-flush collapse" data-parent="#acoreond">
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ route('actividades.index') }}', 'Actividades')" href="#"><li class="list-group-item">Actividades </li></a>
                                        <a class="nave11"  onclick="AgregarNuevoTab('{{ route('ordentrabajo.index') }}', 'Ordenes de trabajo')" href="#"><li class="list-group-item">Ordenes de trabajo</li></a>
{{--                                         <a class="nave11"  onclick="AgregarNuevoTab('{{ route('ordentrabajo.show') }}', 'Ordenes de trabajo')" href="#"><li class="list-group-item">Avance actividades</li></a> --}}
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>





                    <div class="col-9" id="framederecha">
                        <div class="container">
                            <ul id="tabsApp" class="nav nav-tabs"></ul>
                            <div id="contenedortab" class="tab-content"></div>
                        </div>
                        <!-- <iframe id="frameg" name="frame1" src=""></iframe> -->
                    </div>
            </div>
        </div>
    </div>

    <script>
        $('.nave1').click(function(e){
            $('.nave').removeClass("active");
            $('#clase1').addClass("active");
        });
        $('.nave2').click(function(e){
            $('.nave').removeClass("active");
            $('#clase2').addClass("active");
        });
        $('.nave3').click(function(e){
            $('.nave').removeClass("active");
            $('#clase3').addClass("active");
        });
        $('.nave4').click(function(e){
            $('.nave').removeClass("active");
            $('#clase4').addClass("active");
        });
        $('.nave5').click(function(e){
            $('.nave').removeClass("active");
            $('#clase5').addClass("active");
        });
        $('.nave6').click(function(e){
            $('.nave').removeClass("active");
            $('#clase6').addClass("active");
        });
        $('.nave7').click(function(e){
            $('.nave').removeClass("active");
            $('#clase7').addClass("active");
        });
        $('.nave8').click(function(e){
            $('.nave').removeClass("active");
            $('#clase8').addClass("active");
        });
        $('.nave9').click(function(e){
            $('.nave').removeClass("active");
            $('#clase9').addClass("active");
        });
        $('.nave10').click(function(e){
            $('.nave').removeClass("active");
            $('#clase10').addClass("active");
        });
    </script>



    <script src="{{ asset('js/pestanas.js') }}"></script>
    <script src="{{ asset('js/forms.js') }}"></script>
    <script>
        var lawidth = 0;
        $('#ocultador').click(function(){
            $(this).hide();
            $('#mostrador').show();
            // lawidth = $('#acoreond').width();
            // alert('adios');
            // $('#acoreond').removeClass('col-3 fixed-top2');
            // $('#acoreond').width(0);
            $('#acoreond').hide();
            $('#principal').removeClass('offset-3 col-9');
            $('#framederecha').removeClass('col-9');
            $('#framederecha').addClass('col-12');
            
        });

        $('#mostrador').click(function(){
            $(this).hide();
            $('#ocultador').show();
            // alert('hola');
            // $('#acoreond').addClass('col-3 fixed-top2');
            // $('#acoreond').width(lawidth);

            $('#acoreond').show();
            $('#principal').addClass(' col-9');
            $('#framederecha').addClass();
            $('#framederecha').removeClass('col-12');
            $('#framederecha').addClass('col-9');
        });
            
    </script>
</body>

</html>








