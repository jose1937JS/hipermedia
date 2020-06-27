<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ContenidoController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Contenido');
		$this->load->model('common/Usuario');
	}

	public function mostrar_contenido($idtema)
	{
		if ( $this->session->has_userdata('email') ){

			$data['contenido'] = $this->Contenido->get_content($idtema);
			$data['userTipo']  = $this->session->userdata('tipo');

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;

			if ( $this->session->userdata('tipo') == 'Docente' ){
				$this->load->view('common/header', ['title' => 'Docente', 'page' => 'Contenidos']);
				$this->load->view('k/partials/sidenav-teacher', $user);
				$this->load->view('k/teacher/contenidoview', $data);
				$this->load->view('common/footer');
			}
			else {
				$this->load->view('common/header', ['title' => 'Estudiante', 'page' => 'Contenidos']);
				$this->load->view('k/partials/sidenav-student', $user);
				$this->load->view('k/teacher/contenidoview', $data);
				$this->load->view('common/footer');
			}
		}
		else {
			redirect('');
		}

	}

	public function agregar_contenido()
	{
		$tema  	   = $this->input->post('tema');
		$lapso     = $this->input->post('lapso');
		$contenido = $this->input->post('contenido');
		$seccionid = $this->session->userdata()['seccionid'];

		// $res = $this->Contenido->verificar_lapso($lapso, $seccionid);

		// if ($res) {
		// 	return $this->output
		// 		->set_content_type('application/json')
		// 		->set_output(json_encode( true ));
		// }
		// -----------------------------------------------------------------

		$datac['contenido']  = $contenido;
		// $datac['seccion_id'] = $seccionid;
		$datac['created_at'] = date('Y-m-d H:i:s');

		$datat['lapso']      = $lapso;
		$datat['tema']       = $tema;
		$datat['seccion_id'] = $seccionid;
		$datat['created_at'] = date('Y-m-d H:i:s');

		$this->Contenido->crear_contenido($datac, $datat);
	}

	public function traer_temas()
	{
		$lapso   = $this->input->post('lapso');
		$seccion = $this->input->post('seccion');

		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode( $this->Contenido->traer_temas($lapso, $seccion) ));
	}

	public function traer_contenido()
	{
		$idtema  = $this->input->post('idtema');

		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode( $this->Contenido->traer_contenido($idtema) ));
	}

	public function delTemaContenido()
	{
		if ( $this->session->userdata('tipo') == 'Estudiante' ) {
			jsondie('nop');
		}
		else {

			$idtema = $this->input->post('idtema');

			$this->Contenido->eliminarTema($idtema);

			jsondie('Tema eliminado correctamente');
		}
	}
}