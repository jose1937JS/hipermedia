<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Usuario');
		$this->load->model('common/Contenido');
		$this->load->model('common/Examen');
		$this->load->model('common/Archivo');
		$this->load->model('common/Asignacion');
		$this->load->helper('my_custom_helper');
	}

	public function index()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Estudiante' ) {

			$correo 	  	 = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['data']    = $this->Contenido->traer_contenido_inicial($user['seccion']);

			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Inicio']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('k/student/index', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}

	}

	public function contenidos()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Estudiante' ){

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$seccion 		 = $this->session->userdata()['seccion'];
			$lapsos          = $this->Contenido->traer_lapsos($seccion);

			$data['lapsos']  = $lapsos;

			$l = [];
			$lapsosUnicos = null;

			foreach ($lapsos as $key => $value) {
				$l[] = $value->lapso;
			}

			if ($l) { $lapsosUnicos = array_unique($l); }


			$data['temas']   = $this->Contenido->temas($seccion);
			$data['cant']    = $lapsosUnicos;
			$data['seccion'] = $seccion;

			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Contenidos']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('k/student/contenido', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function evaluaciones()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Estudiante' ){

			$seccion   = $this->session->userdata()['seccion'];
			$preguntas = $this->Examen->traer_examenes($seccion);

			$correo 		 = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			foreach ($preguntas as $key => $pregunta) {
				if( array_key_exists($key + 1, $preguntas) ){
					if ($preguntas[$key + 1]->idexamen == $pregunta->idexamen) {
						unset($preguntas[$key + 1]);
					}
				}
			}

			$data['evaluaciones'] = $preguntas;
			$data['temas'] 		  = $this->Examen->traer_temas($seccion);


			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Evaluaciones']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('k/student/evaluaciones', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function evaluacion($idexamen)
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Estudiante' ){

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']  	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$preguntas = $this->Examen->traer_examen($idexamen);

			$data['validacion']  = $this->Examen->validar_examen($preguntas[0]->idexamen, $user['user'][0]->idusuario);
			$data['fechalimite'] = date('Y-m-d') > $preguntas[0]->fechaLimite;

			foreach ($preguntas as $key => $pregunta) {
				if ($pregunta->tipo == 'Seleccion Simple') {
					$respIncos[] = $pregunta->respuesta;
					break;
				}
			}

			$data['tiempoTotal'] = $preguntas[0]->duracion;
			$data['fechaPretty'] = $preguntas[0]->fechaPretty;
			$data['preguntas']   = $preguntas;
			$data['user']   	 = $user['user'];

			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Evaluación']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('common/evaluacion_estudiante', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function recursos()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Estudiante' ){

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']  	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$seccion     	   = $this->session->userdata()['seccion'];
			$data['files']     = $this->Archivo->traer_todo($seccion);
			$data['tipoUser']  = $tipoUser;

			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Recursos']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('common/recursos', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function herramientas()
	{
		if ( $this->session->has_userdata('email') && $this->session->userdata('tipo') == 'Estudiante' ){

			$correo 	     = $this->session->userdata()['email'];
			$seccion 		 = $this->session->userdata()['seccion'];

			$user['seccion'] = $seccion;
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['herramientas'] = $this->Archivo->traer_herramientas($seccion);
			$data['seccionid'] 	  = $this->session->userdata()['seccionid'];

			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Herramientas']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('k/student/herramientas', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function simuladores()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Estudiante' ){

			$correo  = $this->session->userdata()['email'];
			$seccion = $this->session->userdata()['seccion'];

			$user['seccion'] = $seccion;
			$user['user']  	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['tipoUser']    = $tipoUser;
			$data['seccionid']   = $this->session->userdata()['seccionid'];
			$data['simuladores'] = $this->Archivo->traer_simuladores($seccion);


			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Simuladores']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('k/student/simuladores', $data);
			$this->load->view('common/footer');
		}
		else {
			redirect('');
		}
	}

	public function asignaciones()
	{
		$tipoUser = $this->session->userdata('tipo');

		if ( $this->session->has_userdata('email') && $tipoUser == 'Estudiante' ){

			$correo  = $this->session->userdata()['email'];
			$seccion = $this->session->userdata()['seccion'];

			$user['seccion'] = $seccion;
			$user['user']  	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			$data['tipoUser']   = $tipoUser;
			$data['seccionid']  = $this->session->userdata()['seccionid'];
			$data['nuevas']     = $this->Asignacion->traer_por_usuario($seccion, 'asignada', $correo);
			// $data['entregadas'] = $this->Asignacion->traer_por_usuario($seccion, 'entregada', $correo);

			$data['entregadas'] = $this->Asignacion->traer_respuesta_asignacion($seccion, $correo);
			// jsondie($data['entregadas']);


			$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Asignaciones']);
			$this->load->view('k/partials/sidenav-student', $user);
			$this->load->view('k/student/asignaciones', $data);
			$this->load->view('common/footer');

		}
		else {
			redirect('');
		}
	}

	public function responder_asignacion()
	{
		$config['upload_path']      = set_realpath('application/').'uploads/assingments';
		$config['allowed_types']    = 'pdf|doc|docx|odf|odt|png|jpeg|jpg|pptx';
		$config['max_size']         = 50000;
		$config['file_ext_tolower'] = true;

		$this->load->library('upload', $config);

		$respuesta = $this->input->post('respuesta');
		$asignacion_usuario_id = $this->input->post('asignacion_usuario_id');
		$success   = false;

		$dataFile = [];

			// $_FILES['archivo']['name']     = $_FILES['archivos']['name'][$i];
			// $_FILES['archivo']['tmp_name'] = $_FILES['archivos']['tmp_name'][$i];
			// $_FILES['archivo']['size']     = $_FILES['archivos']['size'][$i];
			// $_FILES['archivo']['type']     = $_FILES['archivos']['type'][$i];

		if ($success = $this->upload->do_upload('archivo')) {

			$data = $this->upload->data();

			$dataFile['respuesta'] = $respuesta;
			$dataFile['archivo']   = $data['file_name'];
			$dataFile['ext']       = $data['file_ext'];

			if ( preg_match("/\.pdf/", $dataFile['ext']) ){
				$dataFile['icon'] = 'file-pdf';
			}
			if ( preg_match("/\.pptx/", $dataFile['ext']) ){
				$dataFile['icon'] = 'file-powerpoint';
			}
			else if (preg_match("/\.png/", $dataFile['ext']) ||
					preg_match("/\.jpg/", $dataFile['ext'])  ||
					preg_match("/\.jpeg/", $dataFile['ext']) ||
					preg_match("/\.gif/", $dataFile['ext']))
			{
				$dataFile['icon'] = 'file-image';
			}
			else if(preg_match("/\.doc/", $dataFile['ext']) ||
					preg_match("/\.odf/", $dataFile['ext']) ||
					preg_match("/\.odt/", $dataFile['ext']))
			{
				$dataFile['icon'] = 'file-word';
			}

			$dataFile['asignacion_usuario_id'] = $asignacion_usuario_id;
			$dataFile['created_at'] = date('Y-m-d H:i:s');

		}
		else {
			$error = $this->upload->display_errors('<span>', '</span>');
			$this->session->set_flashdata('error', $error);

			redirect('estudiante/asignaciones');
		}

		if ($success) {
			$this->Asignacion->guardar_respuesta($dataFile);
			$this->session->set_flashdata('archivos', "Tu respuesta se ha enviado correctamente.");

			redirect('estudiante/asignaciones');
		}

		redirect('estudiante/asignaciones');
	}

}
