<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {


	public function crear_cuenta($dataP, $dataU, $seccion)
	{
		$this->db->insert('personas', $dataP);

		$persona = $this->db->query('select max(id) as lastid from personas')->result();
		$dataU['persona_id'] = $persona[0]->lastid;

		$this->db->insert('usuarios', $dataU);
		$usuario = $this->db->query('select max(id) as lastid from usuarios')->result();

		$this->db->insert('secciones', [
			'seccion' 	 => $seccion,
			'usuario_id' => $usuario[0]->lastid,
			'created_at' => date('Y-m-d H:i:s')
		]);
	}

	public function cambiar_clave($clave, $correo)
	{
		$data['clave'] 	    = $clave;
		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->db->update('usuarios', $data, ['correo' => $correo]);
	}

	public function validar_usuario_en_seccion($seccion)
	{
		return $this->db->select('usuarios.correo')
				->from('secciones')
				->where('secciones.seccion', $seccion)
				->where('usuarios.tipo', 'Docente')
				->join('usuarios', 'usuarios.id = secciones.usuario_id')
				->get()->result();
	}

}