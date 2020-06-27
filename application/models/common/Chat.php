<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Model {

	public function traer_mensajes($seccion)
	{
		return $this->db->select('personas.nombre, personas.apellido, usuarios.avatar, usuarios.id as idusuario, chat.mensaje, chat.created_at')
					->from('chat')
					->where('secciones.seccion', $seccion)
					->join('usuarios', 'usuarios.id = chat.usuario_id')
					->join('personas', 'personas.id = usuarios.persona_id')
					->join('secciones', 'secciones.id = chat.seccion_id')
					->order_by('chat.id', 'asc')
					->get()->result();
	}

	public function registrar_user_counter($data)
	{
		$this->db->insert('chat_counter', $data);
	}

	public function registrar_mensaje($data)
	{
		$usuarios = $this->db->get('chat_counter')->result();

		foreach ($usuarios as $key => $value) {
			// $cant = $this->db->get_where('chat_counter', ['usuario_id' => $value->idusuario])->result();

			// $this->db->update('chat_counter', ['contador' => $cant[0]->contador + 1], ['usuario_id' => $data['usuario_id']]);
			$this->db->update('chat_counter', ['contador' => $value->contador + 1], ['usuario_id' => $value->usuario_id]);
		}

		$this->db->insert('chat', $data);
	}

	public function visto($iduser)
	{
		$this->db->update('chat_counter', ['contador' => 0], ['usuario_id' => $iduser]);
	}

}