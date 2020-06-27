<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido extends CI_Model {


	public function crear_contenido($datac, $datat)
	{
		$this->db->insert('temas', $datat);

		$temaid = $this->db->select_max('id', 'lastid')->get('temas')->result();
		$datac['tema_id'] = $temaid[0]->lastid;

		$this->db->insert('contenidos', $datac);
	}

	public function verificar_lapso($lapso, $seccionid)
	{
		return $this->db->select('temas.lapso, temas.tema, temas.seccion_id')
					->from('contenidos')
					->where('temas.deleted', 'false')
					->where('temas.seccion_id', $seccionid)
					->where('temas.lapso', $lapso)
					->join('temas', 'temas.id = contenidos.tema_id')
					->get()->result();
	}

	public function temas($seccion)
	{
		return $this->db->select('temas.tema, temas.id as idtema, temas.lapso, temas.created_at, contenidos.id as idcontenido')
					->from('contenidos')
					->where('secciones.seccion', $seccion)
					->join('temas', 'temas.id = contenidos.tema_id')
					->where('temas.deleted', 'false')
					->join('secciones', 'secciones.id = temas.seccion_id')
					->get()->result();
	}

	public function traer_lapsos($seccion)
	{
		return $this->db->select('temas.lapso')
					->from('temas')
					->where('temas.deleted', 'false')
					->where('secciones.seccion', $seccion)
					->join('secciones', 'secciones.id = temas.seccion_id')
					->get()->result();

	}

	public function traer_temas($lapso, $seccion)
	{
		return $this->db->select('temas.tema, temas.id as idtema')
					->from('temas')
					->where('temas.deleted', 'false')
					->where('temas.lapso', $lapso)
					->where('secciones.seccion', $seccion)
					->join('secciones', 'secciones.id = temas.seccion_id')
					->get()->result();

		// return $this->db->get_where('temas', ['lapso' => $lapso, 'seccion' => $seccion]);
	}

	public function traer_contenido($idtema)
	{
		return $this->db->select('contenidos.contenido, temas.lapso, temas.tema')
					->from('contenidos')
					->where('temas.deleted', 'false')
					->where('contenidos.tema_id', $idtema)
					->join('temas', 'temas.id = contenidos.tema_id')
					->get()->result();

		// return $this->db->get_where('contenidos', ['tema_id' => $idtema])->result();
	}

	public function get_content($temaid)
	{
		return $this->db->select('contenidos.contenido, temas.lapso, temas.tema')
					->from('contenidos')
					->where('contenidos.tema_id', $temaid)
					->where('temas.deleted', 'false')
					->join('temas', 'temas.id = contenidos.tema_id')
					->get()->result();
	}

	public function eliminarTema($idtema)
	{
		$this->db->delete('contenidos', ['tema_id' => $idtema]);
		$this->db->update('temas', ['deleted' => 'true'], ['id' => $idtema]);
	}


	public function insertar_contenido_inicial($data)
	{
		$this->db->insert('contenido_inicial', $data);
	}

	public function traer_contenido_inicial($seccion)
	{
		return $this->db->select('contenido_inicial.id, contenido_inicial.rutaimg, contenido_inicial.titulo, contenido_inicial.contenido, contenido_inicial.image')
				->from('contenido_inicial')
				->where('secciones.seccion', $seccion)
				->join('secciones', 'secciones.id = contenido_inicial.seccion_id')
				->get()->result();
	}

	public function traer_contenido_id($id)
	{
		return $this->db->select('rutaimg')
				->from('contenido_inicial')
				->where('id', $id)
				->get()->result();
	}

	public function eliminar_contenido_inicial($id)
	{
		$this->db->delete('contenido_inicial', ['id' => $id]);
	}
}