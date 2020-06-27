<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {


	// public function traer_correo($email)
	// {
	// 	return $this->db->get_where('usuarios', ['correo' => $email])->result();
	// }

	public function traer_usuarios($seccion)
	{
		return $this->db->select('personas.cedula, personas.nombre, personas.apellido, personas.telefono, usuarios.correo, usuarios.id as idusuario, personas.id as idpersona')
						->from('usuarios')
						->where('usuarios.tipo', 'Estudiante')
						->where('secciones.seccion', $seccion)
						->where('usuarios.deleted', 'false')
						->join('personas', 'personas.id = usuarios.persona_id')
						->join('secciones', 'usuarios.id = secciones.usuario_id')
						->get()->result();
	}

	public function traer_usuario($email)
	{
		return $this->db->select('personas.cedula, personas.nombre, personas.apellido, personas.telefono, usuarios.correo, usuarios.clave, usuarios.tipo, usuarios.avatar, usuarios.created_at, usuarios.id as idusuario, personas.id as idpersona')
						->from('usuarios')
						->where('usuarios.correo', $email)
						->where('usuarios.deleted', 'false')
						->join('personas', 'personas.id = usuarios.persona_id')
						->get()->result();
	}

	public function traer_usuario_por_cedula($cedula)
	{
		return $this->db->select('personas.cedula, personas.nombre, personas.apellido, personas.telefono, usuarios.correo, usuarios.clave, usuarios.tipo, usuarios.avatar, usuarios.created_at, usuarios.id as idusuario, personas.id as idpersona, usuarios.deleted')
						->from('usuarios')
						->where('personas.cedula', $cedula)
						->join('personas', 'personas.id = usuarios.persona_id')
						->get()->result();
	}

	public function actualizarUsuario($userdata, $peopledata, $iduser, $idpeople)
	{
		$this->db->where('id', $iduser);
		$this->db->update('usuarios', $userdata);

		$this->db->where('id', $idpeople);
		$this->db->update('personas', $peopledata);
	}

	public function actualizarAvatar($avatar, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('usuarios', $avatar);
	}

	public function eliminarUsuario($idusuario)
	{
		$this->db->update('usuarios', ['deleted' => 'true'], ['id' => $idusuario]);
	}

	public function actualizar_borrado($usuario)
	{
		$this->db->update('usuarios', [
			'clave'   => password_hash($usuario->cedula, PASSWORD_DEFAULT),
			'deleted' => 'false'
		], ['id' => $usuario->idusuario]);
	}
}