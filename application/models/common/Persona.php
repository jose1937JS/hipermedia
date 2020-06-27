<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function traer_cedula($cedula)
	{
		return $this->db->select('cedula')
						->from('personas')
						->where('cedula', $cedula)
						->where('usuarios.deleted', 'false')
						->join('usuarios', 'personas.id = usuarios.persona_id')
						->get()->result();
	}
}