<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seccion extends CI_Model {

	public function traer_seccion($correo)
	{
		return $this->db->select('secciones.seccion, usuarios.correo, secciones.id')
					->from('secciones')
					->where('usuarios.correo', $correo)
					->join('usuarios', 'usuarios.id = secciones.usuario_id')
					->get()->result();
	}
}