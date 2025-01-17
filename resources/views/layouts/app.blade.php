<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}
        <!-- Optional theme -->
        <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <!-- Latest compiled and minified JavaScript -->
        
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}

        {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}

         <!-- Custom Fonts -->
        <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
         <link rel="stylesheet" href="{{ asset('css/main.js') }}">
         
        
         <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="{{ asset('js/peticion.js') }}"></script>
         

    </head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top"  style="background: #55688a;" >
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- <img src="{{ asset('img/logo.jpeg') }}" height="32" width="70"> --}}
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                    </a>
                </div>


                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i> Clientes<span class="caret"></span> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/clientes/create')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Alta</a>
                                <a href="{{ url('/clientes') }}"><i class="fa fa-search" aria-hidden="true"></i> Busqueda</a>
                                <a href="{{ url('/giros') }}"><i class="fa fa-location-arrow" aria-hidden="true"></i> Precargas Giros</a>
                                <a href="{{ url('/formacontactos') }}"><i class="fa fa-location-arrow" aria-hidden="true"></i> Precargas Forma de contactos</a>
                            </li>                     
                        </ul>
                    </li>







                            <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Productos <span class="caret"></span> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('import-export-csv-excel') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Alta por excel</a>
                                <a href="{{ url('productos') }}"><i class="fa fa-search" aria-hidden="true"></i> Busqueda</a>  
                            </li>                     
                        </ul>
                    </li>






                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i> Recursos Humanos <span class="caret"></span> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{url('empleados/create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Alta</a>
                                <a href="{{ url('empleados') }}"><i class="fa fa-search" aria-hidden="true"></i> Busqueda</a>    
                                <li class="dropdown-submenu">
                                <a tabindex="-1" href="#"><i class="fa fa-refresh" aria-hidden="true"></i> Precargas:</a>
                                    <ul class="dropdown-menu">
                                      <li><a tabindex="-1" href="{{ url('bajas') }}"><i class="fa fa-refresh" aria-hidden="true"></i> Bajas</a></li>
                                      <li><a href="{{ url('contratos') }}"><i class="fa fa-refresh" aria-hidden="true"></i> Contratos</a></li>
                                       <li>
                                         <a href="#" onclick="AgregarNuevoTab('{{ url('/bancos') }}','Bancos')"><i class="fa fa-refresh" aria-hidden="true"></i> Precargas Bancos</a>
                                        </li>
                                    </ul>
                                  </li>
                            </li>                     
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-money" aria-hidden="true"></i> Cotizaciones <span class="caret"></span> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/cotizaciones/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Nueva cotización(Blueprint)</a>
                                {{-- <a href="#"><i class="fa fa-search" aria-hidden="true"></i> Busqueda</a>     --}}
                            </li>                     
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <example id="app"></example> --}}
        @yield('content')
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/forms.js') }}"></script>

    {{-- <script type="text/javascript">
        function formulario(elemento){
            if (elemento.value == "Prospecto") {
                document.getElementById('cliente').style.display='none';
                document.getElementById('cliente1').style.display='none';
                document.getElementById('cliente2').style.display='none';
            }
            if (elemento.value == "Cliente") {
                document.getElementById('cliente').style.display='inline';
                document.getElementById('cliente1').style.display='inline';
                document.getElementById('cliente2').style.display='inline';
            }
        }
        function persona(elemento){
            if(elemento.value == "Fisica"){
                document.getElementById('perfisica').style.display='block';
                document.getElementById('permoral').style.display='none';
            }
            if(elemento.value =="Moral"){
                document.getElementById('perfisica').style.display='none';
                document.getElementById('permoral').style.display='block';
            }
        }
    </script> --}}
    
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
{{-- 
    Include this after the sweet alert js file --}}
    @include('sweet::alert')
    <script type="https://unpkg.com/sweetalert/dist/main.js"></script>
     <script type="https://unpkg.com/sweetalert/dist/jquery-3.2.1.min"></script>


<script>

function persona(elemento) {
	console.log('persona works');
	$("#idnombre").prop('required', false);
	$("#apellidopaterno").prop('required', false);
	$("#razonsocial").prop('required', false);
	$("#idnombre").val('');
	$("#apellidopaterno").val('');
	$("#apellidomaterno").val('');
	$("#razonsocial").val('');
	if(elemento.value == "Fisica") {
		console.log("Fisica");
		document.getElementById('perfisica').style.display = 'block';
		document.getElementById('permoral').style.display = 'none';
		document.getElementById('varrfc').pattern = "^[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}";
		document.getElementById('varrfc').placeholder = "Ingrese 13 caracteres";
		document.getElementById('varrfc').title = "Siga el formato 4 letras seguidas por 6 digitos y 3 caracteres";
		$("#idnombre").prop('required', true);
		$("#apellidopaterno").prop('required', true);
	} else if(elemento.value == "Moral") {
		console.log("Moral");
		document.getElementById('perfisica').style.display = 'none';
		document.getElementById('permoral').style.display = 'block';
		document.getElementById('varrfc').pattern = "^[A-Za-z]{3}[0-9]{6}[A-Za-z0-9]{3}";
		document.getElementById('varrfc').placeholder = "Ingrese 12 caracteres";
		document.getElementById('varrfc').title = "Siga el formato 3 letras seguidas por 6 digitos y 3 caracteres";
		$("#razonsocial").prop('required', true);
		$("#idnombre").prop('required', false);
		$("#apellidopaterno").prop('required', false);
	}
    console.log('work app');
}
</script>
     
</body>
</html>
