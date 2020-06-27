<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Asignacion extends CI_Model {

	public function traer($seccion, $estado)
	{
		$asignacionUsuario = $this->db->select('asignaciones.id, asignaciones.nombre as nombre_asignacion, asignaciones.descripcion, asignaciones.created_at, personas.nombre as nombre_estudiante, personas.apellido')
				->from('asignacion_usuario')
				->where('asignaciones.deleted', 'false')
				->where('secciones.seccion', $seccion)
				->where('asignacion_usuario.estado', $estado)
				->order_by('created_at', 'DESC')
				->join('asignaciones', 'asignaciones.id = asignacion_usuario.asignacion_id')
				->join('usuarios', 'usuarios.id = asignacion_usuario.usuario_id')
				->join('personas', 'personas.id = usuarios.persona_id')
				->join('secciones', 'secciones.id = asignaciones.seccion_id')
				->get()->result();

		if (count($asignacionUsuario) > 0) {

			// Retorna un array con las asignaciones sin repetir
			foreach ($asignacionUsuario as $value) {
				$r[] = $value->nombre_asignacion;
				$regs = array_unique($r);
			}

			// Agrupar las asignaciones iguales en una matriz (retorna la matriz $a con valores null)
			foreach ($regs as $key => $reg) {
				$a[] = array_map(function($v) use ($reg){
					if( preg_match("/^".$reg."$/", $v->nombre_asignacion) ){
						return 	[
							'id'          => $v->id,
							'nombre_asignacion' => $v->nombre_asignacion,
							'descripcion' => $v->descripcion,
							'created_at'  => $v->created_at,
							'estudiante'  => $v->nombre_estudiante.' '.$v->apellido
						];
					}
				}, $asignacionUsuario);
			}
			// Eliminar de $a todos los valores nulos
			foreach ($a as $key => $values) {
				foreach ($values as $k => $value) {
					if( is_null($value) ){
						unset($a[$key][$k]);
					}
				}
				$a[$key] = array_values($a[$key]);
			}

			// sacar los estudiantes de las asignaciones, CUantos estudiantes hay por asignacion? - retorna todos los etudiantes relacionados a su asignacion
			foreach ($a as $key => $asigs) {
				foreach ($asigs as $k => $asig) {

					$asigs[$k]["estudiantes"][] = $asigs[$k]["estudiante"];

					if ( array_key_exists(($k + 1), $asigs)) {
						if ($asig["nombre_asignacion"] == $asigs[$k + 1]["nombre_asignacion"]) {
							$asigs[0]["estudiantes"][] = $asigs[$k + 1]["estudiante"];
						}
						unset($asigs[$k]['estudiante']);
					}
					else {
						unset($asigs[$k]['estudiante']);
					}
				}
				$var[] = $asigs;
			}

			// Eliminar las asignaciones que se repiten innecesariamente
			foreach ($var as $key => $val) {
				for ($i = 1; $i < count($val); $i++) {
					if ($val[$i]['nombre_asignacion'] == $val[$i - 1]['nombre_asignacion']) {
						unset($var[$key][$i]);
					}
				}
			}

			// foreach ($var as $key => $value) {
			// 	if (array_key_exists('estudiantes', $value)) {
			// 		// unset($var[$key]);
			// 		$var[$key]['estudiantes'] = array_unique($value['estudiantes']);
			// 	}
			// }

			return $var;
		}

		return $asignacionUsuario;
	}

	public function traer_por_usuario($seccion, $estado, $correo)
	{
		$asignacionUsuario = $this->db->select('asignaciones.id as asignacionid, asignaciones.nombre as nombre_asignacion, asignaciones.descripcion, asignaciones.created_at, personas.nombre as nombre_estudiante, personas.apellido, asignacion_usuario.id as asignacionUsuarioId')
				->from('asignacion_usuario')
				->where('secciones.seccion', $seccion)
				->where('asignacion_usuario.estado', $estado)
				->where('usuarios.correo', $correo)
				->where('asignaciones.deleted', 'false')
				->order_by('created_at', 'DESC')
				->join('asignaciones', 'asignaciones.id = asignacion_usuario.asignacion_id')
				->join('usuarios', 'usuarios.id = asignacion_usuario.usuario_id')
				->join('personas', 'personas.id = usuarios.persona_id')
				->join('secciones', 'secciones.id = asignaciones.seccion_id')
				->get()->result();

		if (count($asignacionUsuario) > 0) {

			// Retorna un array con las asignaciones sin repetir
			foreach ($asignacionUsuario as $value) {
				$r[] = $value->nombre_asignacion;
				$regs = array_unique($r);
			}

			// Agrupar las asignaciones iguales en una matriz (retorna la matriz $a con valores null)
			foreach ($regs as $key => $reg) {
				$a[] = array_map(function($v) use ($reg){
					if( preg_match("/^".$reg."$/", $v->nombre_asignacion) ){
						return 	[
							'asignacionid' => $v->asignacionid,
							'nombre_asignacion'   => $v->nombre_asignacion,
							'descripcion' => $v->descripcion,
							'created_at'  => $v->created_at,
							'estudiante'  => $v->nombre_estudiante.' '.$v->apellido,
							'asignacionUsuarioId' => $v->asignacionUsuarioId
						];
					}
				}, $asignacionUsuario);
			}
			// Eliminar de $a todos los valores nulos
			foreach ($a as $key => $values) {
				foreach ($values as $k => $value) {
					if( is_null($value) ){
						unset($a[$key][$k]);
					}
				}
				$a[$key] = array_values($a[$key]);
			}

			// sacar los estudiantes de las asignaciones, CUantos estudiantes hay por asignacion? - retorna todos los etudiantes relacionados a su asignacion
			$d = 0;
			foreach ($a as $key => $asigs) {
				foreach ($asigs as $k => $asig) {

					$asigs[$k]["estudiantes"][] = $asigs[$k]["estudiante"];

					if ( array_key_exists(($k + 1), $asigs)) {
						if ($asig["nombre_asignacion"] == $asigs[$k + 1]["nombre_asignacion"]) {
							$asigs[0]["estudiantes"][] = $asigs[$k + 1]["estudiante"];
						}
						unset($asigs[$k]['estudiante']);
					}
					else {
						unset($asigs[$k]['estudiante']);
					}
				}
				$var[] = $asigs;
			}

			// Eliminar las asignaciones que se repiten innecesariamente
			foreach ($var as $key => $val) {
				for ($i = 1; $i < count($val); $i++) {
					if ($val[$i]['nombre_asignacion'] == $val[$i - 1]['nombre_asignacion']) {
						unset($var[$key][$i]);
					}
				}
			}

			return $var;
		}

		return $asignacionUsuario;
	}

	public function traer_respuesta_asignacion($seccion, $correo = null)
	{
		if ($correo) {

			// Todas las respuesas de asignaciones fitradas por correo (vista del estudiante)
			return $this->db->select('respuesta_asignacion.respuesta, respuesta_asignacion.created_at as created_at_respuesta, asignaciones.nombre as nombre_asignacion, asignaciones.descripcion, asignaciones.created_at as created_at_asignacion, personas.nombre, personas.apellido, usuarios.avatar, respuesta_asignacion.archivo, respuesta_asignacion.icon, respuesta_asignacion.nota')
				->from('respuesta_asignacion')
				// ->where('respuesta_asignacion.asignacion_usuario_id', $asig_usu_id)
				->where('asignacion_usuario.estado', 'entregada')
				->where('secciones.seccion', $seccion)
				->where('usuarios.correo', $correo)
				->order_by('created_at_respuesta', 'DESC')
				// ->join('respuesta_asignacion', 'respuesta_asignacion.id = archivos_respuesta_asignacion.respuesta_asignacion_id')
				->join('asignacion_usuario', 'asignacion_usuario.id = respuesta_asignacion.asignacion_usuario_id')
				->join('asignaciones', 'asignaciones.id = asignacion_usuario.asignacion_id')
				->join('usuarios', 'usuarios.id = asignacion_usuario.usuario_id')
				->join('personas', 'personas.id = usuarios.persona_id')
				->join('secciones', 'secciones.id = asignaciones.seccion_id')
				->get()->result();
		}
		else {

			// Todas las respuesas de asignaciones por seccion (vista del profesor)
			return $this->db->select('respuesta_asignacion.id as id_respuesta_asignacion, respuesta_asignacion.respuesta, respuesta_asignacion.created_at as created_at_respuesta, asignaciones.nombre as nombre_asignacion, asignaciones.descripcion, asignaciones.created_at as created_at_asignacion, personas.nombre, personas.apellido, usuarios.avatar, respuesta_asignacion.archivo, respuesta_asignacion.icon, respuesta_asignacion.nota')
				->from('respuesta_asignacion')
				// ->where('respuesta_asignacion.asignacion_usuario_id', $asig_usu_id)
				->where('asignacion_usuario.estado', 'entregada')
				->where('secciones.seccion', $seccion)
				->order_by('created_at_respuesta', 'DESC')
				// ->join('respuesta_asignacion', 'respuesta_asignacion.id = archivos_respuesta_asignacion.respuesta_asignacion_id')
				->join('asignacion_usuario', 'asignacion_usuario.id = respuesta_asignacion.asignacion_usuario_id')
				->join('asignaciones', 'asignaciones.id = asignacion_usuario.asignacion_id')
				->join('usuarios', 'usuarios.id = asignacion_usuario.usuario_id')
				->join('personas', 'personas.id = usuarios.persona_id')
				->join('secciones', 'secciones.id = asignaciones.seccion_id')
				->get()->result();
		}
	}

	public function insertar($data, $estudiantes)
	{
		$this->db->insert('asignaciones', $data);

		$asignacionid = $this->db->select_max('id', 'lastid')->get('asignaciones')->result();

		foreach ($estudiantes as $estudiante) {
			$this->db->insert('asignacion_usuario', [
				'usuario_id'    => $estudiante,
				'asignacion_id' => $asignacionid[0]->lastid,
				'created_at'    => date('Y-m-d H:i:s')
			]);
		}
	}

	public function guardar_respuesta($data)
	{
		$this->db->insert('respuesta_asignacion', [
			'respuesta'  => $data['respuesta'],
			'archivo'    => $data['archivo'],
			'ext'        => $data['ext'],
			'icon'       => $data['icon'],
			'asignacion_usuario_id' => $data['asignacion_usuario_id'],
			'created_at' => date('Y-m-d H:i:s')
		]);

		$this->db->update('asignacion_usuario', ['estado' => 'entregada'], ['id' => $data['asignacion_usuario_id']]);
	}

	public function calificar($nota, $id_respuesta_asignacion)
	{
		$this->db->update('respuesta_asignacion', ['nota' => $nota], ['id' => $id_respuesta_asignacion]);
	}

	public function borrar($id)
	{
		$this->db->update('asignaciones', ['deleted' => 'true'], ['id' => $id]);
	}
}
