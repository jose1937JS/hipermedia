<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Archivo extends CI_Model {

	public function traer_todo($seccion)
	{
		return $this->db->select('archivos.nombre, archivos.tamano, archivos.id as idarchivo, archivos.descripcion, archivos.icon')
					->from('archivos')
					->where('secciones.seccion', $seccion)
					->join('secciones', 'secciones.id = archivos.seccion_id')
					->get()->result();
	}

	public function get_file($idfile)
	{
		return $this->db->get_where('archivos', ['id' => $idfile])->result();
	}

	public function guardar($files)
	{
		foreach ($files as $key => $file) {
			$this->db->insert('archivos', $files[$key]);
		}
	}

	public function eliminar($idfile)
	{
		$this->db->where('id', $idfile);
		$this->db->delete('archivos');
	}


	// LOGICA PARA BORRAR Y AÑADIR HERRAMIENTAS Y SIMULADORES
	public function traer_herramientas($seccion)
	{
		return $this->db->select('herramientas.id as idherramienta, herramientas.nombre, herramientas.enlace, herramientas.descripcion, herramientas.imagen')
				->from('herramientas')
				->where('secciones.seccion', $seccion)
				->join('secciones', 'secciones.id = herramientas.seccion_id')
				->get()->result();
	}

	public function insertar_herramienta($data)
	{
		$this->db->insert('herramientas', $data);
	}

	public function borrar_herramienta($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('herramientas');
	}



	public function traer_simuladores($seccion)
	{
		return $this->db->select('simuladores.id as idsimulador, simuladores.nombre, simuladores.enlace, simuladores.descripcion, simuladores.image')
				->from('simuladores')
				->where('secciones.seccion', $seccion)
				->join('secciones', 'secciones.id = simuladores.seccion_id')
				->get()->result();
	}

	public function insertar_simulador($data)
	{
		$this->db->insert('simuladores', $data);
	}

	public function borrar_simulador($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('simuladores');
	}
}