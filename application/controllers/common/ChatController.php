<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChatController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Usuario');
		$this->load->model('common/Chat');
	}

	public function index()
	{
		if ( $this->session->has_userdata('email')){

			$correo 	     = $this->session->userdata()['email'];
			$user['seccion'] = $this->session->userdata()['seccion'];
			$user['user']    = $this->Usuario->traer_usuario($correo);

			$data['seccionid']   = $this->session->userdata()['seccionid'];
			$data['usuarioid']   = $user['user'][0]->idusuario;
			$data['seccion']     = $user['seccion'];

			$this->Chat->visto($user['user'][0]->idusuario);

			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;


			if ( $this->session->userdata('tipo') == 'Docente' ){
				$this->load->view('common/header', ['title' => 'Chat', 'page' => 'Profesor']);
				$this->load->view('k/partials/sidenav-teacher', $user);
				$this->load->view('common/chat', $data);
				$this->load->view('common/footer');
			}
			else {
				$this->load->view('common/header', ['title' => 'Chat', 'page' => 'Estudiante']);
				$this->load->view('k/partials/sidenav-student', $user);
				$this->load->view('common/chat', $data);
				$this->load->view('common/footer');
			}
		}
		else {
			redirect('');
		}
	}

	public function registrar_mensaje()
	{
		$mensaje   = $this->input->post('mensaje');
		$usuarioid = $this->input->post('usuarioid');
		$seccionid = $this->input->post('seccionid');

		$seccion  = $this->session->userdata()['seccion'];
		// $usuarios = $this->Usuario->traer_usuarios($seccion);

		$this->Chat->registrar_mensaje([
			'mensaje'    => $mensaje,
			'usuario_id' => $usuarioid,
			'seccion_id' => $seccionid,
			'created_at' => date('Y-m-d H:i:s')
		]);

		jsondie('success');
	}

	public function traer_mensajes($seccion, $usuarioid)
	{
		$mensajes = $this->Chat->traer_mensajes($seccion);
		$html = "";

		foreach ($mensajes as $key => $mensaje) {
			if ($mensaje->idusuario == $usuarioid) {
				echo "<div class='d-flex justify-content-end my-3'>
					<div class='row grey lighten-3 py-2 w-75 rounded-left-pill'>
						<div class='col'>
							<div class='d-flex justify-content-end align-items-start'>
								<p>
									<span>
										<i class='fas fa-user-circle mr-2'></i> $mensaje->nombre $mensaje->apellido
									</span><br>
									<small class='text-muted text-right d-'>
										<i class='fas fa-clock mr-2'></i> $mensaje->created_at
									</small>
								</p>
							</div>
							<p class='text-right'> $mensaje->mensaje</p>
						</div>
						<div class='col-2'>
							<img src='http://127.0.0.1/hipermedia/application/uploads/avatars/$mensaje->avatar' class='img-fluid rounded' alt='image thumbnail'>
						</div>
					</div>
				</div>";
			}
			else {
				echo "<div class='d-flex justify-content-start my-3'>
					<div class='row grey lighten-3 py-3 w-75 rounded-right-pill'>
						<div class='col-2'>
							<img src='http://127.0.0.1/hipermedia/application/uploads/avatars/$mensaje->avatar' class='img-fluid rounded' alt='image thumbnail'>
						</div>
						<div class='col'>
							<div class='d-flex justify-content-between align-items-start'>
								<p>
									<span>
										<i class='fas fa-user-circle mr-2'></i> $mensaje->nombre $mensaje->apellido
									</span><br>
									<small class='text-muted'>
										<i class='fas fa-clock mr-2'></i>$mensaje->created_at
									</small>
								</p>
							</div>
							<p>$mensaje->mensaje</p>
						</div>
					</div>
				</div>";
			}
		}
	}
}