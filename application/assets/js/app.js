$(() => {

	// http://127.0.0.1/hipermedia/
	let base_url = location.href.split('index')[0];

	// Validando la url para la clase active del navbar
	let pathname = location.pathname.split('php')[1]; // ej: /docente/estudiantes/registrar

	let EDITOR;

	// activar la clase active en el enlace de las rutas (modulos) para el usuario docente
	function ckeditor(){
		// inicializacion de ckeditor
		ClassicEditor.create(document.querySelector('.editor'), {
			ckfinder: {
				uploadUrl: `${base_url}application/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json`,
				// openerMethod: 'popup',
				options: {
					resourceType: 'Images'
				}
			}
		})
		.then((editor) =>{

			EDITOR = editor;

			$('#mdb-preloader').addClass('loaded');

			$('.animacion').addClass('animated fadeIn');

			// word and character count
			const wordCountPlugin = editor.plugins.get( 'WordCount' );
			const wordCountWrapper = document.getElementById( 'word-count' );
			wordCountWrapper.appendChild( wordCountPlugin.wordCountContainer );
		})
		.catch((e) => {
			toastr.error('Algo ha ocurrido cargando CKEDITOR');
			console.log(e);
		})
	}

	$.get(`${base_url}index.php/getsession`)
	.done((data) => {

		// sesion activa en el servidor
		if (data.session) {

			// inicializacion de metodos
			$('.mdb-select').materialSelect()
			$('#fecha').pickadate({
				monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
				today: 'Hoy',
				clear: 'Limpiar',
				close: 'Cerrar',
				labelMonthNext: 'Mes siguiente',
				labelMonthPrev: 'Mes anterior',
				labelMonthSelect: 'Selecciona un mes',
				labelYearSelect: 'Selecciona un año',
				formatSubmit: 'yyyy-mm-dd',
				min: new Date()
			});
			$('#temporizador').pickatime({
				donetext: 'Hecho',
				cleartext: 'Limpiar'
			});
			$('[data-toggle="tooltip"]').tooltip();
			$('[data-toggle="popover-hover"]').popover({
				html: true,
				placement: 'top',
				trigger: 'hover',
			});

			var i = 0;
			let dtEstudiates = $('#dtestudiantes').DataTable({
				ajax: {
					type: 'get',
					url: `${base_url}index.php/traer_estudiantes`,
					dataSrc: '',
				},
				columns: [
					{ render: function(){
						return `${i++}`
					}},
					// { data: 'idpersona'},
					{ data: 'cedula'   },
					{ data: 'nombre'   },
					{ data: 'apellido' },
					{ data: 'correo'   },
					{ data: 'telefono' },
					{ render: function(data, type, row, meta){
						return `
							<button data-pos="${meta.row}" data-idpersona="${row.idpersona}" data-idusuario="${row.idusuario}" class="btn px-2 btn-md btn-warning waves-effect edit" data-toggle="modal" data-target="#editModal">
								<i class="fas fa-edit"></i>
							</button>
							<button data-pos="${meta.row}" data-idpersona="${row.idpersona}" data-idusuario="${row.idusuario}" class="btn px-2 btn-md btn-danger waves-effect elim" data-toggle="modal" data-target="#elimModal">
								<i class="fas fa-trash"></i>
							</button>
						`
					}}
				],
			});
			// $('.dataTables_length').addClass('bs-select')
			$('#dtVisitas').DataTable();

			let idusuario, idpersona, data;

			dtEstudiates.on('draw', (e) => {
				$('.edit').click(function(){
					idpersona = $(this).data('idpersona');
					idusuario = $(this).data('idusuario');
					let pos   = $(this).parents('td').siblings()[0].textContent;

					$('#idpersona').val(idpersona);
					$('#idusuario').val(idusuario);

					data = dtEstudiates.row(pos).data();

					$('#cedula').val(data.cedula);
					$('#nombre').val(data.nombre);
					$('#apellido').val(data.apellido);
					$('#telefono').val(data.telefono);
					$('#email').val(data.correo);
				});

				$('.elim').click(function(){
					idpersona = $(this).data('idpersona')
					idusuario = $(this).data('idusuario')

					$('#idusuariodel').val(idusuario)
				});
			});


			$('#editarForm').submit(function(e){
				e.preventDefault();

				let postdata = {
					hiddenEmail: data.correo,
					nombre     : $('#nombre').val(),
					apellido   : $('#apellido').val(),
					correo     : $('#email').val(),
					telefono   : $('#telefono').val(),
					idusuario  : idusuario,
					idpersona  : idpersona
				}

				// console.log(postdata);

				$.post(`${base_url}index.php/updateProfile`, postdata, (success) => {
					dtEstudiates.ajax.reload();
					toastr.success('Información actualizada correctamente');
					$('#editModal').modal('hide');
					i = 0;
				})
				.fail((er) => {
					console.log(er.responseText);
					toastr.error(er.statusText);
				});
			});

			$('#eliminarForm').submit((e) => {
				e.preventDefault();

				let ids = { idusuario: $('#idusuariodel').val() }

				$.post(`${base_url}index.php/deleteProfile`, ids, function(msj){
					dtEstudiates.ajax.reload();
					$('#elimModal').modal('hide');
					toastr.success(msj);
					i = 0;
				})
				.fail((er) => {
					console.log(er.responseText);
					toastr.error(er.statusText);
				});
			});


			// SideNav Button Initialization
			$(".button-collapse").sideNav({
				breakpoint: 1024,
			});
			// SideNav Scrollbar Initialization
			let sideNavScrollbar = document.querySelector('.custom-scrollbar');
			let ps = new PerfectScrollbar(sideNavScrollbar);


			// if kare's owner
			if (false) {


			}
			else {

				// Clase active del navbar
				// if( pathname.endsWith('/docente/contenidos') ){
				// 	$('.nav-item.active').removeClass('active');
				// 	$('.collapsible-header.active').removeClass('active');
				// 	$('#contenido').addClass('active');
				// }
			}


			// Mostrar temas y contenido del lapso
			$('.ver_contenido').click(function(e) {
				let info = { idtema: $(this).data('idtema') }

				$.post(`${base_url}index.php/traer_contenido`, info, (contenido) => {

					$('#content').html(`
						${contenido[0].contenido}
					`)
				})
				.fail((er) => {
					console.log(er.responseText);
					toastr.error(er.statusText);
				});
			});

			$('.borrartema').click(function(){
				let idtema = $(this).data('idtema');
				// let idcontenido = $(this).data('idcontenido');

				$.post(`${base_url}index.php/delTemaContenido`, { idtema: idtema }, (data) => {

					if (data == 'nop') {
						toastr.error('No tienes permiso para borrarlo.');
					}
					else {
						$(this).parents('.content').remove();
						// $('#content').html('');
						toastr.success(data);
					}
				})
				.fail((error) => {
					console.log(error.responseText);
					toastr.error(error.statusText);
				});
			});

			// $('.lapsos').click( function(e) {
			// 	$('#content').html('');

			// 	// let temaid    = $(this).children('div[data-temaid]').data('temaid')

			// 	let data = {
			// 		lapso: $(this).children('.lapso').text(),
			// 		seccion: $(this).children('div[data-seccion]').data('seccion')
			// 	}

			// 	$.post(`${base_url}index.php/traer_temas`, data, (temas) => {

			// 		$('#temaContenido').html('');

			// 		console.log(temas)

			// 		for (c of temas) {
			// 			$('#temaContenido').append(`
			// 				<div class="content">
			// 					<div class=" mb-3">
			// 						<div class="card asd">
			// 							<div class="card-header p-0">
			// 								<button data-idtema="${c.idtema}" class="borrartema btn btn-sm btn-flat waves-effect red-text">
			// 									<i class="fas fa-times"></i>
			// 								</button>
			// 							</div>
			// 							<a class="tema" href="#" data-tema="${c.tema}" data-idtema="${c.idtema}">
			// 								<div class="card-body">
			// 									<p class="text-center lead">${c.tema}</p>
			// 								</div>
			// 							</a>
			// 						</div>
			// 					</div>
			// 				</div>
			// 			`);
			// 		}

			// 		$('.borrartema').click(function(){
			// 			let idtema = $(this).data('idtema');
			// 			// let idcontenido = $(this).data('idcontenido');

			// 			$.post(`${base_url}index.php/delTemaContenido`, { idtema: idtema }, (data) => {

			// 				if (data == 'nop') {
			// 					toastr.error('No tienes permiso para borrarlo.');
			// 				}
			// 				else {
			// 					$(this).parents('.content').remove();
			// 					$('#content').html('');
			// 					toastr.success(data);
			// 				}
			// 			})
			// 			.fail((error) => {
			// 				console.log(error.responseText);
			// 				toastr.error(error.statusText);
			// 			});
			// 		});

			// 		$('.tema').click(function(e) {
			// 			let info = { idtema: $(this).data('idtema') }

			// 			$.post(`${base_url}index.php/traer_contenido`, info, (contenido) => {

			// 				$('#content').html(`
			// 					${contenido[0].contenido}
			// 				`)

			// 				$('.tema').parents('.asd').removeClass('elegant-color');
			// 				$(this).parents('.asd').addClass('elegant-color');
			// 			})
			// 			.fail((er) => {
			// 				console.log(er.responseText);
			// 				toastr.error(er.statusText);
			// 			});
			// 		});

			// 		$('.lapsos').parents('.card-body').removeClass('elegant-color');
			// 		// $(this).children('h3').removeClass('white-text')

			// 		$(this).parents('.card-body').addClass('elegant-color');
			// 		$(this).children('h3').addClass('white-text');

			// 	})
			// 	.fail((er) => {
			// 		console.log(er);
			// 		toastr.error(er.statusText);
			// 	});
			// });
		}
	})
	.fail((er) => {
		console.log(er.responseText);
		toastr.error(er.statusText);
	});



	if( pathname.endsWith('/docente/contenidos') ){
		$('.collapsible-header.active').removeClass('active');
		$('#contenido').addClass('active');

		ckeditor();
	}

	// // activar la clase active en el enlace de las rutas (modulos) para el usuario docente
	if ( pathname.endsWith('/estudiante') ){
		$('.collapsible-header.active').removeClass('active'); // k => sidebar
		$('#inicio').addClass('active');
	}
	else if ( pathname.endsWith('/estudiante/contenidos') ){
		$('.collapsible-header.active').removeClass('active'); // k => sidebar
		$('#contenido').addClass('active');
	}
	else if ( pathname.endsWith('estudiante/evaluaciones') ){
		sessionStorage.clear();
		$('.collapsible-header.active').removeClass('active'); // k => sidebar
		$('#evaluaciones').addClass('active');
	}
	else if ( pathname.endsWith('/simuladores') ){
		$('.collapsible-header.active').removeClass('active'); // k => sidebar
		$('#simulador').addClass('active');
	}
	else if ( pathname.endsWith('asignaciones') ){
		$('.collapsible-header.active').removeClass('active'); // k => sidebar
		$('#asignaciones').addClass('active');
	}


	if ( pathname.endsWith('/docente') ){
		$('.collapsible-header.active').removeClass('active'); // k => sidebar
		$('#inicio').addClass('active');
	}
	else if (/contenido\/[0-9]+$/.test(pathname)) {

		$('.collapsible-header.active').removeClass('active');
		$('#contenido').addClass('active');
	}
	// else if ( pathname.endsWith('/contenido/crear') ){
	//
	// 	$('.collapsible-header.active').removeClass('active');
	// 	$('#contenido').addClass('active');

	// 	ckeditor();
	// }
	else if( pathname.endsWith('/estudiantes')){

		$('.collapsible-header.active').removeClass('active');
		$('#alumnos').addClass('active');
	}
	else if( pathname.endsWith('evaluaciones') ){

		$('.collapsible-header.active').removeClass('active');
		$('#examenes').addClass('active');
	}
	else if (/evaluacion\/[0-9]+$/.test(pathname)) {

		$('.collapsible-header.active').removeClass('active');
		$('#examenes').addClass('active');
	}
	else if( pathname.endsWith('/recursos') ){

		$('.collapsible-header.active').removeClass('active');
		$('#repositorio').addClass('active');
	}
	else if( pathname.endsWith('/herramientas') ){

		$('.collapsible-header.active').removeClass('active');
		$('#herramientas').addClass('active');
	}
	// else {
	// 	$('.nav-item.active').removeClass('active')
	// 	$('.collapsible-header.active').removeClass('active')
	// }


	/*********************************************************************************************************************************************
	****** EST CODIGO SE EJECUTA CUANDO SE TIENE UNA SESION ACTIVA EN EL SERVIDOR Y TRAE LA KEY OWNER DEL ARRAY EN EL ARCHIVO DE CONFGURACION ****
	**********************************************************************************************************************************************/



	// ------------------------------ LOGICA DEL LOGIN, REGISTRO DE USUARIOS Y RESETEO DE CONTRASEÑA --------------------------------------------

	// Comprobar los credenciales de login
	$('#loginform').submit(function(e) {
		e.preventDefault();

		let data = $(this).serialize();

		$.post(`${base_url}index.php/login`, data, function(d){

			if (d.code == 200) {
				if (d.type == 'Estudiante') {
					location.assign(`${base_url}index.php/estudiante`);
				}
				else {
					location.assign(`${base_url}index.php/docente`);
				}
			}
			else {
				console.log(d);
				toastr.error(d.message);
			}

			$('#password').val('');
		})
		.fail((err) => {
			console.log(err.responseText);
			toastr.error(err.statusText);
		});
	});

	// Registrar un usuario docente nuevo
	$('#registerform').submit(function(e){
		e.preventDefault();

		let data = $(this).serialize()

		$.post(`${base_url}index.php/register`, data, function(d){

			if (d[0] == 'success') {

				$('#cedula').val('');
				$('#nombre').val('');
				$('#apellido').val('');
				$('#correo').val('');
				$('#telefono').val('');
				$('#seccion').val('');
				$('#clave').val('');

				$('#registro').modal('hide');

				toastr.success(d[1]);

				setTimeout(() => {
					if (pathname.endsWith('/registrar')) {
						location.assign(`${base_url}index.php/`);
					}
				}, 2000);
			}
			else {
				toastr.error(d[1]);
			}

		})

		.fail(er => {
			console.log(er.responseText);
			toastr.error(er.statusText);
		})
	});

	$('#recuperar_contrasena').submit((e)=> {
		e.preventDefault();

		$.ajax({
			method: 'post',
			url: `${base_url}index.php/recuperar_contrasena`,
			data:  $(e.target).serialize(),
			timeout: 20000,
			beforeSend(){
				$('#basic-addon1').html('<i class="fas fa-circle-notch fa-pulse"></i>');
			}
		})
		.done((data) =>{
			console.log(data);
			$('#basic-addon1').html('<i class="fas fa-envelope"></i>');
			if (data[0] == true) {
				toastr.success("Revisa tu bandeja de entrada, te ha llegado un enlace con el cual puedes restablecer tu contraseña.");
				$('#sendCorreo').val('');
				return;
			}
			else if ( data[0] == '404' ){
				toastr.error('Este correo no está registrado.');
				return;
			}

			// Algun error enviando el correo
			toastr.error('Hubo un error al enviar el correo.');
			console.log(data);
		})
		.fail((er, textStatus) => {
			console.log(er.responseText);

			$('#basic-addon1').html('<i class="fas fa-envelope"></i>');

			if (textStatus == 'timeout') {
				toastr.error('Se ha excedido el tiempo, inténtalo más tarde.');
			}
			else {
				toastr.error('Hubo un error al enviar el correo, tal vez sea la conexión a internet, contáctate con el administrador del sitio.');
			}
		})
	});

	$('#restore_password').submit((e) => {
		e.preventDefault();

		let correo = location.search.split('=')[1];
		let clave = $('#pass').val();

		let data = { correo, clave }

		if (correo) {

			$.post(`${base_url}index.php/cambiar_clave`, data, (data) => {

				toastr.success(data);
				$('#pass').val('');
			})
			.fail((er) => {
				console.log(er.responseText);
				toastr.error(er.statusText);
			});
		}
		else {
			toastr.error('La URL no es válida');
		}
	});

	// valiar que la cedula ingresada no exista
	$('.cedula').keyup(function(e) {

		$.post(`${base_url}index.php/verificar_cedula`, { cedula : $(this).val() })
		.done((d) => {
			if (d) {
				$(this).addClass('is-invalid');
				$('.cimsg').text(d);
				$('#registerbtn').attr('disabled', 'true');
			}
			else {
				$(this).removeClass('is-invalid');
				$('.cimsg').text('');
				if (! $('.correo').hasClass('is-invalid')) {
					$('#registerbtn').removeAttr('disabled');
				}
			}
		})

		.fail((error) => {
			console.log(error);
		});
	});

	// valiar que el correo ingresado no exista
	$('.correo').keyup(function(e) {

		$.post(`${base_url}index.php/verificar_correo`, { correo : $(this).val() })
		.done((d) => {
			// d = El correo se encuantra registrado
			if (d) {
				$(this).addClass('is-invalid');
				$('.cemsg').text(d);
				$('#registerbtn').attr('disabled', 'true');
			}
			else {
				$(this).removeClass('is-invalid');
				$('.cemsg').text('');

				if (! $('.cedula').hasClass('is-invalid')) {
					$('#registerbtn').removeAttr('disabled');
				}
			}
		})

		.fail((error) => {
			console.log(error.responseText);
			toastr.error(error.statusText);
		})
	});


	// ------------------------------ LOGICA PARA REGISTRAR ESTUDIANTES --------------------------------------------

	$('#formaddestudiantes').submit((e) => {
		e.preventDefault();

		let data = $(e.target).serialize();

		$.post(`${base_url}index.php/anadir_estudiante`, data, function(d){

			console.log(d);

			$('#cedulaest').val('');
			$('#nombreest').val('');
			$('#apellidoest').val('');
			$('#emailest').val('');
			$('#phoneest').val('');

			$('#addestudent').modal('hide');
			toastr.success(d);
			$('#dtestudiantes').DataTable().ajax.reload();
		})
		.fail((err) => {
			toastr.error(err.statusText);
			console.log(err.responseText);
		});
	});


	// ------------------------------ LOGICA PARA EL EXAMEN (PROFESOR) ----------------------------------------

	var c = 1;

	// SELECCIONAR EL TIPO DE PREGUNTA
	function tipo_pregunta(c = 1){

		if (c < 1) { c = 1 }

		$('.tipo_pregunta').change(function() {

			let resp = $(this).parents('.form-row').children('.col-md-3').children('.resp');

			if ( $(this).val() == 'Seleccion_Simple' ) { // seleccion simple

				if( $(this).parents('.card-body').children('.respinco').children('.asd') ){
					$(this).parents('.card-body').children('.respinco').children('.asd').remove();
				}

				$(this).parents('.card-body').children('.respinco').append(`
					<div class="form-row mt-3 asd">
						<div class="col-md-3 col-sm-6">
							<label for="">Respuesta incorrecta 1</label>
							<input type="text" name="resp_inc_1-${c}" class="form-control campo" required />
						</div>
						<div class="col-md-3 col-sm-6">
							<label for="">Respuesta incorrecta 2</label>
							<input type="text" name="resp_inc_2-${c}" class="form-control campo" required />
						</div>
						<div class="col-md-3 col-sm-6">
							<label for="">Respuesta incorrecta 3</label>
							<input type="text" name="resp_inc_3-${c}" class="form-control campo" required />
						</div>
						<div class="col-md-3 col-sm-6">
							<label for="">Respuesta incorrecta 4</label>
							<input type="text" name="resp_inc_4-${c}" class="form-control campo" required />
						</div>
					</div>
				`);

				resp.children().remove();
				resp.append(`
					<label for="">Respuesta correcta</label>
					<input type="text" class="form-control campo" name="resp-${c}" required />
				`);
			}
			else if( $(this).val() == 'Verdadero_o_Falso' ) {
				resp.children().remove();

				resp.append(`
					<label>La respuesta</label>
					<select name="resp-${c}" class="browser-default custom-select" required>
						<option value="verdadero">Verdadero</option>
						<option value="falso">Falso</option>
					</select>
				`);

				$(this).parents('.card-body').children('.respinco').children().remove();
			}
		})
	}
	tipo_pregunta();

	// AÑADIR MAS PREGUNTAS
	$('#addPregunta').click((e) => {
		// Validar que c no sea un nro negativo
		if (c < 1) { c = 1 }

		//------------------ VALIDACIONES DE LAS PREGUNTAS --------------------------

		// Validar que todos los campos esten llenos antes de continuar con la otra pregunta
		let campos = $(e.target).parents('form').find('.form-control, .custom-select');
		let bool   = false;

		// Validarsi el campo tiene un valor, en caso contrario le pone la clase is-invalid
		campos.each((i, el) => {
			if ($(el).val() == '') {
				toastr.error('Completa todos los campos anteriores.');
				$(el).addClass('is-invalid');
				bool = true;
				return false;
			}
		});
		//Salir de la funcion principal en caso de que los campos esten vacios
		if (bool) { return }
		// QUitar la clase is-invalid en caso de que el campo tenga un valor
		campos.each((i, el) => {
			if ($(el).hasClass('is-invalid')) {
				$(el).removeClass('is-invalid');
			}
		});

		let puntuacion = $('#puntuacion').val(), valorTotal = 0;

		// Validar que no se pueda introducir otra pregunta si el valor total del examen es mayor a 100
		$('.valor').each(function(i, el){
			valorTotal += parseInt($(el).val());
		});
		if (valorTotal > puntuacion) {
			toastr.warning('El valor de las preguntas han excedido la puntuación total de la evaluación.');
			return;
		}

		// sumarle 1 a c
		c+=1;

		// Añadir la pregunta nueva
		$('#preguntasAdicionales').append(`
			<div class="card my-4 ">
				<div class="card-header py-2 grey lighten-3">
					<h4 class="mb-3">Pregunta #${c}</h4>
				</div>
				<div class="card-body contenedor">
					<div class="form-row mt-4">
						<div class="col-md-3 col-sm-6">
							<label>Tipo de pregunta</label>
							<select name="tipo_pregunta-${c}" class="tipo_pregunta browser-default custom-select campo" required>
								<option value="Verdadero_o_Falso">Verdadero o Falso</option>
								<option value="Seleccion_Simple">Seleccion simple</option>
							</select>
						</div>
						<div class="col-md-3 col-sm-6">
							<label>Pregunta</label>
							<input type="text" class="form-control campo" name="preg-${c}" required>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="resp">
								<label>Respuesta</label>
								<select name="resp-${c}" class="browser-default custom-select campo" required>
									<option value="verdadero">Verdadero</option>
									<option value="falso">Falso</option>
								</select>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<label>Valor pregunta</label>
							<input type="number" name="valor-${c}" class="valor form-control campo" max="100" min="1" required>
						</div>
					</div>
					<div class="respinco"></div>
				</div>
			</div>
		`);
		tipo_pregunta(c);
	});

	// ELIMINAR ULTIMA PREGUNTA AÑADIDA
	$('#delPregunta').click(() => {
		$('#preguntasAdicionales').children().last().remove();
		c -= 1;
	});

	// ENviar formulario con las preugntas al servidor
	$('#questionForm').submit(function(e){

		e.preventDefault();

		let puntuacion = $('#puntuacion').val(), valorTotal = 0;

		// Validar que no se pueda introducir otra pregunta si el valor total del examen es mayor a 100
		$('.valor').each(function(i, el){
			valorTotal += parseInt($(el).val());
		});
		if( valorTotal > puntuacion ){
			toastr.warning('El valor de las preguntas han excedido la puntuación total de la evaluación.');
			e.preventDefault();
			return;
		}
		else if( valorTotal < puntuacion ){
			toastr.warning('El valor de las preguntas no han alcanzado la puntuación total de la evaluación.');
			e.preventDefault();
			return;
		}

		e.target.submit();

	});

	// validar que el tema no tenga una evaluacion asignada
	// $('#tema').change((e) => {
	// 	$.post(`${base_url}index.php/validar_tema`, { temaid: $(e.target).val() }, (d) => {
	// 		// console.log(d)
	// 		if (d) {
	// 			$('#btnSubmit').addClass('disabled')
	// 			toastr.warning('Este tema ya tiene una evaluación asignada.')
	// 		}
	// 		else {
	// 			if ($('#btnSubmit').hasClass('disabled')) {
	// 				$('#btnSubmit').removeClass('disabled')
	// 			}
	// 		}
	// 	})
	// 	.fail(err => {
	// 		toastr.error(err.statusText)
	// 		console.log(err)
	// 	})
	// })


	// ---------------------- AÑADIR CONTENIDO --------------------------------------

	$('#addContent').submit((e) => {
		e.preventDefault();

		let data = {
			lapso : $('#lapso').val(),
			tema : $('#tema').val(),
			contenido: EDITOR.getData()
		}

		$.post(`${base_url}index.php/addContent`, data, (d) => {

			toastr.success('Contenido añadido correctamente');
			$('#lapso').val('');
			$('#tema').val('');
			EDITOR.setData('');
		})
		.fail((err) => {
			console.log(err);
			toastr.error(err.statusText);
		});
	});


	// ----------------------- AÑADIR ARCHIVOS ---------------------------------------

	// añade la lingitud de l¿osarchivos subidos a un input hidden en el formulario
	$('#archivo').change(function(e) {

		let length = $('#archivo')[0].files.length;
		$('.length').val(length);
	});


	// ------------------------ ACTUALIZAR PERFIL -----------------------------

	// quitar el attr readonly que por defecto tienen los campos para editar la info de usuario presionando un boton
	$('#editar').click(() => {
		$('.edt').each((i, el) => {
			$(el).removeAttr('readonly');
		});
		// $('#actualizarbtn').removeAttr('disabled')
	});
	$('#editPass').click(function() {

		if ($(this).text() == 'MEJOR NO') {
			$(this).text('cambiar');
			$('.editPass').attr('disabled', 'true');
			$('.editPass').val('');
			$('#texto').text('');
			$('#actualizarbtn').removeAttr('disabled');
		}
		else {
			$(this).text('MEJOR NO');
			$('.editPass').removeAttr('disabled');
		}
	});

	$('#claverep').keyup(() => {

		let claveVal    = $('#clave').val();
		let claverepVal = $('#claverep').val();

		if (claverepVal == claveVal) {
			$('#actualizarbtn').removeAttr('disabled');
			$('#texto').text('');
		}
		else {
			$('#texto').text('Las contraseñas no coinciden');
			$('#actualizarbtn').attr('disabled', 'true');
		}
	});

	// validadcion para que el form no se envie sin antes habilitar los campos de dicho form
	$('#perfilForm').submit((e) => {
		e.preventDefault();

		if ($('#nombre').attr('readonly')) {
			toastr.error('Habilite los campos del formulario primero');
		}
		else {
			e.target.submit();
		}

	});

	// mostrar preview de la imagen de usuario a subir
	$('#chavatar').change((e) => {
		$('#sendBtn').removeClass('d-none');

		// imagen de preview
		let file   = e.target.files[0];
		let reader = new FileReader();

		reader.onload = (ev) => {
			$('#avatar').attr('src', ev.target.result);
		}

		reader.readAsDataURL(file);
	});



	// ---------------- EXAMEN ESTUDIANTE ------------------------

	// Asignarle el tema_id del examen a un input hidden en el modal
	$('.triggerGoToTest').click(function(e) {
		$('#examid').attr('href', `${base_url}index.php/estudiante/evaluacion/${$(this).data('ideval')}`);
	});

	// poner el tiempo de la prueba en el modal de entrada de la misma
	$('.cardeval').click(function(e){
		$('#tiempo').text($(this).find('.time').text());
	});


	function sendTestAjaxRequest(){
		$.post(`${base_url}index.php/sendtest`, $('#formtest').serialize(), (d) => {
			console.log(d);
			$('#puntuacion').removeClass('d-none');
			$('#puntuacionModal').modal();

			for(let examen of d.examen){
				$('#respuestas').append(`
					<p>
						<b>Pregunta:</b> ${examen.pregunta}<br>
						<b>Respuesta:</b> ${examen.respuesta}
					</p>
				`);
			}

			$('#calif').text(d.puntuacion + ' puntos');

			if (d.puntuacion > 59) {
				// sumarle 1 a el campo aprobado
				$.post(`${base_url}index.php/add_aprobado`, { idexamen: $('#idexamen').val() }, (d) => {
					console.log('Aprobado ' + d);
				})
				.fail((e) => {
					console.log(e.responseText);
					toastr.error('Ha ocurido un error sumandole un aprobado al examen');
				});
			}
			else {
				$.post(`${base_url}index.php/add_reprobado`, { idexamen: $('#idexamen').val() }, (d) => {
					console.log('Reprobado ' + d);
				})
				.fail((e) => {
					console.log(e.responseText);
					toastr.error('Ha ocurido un error sumandole un reprobado al examen');
				});
			}
		})
		.fail((er) => {
			console.log(er.responseText);
			toastr.error(er.statusText);
		});
	}

	// temporizador de la evaluacion
	if (/estudiante\/evaluacion\/[0-9]+$/.test(pathname)) {

		if ($('#formtest').length > 0) {

			// sumarle 1 a el campo vistas
			$.post(`${base_url}index.php/add_visto`, { idexamen: $('#idexamen').val() }, (d) => {
				console.log(d);
			})
			.fail((e) => {
				console.log(e.responseText);
				toastr.error('Ha ocurido un error sumandole una vista al examen');
			});


			// TEMPORIZADOR
			if (sessionStorage.getItem('temporizador')) {
				$('#temp').text(sessionStorage.getItem('temporizador'));
			}
			else {
				sessionStorage.setItem('temporizador', $('#temp').text());
			}

			let interval = setInterval(() => {

				let tiempoLimite = sessionStorage.getItem('temporizador');
				let temp = moment(tiempoLimite, 'HH:mm:ss').subtract(1, 'seconds').format('HH:mm:ss');

				sessionStorage.setItem('temporizador', temp);
				$('#temp').text(temp);

				if (temp == '00:00:10') {
					$('#temp').css('color', 'red');
					$('#temp').parent().addClass('animated shake');
				}

				if (temp == '00:00:00') {
					clearInterval(interval);
					sessionStorage.removeItem('temporizador');

					sendTestAjaxRequest();

					toastr.info('Prueba terminada');
					$('#terminar').attr('disabled', true);
					$('input').attr('disabled', true);
				}

			}, 1000);

			$('#formtest').submit((e) => {
				e.preventDefault();
				sessionStorage.removeItem('temporizador');
				sendTestAjaxRequest();
				clearInterval(interval);
				toastr.info('Prueba terminada');
				$('#terminar').attr('disabled', true);
				$('input').attr('disabled', true);
			});
		}

	}

	// enviar a un input hidden el id de la asignacino_usuario presionando el boton del modal para enviar la respuesta de la asignaicon
	$('#asigUserIdBtn').click(() => {
		let asig_user_id  = $('#asig_user_id').data('asignacion_usuario');
		let asignacion_id = $('#asignacion_id').data('asignacion_id');

		$('#asignacion_usuario_id').val(asig_user_id);
		$('#asignacionid').val(asignacion_id);
	});

	// enviar a un input hidden el id de la respuesta_asignacion presionando el boton del modal para calificar la despuesta de la asignaicon de un estudiante
	$('#calificar_btn').click(() => {
		let id_respuesta_asignacion  = $('#calificar_btn').data('id_respuesta_asignacion');

		$('#id_respuesta_asignacion').val(id_respuesta_asignacion);
	});


	// Funcones del chat

	// enviar el mensaje a la bd
	$('#chatForm').submit((e) => {
		e.preventDefault();

		let data = {
			mensaje   : $('#comentario').val(),
			usuarioid : $('#usuarioid').val(),
			seccionid : $('#seccionid').val()
		}

		$.post(`${base_url}index.php/mensajear`, data, (data) => {

			$('#comentario').val('');

			let altura = $('#chat').prop('scrollHeight');
			$('#chat').scrollTop(altura);

		})
		.fail((e) => {
			console.log(e.responseText);
			toastr.error(e.statusText);
		});
	});

	// mostrar los mensajes cada segundo y actualizar la bandeja
	if (pathname.endsWith('chat')) {

		let seccion   = $('#seccion').val();
		let usuarioid = $('#usuarioid').val();

		let altura = $('#chat').prop('scrollHeight');
		$('#chat').scrollTop(altura);

		let interval = setInterval(() => {

			$.get(`${base_url}index.php/traer_mensajes/${seccion}/${usuarioid}`, (data) => {

				if (data.length > 0) {

					$('#chat').html(data);

				}
				else {
					$('#chat').html('<h2 class="pt-5 text-center">No hay una conversación registrada.</h2>');
				}

			})
			.fail((e) => {
				console.log(e.responseText);
				toastr.error(e.statusText);
			});

		}, 1000);
	}
	// end funcinoes del chat


	$('.delInitialContent').click(function() {
		let idcontenido = $(this).data('idcontenido');

		$('#idcontenidoinicial').val(idcontenido);
	});

	// borrar asignacino
	$('.borrarAsig').click(function(){
		let idasignacion = $(this).data('idasignacion');

		$('#idasignacion').val(idasignacion);
	});

});