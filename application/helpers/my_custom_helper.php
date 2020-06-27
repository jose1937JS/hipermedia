<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('json') ){

	function json($data)
	{
		header('Content-Type: application/json');
		return json_encode($data);
	}
}

if ( ! function_exists('jsondie') ){

	function jsondie($data)
	{
		header('Content-Type: application/json');
		echo json_encode($data);
		die;
	}
}

if ( ! function_exists('respuestas')) {

	function respuestas($id)
	{
		$CI =& get_instance();

		$resps = [];
		$respuestasIncorrectas = $CI->db->select('pregunta_respuestas.respuesta as respocta, respuestas_incorrectas.respuesta as respinco')
					->from('respuestas_incorrectas')
					->where('preg_resp_id', $id)
					->join('pregunta_respuestas', 'pregunta_respuestas.id = respuestas_incorrectas.preg_resp_id')
					->get()->result();

		array_push($resps, $respuestasIncorrectas[0]->respocta);

		foreach ($respuestasIncorrectas as $value) {
			$resps[] = $value->respinco;
		}

		shuffle($resps);

		return $resps;
	}

	if ( ! function_exists('chat_notification')) {

		function chat_notification($userid)
		{
			$CI =& get_instance();

			return $CI->db->get_where('chat_counter', ['usuario_id' => $userid])->result();
		}
	}
}