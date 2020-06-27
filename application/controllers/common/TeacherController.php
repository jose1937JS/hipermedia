<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Login');
		$this->load->model('common/Usuario');
		$this->load->model('common/Contenido');
		$this->load->model('common/Examen');
		$this->load->model('common/Archivo');
		$this->load->model('common/Asignacion');
		$this->load->model('common/Visitas');
		$this->load->model('common/Chat');
	}

	public function index()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Docente' ){

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['data']    = $this->Contenido->traer_contenido_inicial($user['seccion']);

			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Inicio']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/teacher/index', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function contenidos()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Docente' ){

			$seccion 		 = $this->session->userdata()['seccion'];
			$user['seccion'] = $this->session->userdata()['seccion'];

			$lapsos          = $this->Contenido->traer_lapsos($seccion);

			$data['lapsos']  = $lapsos;

			$correo 	     = $this->session->userdata()['email'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$l = [];
			$lapsosUnicos = null;

			foreach ($lapsos as $key => $value) {
				$l[] = $value->lapso;
			}

			if ($l) { $lapsosUnicos = array_unique($l); }


			$data['temas']   = $this->Contenido->temas($seccion);
			$data['cant']    = $lapsosUnicos;
			$data['seccion'] = $seccion;

			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Contenido']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/teacher/contenido', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function evaluaciones()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Docente' ){

			$seccion   = $this->session->userdata()['seccion'];
			$preguntas = $this->Examen->traer_examenes($seccion);

			$correo 		 = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			// $idexamen  = [];
			// $questions = [];

			// foreach ($preguntas as $key => $value) {
			// 	$idexamen[] = $value->idexamen;
			// }

			// $sinDobleExamen = array_unique($idexamen);
			// $idexamenes     = array_values($sinDobleExamen); // contiene los ids de examenes de las preguntas sin repeticion y con los indices restaurados


			foreach ($preguntas as $key => $pregunta) {
				if( array_key_exists($key + 1, $preguntas) ){
					if ($preguntas[$key + 1]->idexamen == $pregunta->idexamen) {
						unset($preguntas[$key + 1]);
					}
				}
			}
			// $arr  = [];

			// foreach ($preguntas as $key => $value) {
			// 	for ($i = 0; $i < count($idexamenes); $i++) {
			// 		if ($value->idexamen == $idexamenes[$i]) {
			// 			$arr["examen-".$i] = $value;
			// 		}
			// 	}
			// }


			$data['evaluaciones'] = $preguntas;
			$data['temas'] 		  = $this->Examen->traer_temas($seccion);

			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Evaluaciones']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/teacher/evaluaciones', $data);
			$this->load->view('common/footer');

		}
		else {
			redirect('');
		}
	}

	public function evaluacion($idexamen)
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Docente' ){

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user'] 	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['evaluacion']  = $this->Examen->traer_examen($idexamen);

			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Evaluacion']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('common/evaluacion', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}


	public function estudiantes()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Docente' ){

			$correo 	  	 = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user'] 	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Estudiantes']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/teacher/estudiantes');
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function anadir_estudiante()
	{
		$cedula   = $this->input->post('cedula');
		$userData = $this->Usuario->traer_usuario_por_cedula($cedula);

		if (count($userData) > 0) {
			$this->Usuario->actualizar_borrado($userData[0]);

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode( 'Estudiante activado con éxito.' ));
		}
		else {
			$datap['cedula']     = $cedula;
			$datap['nombre']     = ucfirst($this->input->post('nombre'));
			$datap['apellido']   = ucfirst($this->input->post('apellido'));
			$datap['telefono']   = $this->input->post('telefono');
			$datap['created_at'] = date('Y-m-d H:i:s');
			$datau['correo']     = $this->input->post('email');
			$datau['clave']      = password_hash($datap['cedula'], PASSWORD_DEFAULT);
			$datau['tipo']       = 'Estudiante';
			$datau['created_at'] = date('Y-m-d H:i:s');

			$seccion = $this->session->userdata()['seccion'];

			$this->Login->crear_cuenta($datap, $datau, $seccion);

			$id = $this->db->select_max('id', 'lastid')->get('usuarios')->result();

			$this->Chat->registrar_user_counter([
				'contador' => 0,
				'usuario_id' => $id[0]->lastid
			]);
		}

		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode( 'Estudiante registrado con éxito.' ));
	}

	public function recursos()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Docente' ){

			$correo 	      = $this->session->userdata()['email'];
			$user['seccion']  = $this->session->userdata()['seccion'];
			$user['user']  	  = $this->Usuario->traer_usuario($correo);
			$user['cantMsg']  = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$seccion          = $this->session->userdata()['seccion'];
			$data['files']    = $this->Archivo->traer_todo($seccion);
			$data['tipoUser'] = $tipoUser;


			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Recursos']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('common/recursos', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function herramientas()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Docente' ){

			$correo 	     = $this->session->userdata()['email'];
			$seccion 		 = $this->session->userdata()['seccion'];

			$user['seccion'] = $seccion;
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['herramientas'] = $this->Archivo->traer_herramientas($seccion);
			$data['seccionid'] 	  = $this->session->userdata()['seccionid'];


			$this->load->view('common/header', ['title' => 'Profesor', 'page' => 'Herramientas para el docente']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/teacher/herramientas', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function traer_estudiantes()
	{
		$seccion = $this->session->userdata()['seccion'];

		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode( $this->Usuario->traer_usuarios($seccion) ));
	}

	public function simuladores()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Docente' ){

			$correo  = $this->session->userdata()['email'];
			$seccion = $this->session->userdata()['seccion'];

			$user['seccion']     = $seccion;
			$user['user']  	     = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] 	 = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['tipoUser']    = $tipoUser;
			$data['seccionid']   = $this->session->userdata()['seccionid'];
			$data['simuladores'] = $this->Archivo->traer_simuladores($seccion);


			$this->load->view('common/header', ['title' => 'Docente', 'page' => 'Simuladores']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/student/simuladores', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function registrar_simulador()
	{
		$nombre 	 = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$enlace 	 = $this->input->post('enlace');
		$seccionid 	 = $this->input->post('seccionid');

		$this->load->library('upload', [
			'upload_path' 	   => set_realpath('application/').'uploads/images',
			'allowed_types'    => 'gif|jpg|png|jpeg',
			'max_size' 		   => 5000,
			'file_ext_tolower' => true,
		]);

		if ( ! $this->upload->do_upload('archivo'))
		{
			$this->session->set_flashdata('fail', $this->upload->display_errors());
			redirect('docente/simuladores');
		}
		else
		{
			$imagen = $this->upload->data();

			$this->Archivo->insertar_simulador([
				'nombre'      => $nombre,
				'enlace'      => $enlace,
				'descripcion' => $descripcion,
				'image'       => $imagen['file_name'],
				'seccion_id'  => $seccionid,
				'created_at'  => date('Y-m-d H:i:s')
			]);

			$this->session->set_flashdata('success', 'Nuevo simulador agregado con éxito.');
			redirect('docente/simuladores');
		}
	}

	public function eliminar_simulador()
	{
		$id = $this->input->post('idsimulador');
		$this->Archivo->borrar_simulador($id);

		$this->session->set_flashdata('success', 'Simulador eliminado con éxito.');
		redirect('docente/simuladores');
	}

	public function registrar_herramienta()
	{
		$nombre 	 = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$enlace 	 = $this->input->post('enlace');
		$seccionid 	 = $this->input->post('seccionid');

		$this->load->library('upload', [
			'upload_path' 	   => set_realpath('application/').'uploads/images',
			'allowed_types'    => 'gif|jpg|png|jpeg',
			'max_size' 		   => 5000,
			'file_ext_tolower' => true,
		]);

		if ( ! $this->upload->do_upload('archivo'))
		{
			$this->session->set_flashdata('fail', $this->upload->display_errors());
			redirect('docente/herramientas');
		}
		else
		{
			$imagen = $this->upload->data();

			$this->Archivo->insertar_herramienta([
				'nombre'      => $nombre,
				'enlace'      => $enlace,
				'descripcion' => $descripcion,
				'imagen'      => $imagen['file_name'],
				'seccion_id'  => $seccionid,
				'created_at'  => date('Y-m-d H:i:s')
			]);

			$this->session->set_flashdata('success', 'Nueva herramienta agregada con éxito.');
			redirect('docente/herramientas');
		}
	}

	public function eliminar_herramienta()
	{
		$id = $this->input->post('idherramienta');
		$this->Archivo->borrar_herramienta($id);

		$this->session->set_flashdata('success', 'Herramienta eliminada con éxito.');
		redirect('docente/herramientas');
	}

	public function asignaciones()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Docente' ){

			$correo  = $this->session->userdata()['email'];
			$seccion = $this->session->userdata()['seccion'];

			$user['seccion']     = $seccion;
			$user['user']  	     = $this->Usuario->traer_usuario($correo);
			$user['cantMsg']     = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['tipoUser']    = $tipoUser;
			$data['seccionid']   = $this->session->userdata()['seccionid'];
			$data['estudiantes'] = $this->Usuario->traer_usuarios($seccion);
			$data['asignadas']   = $this->Asignacion->traer($seccion, 'asignada');

			$data['entregadas']  = $this->Asignacion->traer_respuesta_asignacion($seccion);

			$this->load->view('common/header', ['title' => 'Docente', 'page' => 'Asignaciones']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('k/teacher/asignaciones', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function borrar_asignacion()
	{
		$id = $this->input->post('idasignacion');
		$this->Asignacion->borrar($id);

		$this->session->set_flashdata('success', 'Asignación borrada.');
		redirect('docente/asignaciones');
	}

	public function anadir_asignacion()
	{
		$nombre 	 = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$estudiantes = $this->input->post('usuarios');
		$seccionid   = $this->session->userdata()['seccionid'];

		$this->Asignacion->insertar([
			'nombre' 	  => $nombre,
			'descripcion' => $descripcion,
			'seccion_id'  => $seccionid,
			'created_at'  => date('Y-m-d H:i:s')
		], $estudiantes);

		$this->session->set_flashdata('success', 'Tarea creada con éxito y asignada a '. count($estudiantes). ' estudiante/s');
		redirect('docente/asignaciones');
	}

	public function calificar_asignacion()
	{
		$nota = $this->input->post('nota');
		$id_respuesta_asignacion = $this->input->post('id_respuesta_asignacion');

		$this->Asignacion->calificar($nota, $id_respuesta_asignacion);

		$this->session->set_flashdata('success', 'Tarea calificada con éxito');
		redirect('docente/asignaciones');
	}

	public function reporte_examen()
	{
		$this->load->library('pdfgenerator');

		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Docente' ){
			$seccion  = $this->session->userdata()['seccion'];

			$data['data'] = $this->Examen->reporte($seccion);
			// $this->load->view('common/reporte', $data);

			$html = $this->load->view('common/reporte', $data, true);

			$this->pdfgenerator->generate($html, 'reporte_rendimiento', true, 'letter', 'portrait');
		}
		else {
			redirect('');
		}
	}

	// agregar contendo inicial
	public function contenidoInicial()
	{
		$titulo    = $this->input->post('titulo');
		$contenido = $this->input->post('contenido');
		$seccionid = $this->session->userdata()['seccionid'];

		$this->load->library('upload', [
			'upload_path' 	   => set_realpath('application/').'uploads/images',
			'allowed_types'    => 'gif|jpg|png|jpeg',
			'max_size' 		   => 5000,
			'file_ext_tolower' => true,
		]);

		if ( ! $this->upload->do_upload('image'))
		{
			$this->session->set_flashdata('fail', $this->upload->display_errors());
			redirect('docente');
		}
		else
		{
			$imagen = $this->upload->data();

			$this->Contenido->insertar_contenido_inicial([
				'titulo'      => $titulo,
				'contenido'   => $contenido,
				'image'       => $imagen['file_name'],
				'rutaimg'     => $imagen['full_path'],
				'seccion_id'  => $seccionid,
				'created_at'  => date('Y-m-d H:i:s')
			]);

			$this->session->set_flashdata('success', 'Información del inicio agregada satisfactoriamente.');
			redirect('docente');
		}
	}

	public function borrar_contenido_inicial()
	{
		// $seccion_id = $this->session->userdata()['seccionid'];
		$idcontenido = $this->input->post('idcontenido');
		$contenido   = $this->Contenido->traer_contenido_id($idcontenido);

		unlink($contenido[0]->rutaimg);

		$this->Contenido->eliminar_contenido_inicial($idcontenido);

		$this->session->set_flashdata('success', 'Contenido eliminado correctamente.');
		redirect('docente');
	}

	public function visitas()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Docente' ){

			$correo  = $this->session->userdata()['email'];
			$seccion = $this->session->userdata()['seccion'];

			$user['seccion'] = $seccion;
			$user['user']  	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['visitas']     = $this->Visitas->todas();

			$this->load->view('common/header', ['title' => 'Docente', 'page' => 'Asignaciones']);
			$this->load->view('k/partials/sidenav-teacher', $user);
			$this->load->view('common/visitas', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

}
