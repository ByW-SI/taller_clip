function formulario(elemento){
		if (elemento.value == "Prospecto") {
				document.getElementById('lidir').style.display='none';
				document.getElementById('licont').style.display='none';
				document.getElementById('lidat').style.display='none';
				

		}
		if (elemento.value == "Cliente") {
				document.getElementById('lidir').style.display='block';
				document.getElementById('licont').style.display='block';
				document.getElementById('lidat').style.display='block';
				
		}
}
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

	$('#varrfc').val('');
}


// $(function(){
//               $('.dropdown-submenu a.test').on("click", function(e){
//                 $(this).next('ul').toggle();
//                 e.stopPropagation();
//                 e.preventDefault();
//               });
//             });

// $(function() {
//    $("div.panel div ul li").click(function() {
//       // remove classes from all
//       $("li").removeClass("active");
//       // add class to the one we clicked
//       $(this).addClass("active");
//    });
// });
function deleteFunction(etiqueta) {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
swal({
	title: "¿Estas seguro?",
	text: "Si eliminas, no podras recuperar tu información.",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "SI",
	cancelButtonText: "¡NO!",
	closeOnConfirm: false,
	closeOnCancel: false
},function(isConfirm){
	if (!isConfirm) {
		
		swal("Cancelado", "", "error");
	} else {
		
		document.getElementById(etiqueta).submit();          // submitting the form when user press yes
	}
});
}
//------------------------------------------------------------
function deleteDos(id) {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
swal({
	title: "¿Estas seguro?",
	text: "Si eliminas, no podras recuperar tu información.",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "SI",
	cancelButtonText: "¡NO!",
	closeOnConfirm: true,
	closeOnCancel: false
},function(isConfirm){
	if (!isConfirm) {
		
		swal("Cancelado", "", "error");
	} else {
		
		
		var atributo=document.getElementById('atributo_c').value;
		
								// $.ajaxSetup({
								//     headers: {
								//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								//     }
								//   });
									$.ajax({
										url: "http://byw.from-tn.com/clip_taller/eliminar",
											type: "GET",
											dataType: "html",
											data:{id:id,
														atributo:atributo
														},
									}).done(function(resultado){
											$("#table_colgaderas").html(resultado);
									});          
					}
		});
}
//-------------------------------------------------------
function deleteTres(id) {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
swal({
	title: "¿Estas seguro?",
	text: "Si eliminas, no podras recuperar tu información.",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "SI",
	cancelButtonText: "¡NO!",
	closeOnConfirm: true,
	closeOnCancel: false
},function(isConfirm){
	if (!isConfirm) {
		
		swal("Cancelado", "", "error");
	} else {
		
		
		var atributo=document.getElementById('atributo_a').value;
		
								// $.ajaxSetup({
								//     headers: {
								//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								//     }
								//   });
									$.ajax({
										url: "http://byw.from-tn.com/clip_taller/eliminar",
											type: "GET",
											dataType: "html",
											data:{id:id,
														atributo:atributo
														},
									}).done(function(resultado){
											$("#table_adhesivos").html(resultado);
									});          
					}
		});
}
//-------------------------------------------------------
//     $(this.getAttribute('class')).addClass("active");
//     $(this.getAttribute('href')).show();
// });
