<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Login');
		$this->load->model('common/Usuario');
		$this->load->model('common/Persona');
		$this->load->model('common/Password_Reset');
		$this->load->model('common/Seccion');
		$this->load->model('common/Visitas');
		$this->load->model('common/Chat');
		$this->load->helper('string');
	}

	public function index()
	{
		$this->load->view('common/header', ['title' => 'Hipermedia', 'page' => 'Login']);
		$this->load->view('k/auth/login');
		$this->load->view('common/footer');
	}

	public function login()
	{
		$email = $this->input->post('correo');
		$clave = $this->input->post('clave');

		$user_data = $this->Usuario->traer_usuario($email);

		if ($user_data) {
			$seccion = $this->Seccion->traer_seccion($user_data[0]->correo);

			if ( password_verify($clave, $user_data[0]->clave) ){

				$this->Visitas->registrar([
					// 'ip'         => $ip,
					'usuario'    => $user_data[0]->correo,
					'tipo'       => $user_data[0]->tipo,
					'created_at' => date('Y-m-d H:i:s')
				]);

				if ( $user_data[0]->tipo == 'Estudiante' ){
					$this->session->set_userdata([
						'email' 	=> $email,
						'tipo' 		=> 'Estudiante',
						'seccion'   => $seccion[0]->seccion,
						'seccionid' => $seccion[0]->id
					]);

					return $this->output
							->set_content_type('application/json')
							->set_output(json_encode([
								'code'    => 200,
								'type' 	  => 'Estudiante',
								'message' => 'Usuario estudiante logeado correctamente.'
							]));
				}
				else {
					$this->session->set_userdata([
						'email' 	=> $email,
						'tipo' 		=> 'Docente',
						'seccion'   => $seccion[0]->seccion,
						'seccionid' => $seccion[0]->id
					]);

					return $this->output
						->set_content_type('application/json')
						->set_output(json_encode([
							'code' 	  => 200,
							'type' 	  => 'Docente',
							'message' => 'Usuario docente logeado correctamente.'
						]));
				}

			}
		}

		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(['code' => 403, 'message' => 'Usuario o contraseña incorrecto.']));
	}

	public function register()
	{
		$clave   = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
		$seccion = $this->input->post('seccion');

		$datap['cedula']  	 = ucfirst($this->input->post('cedula'));
		$datap['nombre']  	 = ucfirst($this->input->post('nombre'));
		$datap['apellido']   = ucfirst($this->input->post('apellido'));
		$datap['telefono']   = $this->input->post('telefono');
		$datap['created_at'] = date('Y-m-d H:i:s');
		$datau['correo']     = $this->input->post('correo');
		$datau['clave'] 	 = $clave;
		$datau['created_at'] = date('Y-m-d H:i:s');

		// validar que no haya otro prof en la misma seccion
		$usuario = $this->Login->validar_usuario_en_seccion($seccion);

		if ($usuario) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(['error', 'Ya existe un profesor en ésta sección.']));
		}
		else {
			$this->Login->crear_cuenta($datap, $datau, $seccion);
			$id = $this->db->select_max('id', 'lastid')->get('usuarios')->result();

			$this->Chat->registrar_user_counter([
				'contador' => 0,
				'usuario_id' => $id[0]->lastid
			]);

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success', 'Su usuario se ha creado satisfactoriamente, ahora inicia sesión.']));
		}

	}

	public function logout()
	{
		if ($this->session->has_userdata('email')) {

			$this->session->unset_userdata('email');
			$this->session->set_flashdata('logout', 'Usuario desconectado correctamente.');
		}

		redirect('');

	}

	public function getsession()
	{
		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode( ['session' => $this->session->has_userdata('email') ]));
	}

	public function verificar_cedula()
	{
		$cedula = $this->input->post('cedula');
		$ci 	= $this->Persona->traer_cedula($cedula);

		if ($ci) {
			return $this->output
					->set_content_type('application/json')
					->set_output(json_encode('Esta cédula ya se encuentra registrada.'));
		}
	}

	public function verificar_correo()
	{
		$correo = $this->input->post('correo');
		$mail   = $this->Usuario->traer_usuario($correo);

		if ($mail) {
			return $this->output
					->set_content_type('application/json')
					->set_output(json_encode('Este correo ya se encuentra registrado.'));
		}
	}

	public function recuperar_contrasena()
	{
		$mail = $this->Usuario->traer_usuario($this->input->post('correo'));

		if ($mail) {

			$config['protocol']    = "smtp";
			$config['smtp_crypto'] = "ssl";
			$config['smtp_host']   = "smtp.googlemail.com";
			$config['smtp_port']   = 465;
			$config['smtp_user']   = "kisbelpacheco@gmail.com";
			$config['smtp_pass']   = "26464268kis";
			$config['mailtype']    = "html";
			$config['charset']     = "utf-8";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// $data['token']  	 = password_hash($this->input->post('correo'), PASSWORD_DEFAULT);
			$data['token']  	 = random_string('alnum', 60);
			$data['email'] 		 = $this->input->post('correo');
			$data['expire_date'] = date('Y-m-d H:i:s', strtotime('+1 hour'));
			$data['created_at']  = date('Y-m-d H:i:s');
			$message 			 = $this->load->view('common/restoring_password', $data, true);

			// cambiar esto por el correo del usuario admin del sistema
			$this->email->from('kisbelpacheco@gmail.com')
						->to($data['email'])
						->subject('Hipermedia | Restaurar contraseña')
						->message($message)
						->set_mailtype('html');

			if ($this->email->send()) {
				// guardar los tiempos de expiracion y el de ahora junto con el correo para validarlo lego mas abajito
				$this->Password_Reset->fill($data);

				return $this->output
						->set_content_type('application/json')
						->set_output(json_encode([true, $this->email->print_debugger()]));
			}
			else {
				return $this->output
						->set_content_type('application/json')
						->set_output(json_encode([false, $this->email->print_debugger()]));
			}
		}
		else {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(['404']));
		}
	}

	public function restoring_password($token)
	{
		$data = $this->Password_Reset->get_all($token);

		if ( $data) {

			$now = date('Y-m-d H:i:s');

			if ($now > $data[0]->expire_date) {
				$this->load->view('common/header', ['title' => 'Hipermedia', 'page' => 'Enlace expirado']);
				$this->load->view('common/restore_password_deprecated', ['msg' => 'El enlace ha expirado.']);
				$this->load->view('common/footer');
			}
			else {
				$this->load->view('common/header', ['title' => 'Hipermedia', 'page' => 'Nueva Contraseña']);
				$this->load->view('common/restore_password');
				$this->load->view('common/footer');
			}
		}
		else {
			$this->load->view('common/header', ['title' => 'Hipermedia', 'page' => 'Hash inválido']);
			$this->load->view('common/restore_password_deprecated', ['msg' => 'El hash no es válido.']);
			$this->load->view('common/footer');
		}

	}

	public function cambiar_clave()
	{
		$clave 		 = $this->input->post('clave');
		$email 		 = $this->input->post('correo');
		$nueva_clave = password_hash($clave, PASSWORD_DEFAULT);

		$this->Login->cambiar_clave($nueva_clave, $email);

		return $this->output
					->set_content_type('application/json')
					->set_output(json_encode('Clave del usuario cambiada satisfactoriamente.'));
	}


	public function perfil()
	{
		if ( $this->session->has_userdata('email') ){

			$correo 		 = $this->session->userdata()['email'];
			$user['user'] 	 = $this->Usuario->traer_usuario($correo);
			$user['cantMsg'] = chat_notification($user['user'][0]->idusuario)[0]->contador;
			$user['seccion'] = $this->session->userdata()['seccion'];


			if ($this->session->userdata('tipo') == 'Docente') {
				$this->load->view('common/header', ['title' => 'Hipermedia', 'page' => 'Perfil']);
				$this->load->view('k/partials/sidenav-teacher', $user);
				$this->load->view('common/perfil', $user);
				$this->load->view('common/footer');
			}
			else {
				$this->load->view('common/header', ['title' => 'Hipermedia', 'page' => 'Perfil']);
				$this->load->view('k/partials/sidenav-student', $user);
				$this->load->view('common/perfil', $user);
				$this->load->view('common/footer');
			}
		}
		else {
			redirect('');
		}
	}

	public function deleteProfile()
	{
		$idusuario = $this->input->post('idusuario');

		$this->Usuario->eliminarUsuario($idusuario);

		jsondie('Usuario eliminado correctamente');
	}

	public function updateProfile()
	{
		$hiddenEmail  = $this->input->post('hiddenEmail');
		$dbUser 	  = $this->Usuario->traer_usuario($hiddenEmail);
		$currentPass  = $dbUser[0]->clave;
		$clave 		  = $this->input->post('clave') == '' ? $currentPass : password_hash($this->input->post('clave'), PASSWORD_DEFAULT);

		$nombre    = $this->input->post('nombre');
		$apellido  = $this->input->post('apellido');
		$correo    = $this->input->post('correo');
		$telefono  = $this->input->post('telefono');
		$idusuario = $this->input->post('idusuario');
		$idpersona = $this->input->post('idpersona');

		$peopledata = [
			'nombre'     => $nombre,
			'apellido'   => $apellido,
			'telefono'   => $telefono,
			'updated_at' => date('Y-m-d H:i:s')
		];

		$userdata = [
			'correo' 	 => $correo,
			'clave'      => $clave,
			'updated_at' => date('Y-m-d H:i:s')
		];

		$this->Usuario->actualizarUsuario($userdata, $peopledata, $idusuario, $idpersona);

		$this->session->set_flashdata('success', 'Información del usuario actualizada correctamente');
		redirect('perfil');
	}

	public function cambiarAvatar()
	{
		$config['upload_path']   = set_realpath('application/').'uploads/avatars';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = 5000;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('avatar') ){

			$this->session->set_flashdata('fail', $this->upload->display_errors());
			redirect('perfil');
		}
		else {
			$correo = $this->session->userdata()['email'];
			$user   = $this->Usuario->traer_usuario($correo);

			$data   = $this->upload->data();

			$avatar = [
				'avatar' 	 => $data['file_name'],
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->Usuario->actualizarAvatar($avatar, $user[0]->idusuario);

			$this->session->set_flashdata('success', 'Foto de perfil actualizada correctamente');
			redirect('perfil');
		}
	}
}