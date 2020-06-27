<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ExamenController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common/Examen');
	}

	public function pedazos($array, $regex)
	{
		$keys = array_keys($array);
		$filteredKeys  = preg_grep($regex, $keys);

		$filteredArray = array_filter($array, function($v, $k) use ($filteredKeys) {
			if (in_array($k, $filteredKeys)) {
				return $v;
			}
		}, ARRAY_FILTER_USE_BOTH);

		return $filteredArray;
	}

	public function total_de_pedazos($array)
	{
		$keys = array_keys($array);
		$filteredKeys = preg_grep("/^tipo_pregunta/", $keys);

		return count($filteredKeys);
	}

	public function registrar_preguntas()
	{
		$formData    = $this->input->post();
		$temaid  	 = $formData['tema'];
		$fechaPretty = $formData['fecha'];
		$fecha       = $formData['fecha_submit'];
		$duracion    = $formData['duracion'];
		$puntuacion  = $formData['puntuacion'];

		$totalPedazos = $this->total_de_pedazos($formData);

		$this->Examen->guardar_examen($puntuacion, $fecha, $fechaPretty, $duracion, $temaid);

		for ($i = 1; $i <= $totalPedazos; $i++) {
			$preguntaInfo = $this->pedazos($formData, "/[".$i."]+$/");
			$this->Examen->guardar_preguntas_examen($preguntaInfo, $i); // $temaid
		}

		redirect('/docente/evaluaciones');
	}

	public function examen_en_tema()
	{
		$temaid = $this->input->post('temaid');
		$bool   = $this->Examen->traer_examen($temaid);

		if ($bool) {
			echo json($bool);
		}
	}


	//METODOS DE PRUEBA, SALIDAS EN FORMATO JSON

	public function traer_examen($temaid)
	{
		$examen = $this->Examen->traer_examen($temaid);

		echo json($examen);
	}

	// funcion registrada en test routes
	public function traer_examenes()
	{
		$seccion   = $this->session->userdata()['seccion'];
		$preguntas = $this->Examen->traer_examenes($seccion);

		$idtema = [];

		foreach ($preguntas as $pregunta) {
			$idtema[] = $pregunta->idtema;
		}

		$sinDobleTema = array_unique($idtema);
		$temas_id     = array_values($sinDobleTema); // contiene los tema de las preguntas sin repeticion y con los indices restaurados

		$arr  = [];

		foreach ($preguntas as $key => $value) {
			for ($i = 0; $i < count($temas_id); $i++) {
				if ($value->idtema == $temas_id[$i]) {
					$arr["examen-".$i][] = $value;
				}
			}
		}

		echo json($arr);
	}

	public function sendtest()
	{
		$postdata   = $this->input->post();
		$idusuario  = $this->input->post('idusuario');
		$examenid   = $this->input->post('idexamen');
		$puntuacion = 0;

		$idk = ['examen' => []];

		$respuestas = $this->Examen->respuestas($examenid);

		$keys 		  = array_keys($postdata);
		$filteredKeys = preg_grep("/pregunta/", $keys);
		$longitud 	  = count($filteredKeys);

		for ($i=1; $i <= $longitud; $i++) {
			$pedazos[] = $this->pedazos($postdata, "/[".$i."]+$/");

			// Si la respuesta es correcta se le suma su valor y se mantiene en la siguiente iteracion
			if ( isset($pedazos[$i - 1]["respuesta-$i"]) ) {
				if ($pedazos[$i - 1]["respuesta-$i"] == $respuestas[$i - 1]->respuesta) {
					$puntuacion += $respuestas[$i - 1]->valor;
				}
			}
		}

		// registar participacion del estudiante en la prueba en cuestin
		$this->Examen->tomar_examen($puntuacion, $examenid, $idusuario);

		foreach ($respuestas as $value) {
			array_push($idk['examen'], [
				'pregunta'  => $value->pregunta,
				'respuesta' => $value->respuesta
			]);
		}

		$idk['puntuacion'] = $puntuacion;

		jsondie($idk);
	}


	public function add_visto()
	{
		$idexamen = $this->input->post('idexamen');
		$this->Examen->add_visto($idexamen);
	}

	public function add_aprobado()
	{
		$idexamen = $this->input->post('idexamen');
		$this->Examen->add_aprobado($idexamen);
	}

	public function add_reprobado()
	{
		$idexamen = $this->input->post('idexamen');
		$this->Examen->add_reprobado($idexamen);
	}
}