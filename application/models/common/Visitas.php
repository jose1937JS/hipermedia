<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas extends CI_Model {

	public function registrar($data)
	{
		$this->db->insert('visitas', $data);
	}

	public function todas()
	{
		return $this->db->get('visitas')->result();
	}

}