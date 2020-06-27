<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ResourceController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Archivo');
	}

	public function json($data)
	{
		header('Content-Type: application/json');
		return json_encode($data);
	}

	public function uploadResource()
	{
		$config['upload_path']      = set_realpath('application/').'uploads/files';
		$config['allowed_types']    = 'pdf|doc|docx|ppt|pptx|odf|odt|mp4|mpeg|flv|avi|mkv|jpg|png|gif|jpeg';
		$config['max_size']         = 100000;
		$config['file_ext_tolower'] = true;

		$this->load->library('upload', $config);

		$cantidad 	 = $this->input->post('cantidad');
		$descripcion = $this->input->post('descripcion');
		$seccionid   = $this->session->userdata()['seccionid'];
		$success 	 = false;

		$dataFiles = [];

		if ( !empty($_FILES['archivos']) ){

			for ($i=0; $i < $cantidad; $i++) {

				$_FILES['archivo']['name'] 	   = $_FILES['archivos']['name'][$i];
				$_FILES['archivo']['type']     = $_FILES['archivos']['type'][$i];
				$_FILES['archivo']['tmp_name'] = $_FILES['archivos']['tmp_name'][$i];
				$_FILES['archivo']['error']    = $_FILES['archivos']['error'][$i];
				$_FILES['archivo']['size']     = $_FILES['archivos']['size'][$i];

				if ($success = $this->upload->do_upload('archivo')) {

					$data = $this->upload->data();

					$dataFiles[$i]['tipo']     = $data['file_type'];
					$dataFiles[$i]['nombre']   = $data['file_name'];
					$dataFiles[$i]['tamano']   = round($data['file_size'] / 1024, 2);
					$dataFiles[$i]['ext']      = $data['file_ext'];
					$dataFiles[$i]['ruta']     = $data['full_path'];

					if ( preg_match("/\.pdf/", $dataFiles[$i]['ext']) ){
						$dataFiles[$i]['icon'] = 'file-pdf';
					}
					else if ( preg_match("/\.mp4/", $dataFiles[$i]['ext']) ||
							preg_match("/\.mpeg/",  $dataFiles[$i]['ext']) ||
							preg_match("/\.mkv/",   $dataFiles[$i]['ext']) ||
							preg_match("/\.flv/",   $dataFiles[$i]['ext']) )
					{
						$dataFiles[$i]['icon'] = 'file-video';
					}
					else if ( preg_match("/\.ppt/", $dataFiles[$i]['ext']) ){
						$dataFiles[$i]['icon'] = 'file-powerpoint';
					}
					else if(preg_match("/\.png/",  $dataFiles[$i]['ext']) ||
							preg_match("/\.jpg/",  $dataFiles[$i]['ext']) ||
							preg_match("/\.jpeg/", $dataFiles[$i]['ext']) ||
							preg_match("/\.gif/",  $dataFiles[$i]['ext']))
					{
						$dataFiles[$i]['icon'] = 'file-image';
					}
					else if(preg_match("/\.doc/", $dataFiles[$i]['ext']) ||
							preg_match("/\.odf/", $dataFiles[$i]['ext']) ||
							preg_match("/\.odt/", $dataFiles[$i]['ext']))
					{
						$dataFiles[$i]['icon'] = 'file-word';
					}

					$dataFiles[$i]['descripcion'] = $descripcion;
					$dataFiles[$i]['seccion_id']  = $seccionid;
					$dataFiles[$i]['created_at']  = date('Y-m-d H:i:s');
				}
				else {
					$error = $this->upload->display_errors('<span>', '</span>');
					$this->session->set_flashdata('error', $error);

					redirect('docente/recursos');
				}
			}

			if ($success) {
				if ($cantidad > 1) {
					$this->Archivo->guardar($dataFiles);
					$this->session->set_flashdata('archivos', "Los $cantidad archivos se subieron correctamente.");

					redirect('docente/recursos');
				}
				else {
					$this->Archivo->guardar($dataFiles);

					$this->session->set_flashdata('archivos', "El archivo se subió correctamente.");
					redirect('docente/recursos');
				}
			}

			redirect('docente/recursos');
		}
		else {
			$this->session->set_flashdata('error', "Los archivos han sobrepasado el límite máximo de mega bytes permitido por el servidor en una sola petición, inténtalo con menos archivos.");

			redirect('docente/recursos');
		}
	}

	public function deleteResource($idfile)
	{
		$file = $this->Archivo->get_file($idfile);

		$success = unlink($file[0]->ruta);

		if ($success){
			$this->Archivo->eliminar($idfile);
			$this->session->set_flashdata('archivos', "El archivo se eliminó correctamente.");
		}
		else {
			$this->session->set_flashdata('error', "Ha ocurrido un problema eliminando el archivo.");
		}

		redirect('docente/recursos');
	}
}