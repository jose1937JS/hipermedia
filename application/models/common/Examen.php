<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Examen extends CI_Model {

	public function guardar_examen($puntuacion, $fecha, $fechaPretty, $duracion, $temaid)
	{
		$this->db->insert('examenes', [
			'valor_total' => $puntuacion,
			'fechaLimite' => $fecha,
			'fechaPretty' => $fechaPretty,
			'duracion'    => $duracion.':00',
			'tema_id'     => $temaid,
			'created_at'  => date('Y-m-d H:i:s')
		]);
	}

	public function guardar_preguntas_examen($preguntaInfo, $i)
	{
		$examenLastId = $this->db->select_max('id', 'lastid')->get('examenes')->result();

		if ($preguntaInfo["tipo_pregunta-$i"] == 'Seleccion_Simple') {

			$this->db->insert('pregunta_respuestas', [
				'tipo'       => str_replace('_', ' ', $preguntaInfo["tipo_pregunta-$i"]),
				'valor'      => $preguntaInfo["valor-$i"],
				'pregunta'   => $preguntaInfo["preg-$i"],
				'respuesta'  => $preguntaInfo["resp-$i"],
				// 'tema_id'    => $temaid,
				'examen_id'  => $examenLastId[0]->lastid,
				'created_at' => date('Y-m-d H:i:s')
			]);

			$preg_rep_id = $this->db->select_max('id', 'lastid')->get('pregunta_respuestas')->result();

			for ($j=1; $j <= 4; $j++) {
				$this->db->insert('respuestas_incorrectas', [
					'respuesta'    => $preguntaInfo["resp_inc_$j-$i"],
					'preg_resp_id' => $preg_rep_id[0]->lastid
				]);
			}
		}
		else if ($preguntaInfo["tipo_pregunta-$i"] == 'Verdadero_o_Falso') {

			$this->db->insert('pregunta_respuestas', [
				'tipo'       => str_replace('_', ' ', $preguntaInfo["tipo_pregunta-$i"]),
				'valor'      => $preguntaInfo["valor-$i"],
				'pregunta'   => $preguntaInfo["preg-$i"],
				'respuesta'  => $preguntaInfo["resp-$i"],
				// 'tema_id'    => $temaid,
				'examen_id'  => $examenLastId[0]->lastid,
				'created_at' => date('Y-m-d H:i:s')
			]);
		}
	}

	public function traer_examen($idexamen)
	{
		return $this->db->select('examenes.vistas, examenes.aprobados, examenes.reprobados, examenes.fechaPretty, examenes.fechaLimite, examenes.duracion, examenes.valor_total, pregunta_respuestas.id, pregunta_respuestas.tipo, pregunta_respuestas.valor, pregunta_respuestas.pregunta, pregunta_respuestas.respuesta, examenes.tema_id, pregunta_respuestas.examen_id as idexamen, temas.tema, temas.lapso')
					->from('examenes')
					->where('pregunta_respuestas.examen_id', $idexamen)
					->join('pregunta_respuestas', 'pregunta_respuestas.examen_id = examenes.id')
					->join('temas', 'temas.id = examenes.tema_id')
					->get()->result();
	}

	public function traer_examenes($seccion)
	{
		return $this->db->select('examenes.vistas, examenes.aprobados, examenes.reprobados, examenes.fechaPretty, examenes.fechaLimite, examenes.duracion, examenes.valor_total, temas.id as idtema, temas.tema, secciones.seccion, pregunta_respuestas.examen_id as idexamen')
					->from('examenes')
					->where('secciones.seccion', $seccion)
					->join('pregunta_respuestas', 'pregunta_respuestas.examen_id = examenes.id')
					->join('temas', 'temas.id = examenes.tema_id')
					->join('secciones', 'secciones.id = temas.seccion_id')
					->get()->result();
	}

	public function traer_temas($seccion)
	{
		return $this->db->select('temas.tema, temas.id, temas.lapso')
					->from('temas')
					->where('temas.deleted', 'false')
					->where('secciones.seccion', $seccion)
					->join('secciones', 'secciones.id = temas.seccion_id')
					->get()->result();
	}

	// ------------- LOGICA DE LOS EXAMENES POR PARTE DEL USUARIO ESTUDIANTE -----------------

	public function examen_tomado($data)
	{
		// jsondie($data);
		$this->db->insert('examenes_tomados', $data);
	}

	public function respuestas($idexamen)
	{
		return $this->db->get_where('pregunta_respuestas', ['examen_id' => $idexamen])->result();
	}

	public function tomar_examen($puntuacion, $idexamen, $idusuario)
	{
		$this->db->insert('examenes_tomados', [
			'puntuacion' => $puntuacion,
			'examen_id'  => $idexamen,
			'usuario_id' => $idusuario,
			'created_at' => date('Y-m-d H:i:s')
		]);
	}

	public function validar_examen($idexamen, $idusuario)
	{
		return $this->db->get_where('examenes_tomados', [
			'examen_id'  => $idexamen,
			'usuario_id' => $idusuario
		])->result();
	}

	// Sumarle 1 a el campo visto de la tabla examenes
	public function add_visto($idexamen)
	{
		$num    = $this->db->get_where('examenes', ['id' => $idexamen])->result();
		$vistas = ['vistas' => $num[0]->vistas + 1];

		$this->db->update('examenes', $vistas, ['id' => $idexamen]);
		jsondie($vistas);
	}

	// Sumarle 1 a el campo aprobado de la tabla examenes
	public function add_aprobado($idexamen)
	{
		$num       = $this->db->get_where('examenes', ['id' => $idexamen])->result();
		$aprobados = ['aprobados' => $num[0]->aprobados + 1];

		$this->db->update('examenes', $aprobados, ['id' => $idexamen]);
		jsondie($aprobados);
	}

	// Sumarle 1 a el campo reprobados de la tabla examenes
	public function add_reprobado($idexamen)
	{
		$num        = $this->db->get_where('examenes', ['id' => $idexamen])->result();
		$reprobados = ['reprobados' => $num[0]->reprobados + 1];

		$this->db->update('examenes', $reprobados, ['id' => $idexamen]);
		jsondie($reprobados);
	}
	// -------------------------------------------------------------------------------------------------------------

	public function reporte($seccion)
	{
		return $this->db->select('examenes_tomados.puntuacion, examenes.valor_total, examenes.vistas, examenes.aprobados, examenes.reprobados, personas.nombre, personas.apellido, personas.cedula, temas.tema, temas.lapso, secciones.seccion, examenes_tomados.id as idexamentomado, examenes.id as idexamen')
				->from('examenes_tomados')
				->join('examenes', 'examenes.id = examenes_tomados.examen_id')
				// ->join('examenes_tomados', 'examenes.id = examenes_tomados.examen_id')
				->join('usuarios', 'usuarios.id = examenes_tomados.usuario_id')
				->join('personas', 'personas.id = usuarios.persona_id')
				->join('temas', 'temas.id = examenes.tema_id')
				->join('secciones', 'secciones.id = temas.seccion_id')
				->where('secciones.seccion', $seccion)
				->get()->result();

	}
}