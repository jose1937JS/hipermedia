<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'common/LoginController';
$route['404_override'] 		   = '';
$route['translate_uri_dashes'] = FALSE;

// Auth Routes
$route['login']['post'] 		   	   = 'common/LoginController/login';
$route['register']['post']  	   	   = 'common/LoginController/register';
$route['verificar_cedula']['post'] 	   = 'common/LoginController/verificar_cedula';
$route['verificar_correo']['post'] 	   = 'common/LoginController/verificar_correo';
$route['logout']['post']  		   	   = 'common/LoginController/logout';
$route['recuperar_contrasena']['post'] = 'common/LoginController/recuperar_contrasena';
$route['cambiar_clave']['post'] 	   = 'common/LoginController/cambiar_clave';
$route['recuperar/(:any)']['get'] 	   = 'common/LoginController/restoring_password/$1';
$route['getsession']['get']		   	   = 'common/LoginController/getsession';

// Estudiantes Routes
$route['estudiante']['get'] 		          = 'common/StudentController/index';
$route['estudiante/contenidos']['get']        = 'common/StudentController/contenidos';
$route['estudiante/evaluaciones']['get'] 	  = 'common/StudentController/evaluaciones';
$route['estudiante/recursos']['get'] 	 	  = 'common/StudentController/recursos';
$route['estudiante/herramientas']['get'] 	  = 'common/StudentController/herramientas';
$route['estudiante/evaluacion/(:num)']['get'] = 'common/StudentController/evaluacion/$1';
$route['estudiante/simuladores']['get']       = 'common/StudentController/simuladores';
$route['estudiante/asignaciones']['get']      = 'common/StudentController/asignaciones';

// routes for both
// $route['contenido/([a-z0-9_]+)']['get'] = 'common/ContenidoController/contenido/$1';
$route['contenido/(:any)']['get']	    = 'common/ContenidoController/mostrar_contenido/$1';
$route['traer_contenido']['post'] 	    = 'common/ContenidoController/traer_contenido';
$route['traer_temas']['post'] 	        = 'common/ContenidoController/traer_temas';
$route['eliminarContenido']['post']    	= 'common/ContenidoController/eliminarContenido';
$route['perfil']['get'] 	            = 'common/LoginController/perfil';
$route['updateProfile']['post'] 	    = 'common/LoginController/updateProfile';
$route['deleteProfile']['post'] 	    = 'common/LoginController/deleteProfile';
$route['uploadResource']['post'] 	    = 'common/ResourceController/uploadResource';
$route['deleteResource/(:num)']['post'] = 'common/ResourceController/deleteResource/$1';
$route['cambiarAvatar']['post'] 		= 'common/LoginController/cambiarAvatar';
$route['validar_tema']['post']          = 'common/ExamenController/examen_en_tema';
$route['sendtest']['post']         	 	= 'common/ExamenController/sendtest';
$route['add_visto']['post']         	= 'common/ExamenController/add_visto';
$route['add_aprobado']['post']         	= 'common/ExamenController/add_aprobado';
$route['add_reprobado']['post']        	= 'common/ExamenController/add_reprobado';
$route['registrar_herramienta']['post']	= 'common/TeacherController/registrar_herramienta';
$route['eliminar_herramienta']['post']	= 'common/TeacherController/eliminar_herramienta';
$route['registrar_simulador']['post']	= 'common/TeacherController/registrar_simulador';
$route['eliminar_simulador']['post']	= 'common/TeacherController/eliminar_simulador';
$route['anadir_asignacion']['post']		= 'common/TeacherController/anadir_asignacion';
$route['borrar_asignacion']['post']		= 'common/TeacherController/borrar_asignacion';
$route['responder_asignacion']['post']  = 'common/StudentController/responder_asignacion';
$route['calificar_asignacion']['post']  = 'common/TeacherController/calificar_asignacion';
$route['reporte']['get']                = 'common/TeacherController/reporte_examen';
$route['contenidoInicial']['post']      = 'common/TeacherController/contenidoInicial';
$route['delContenidoInicial']['post']   = 'common/TeacherController/borrar_contenido_inicial';
$route['chat']['get']                   = 'common/ChatController/index';
$route['mensajear']['post']             = 'common/ChatController/registrar_mensaje';
$route['traer_mensajes/(:num)/(:num)']['get']  = 'common/ChatController/traer_mensajes/$1/$2';
$route['delTemaContenido']['post']      = 'common/ContenidoController/delTemaContenido';

// Profesor Routes
$route['docente']['get']  	  		        = 'common/TeacherController/index';
$route['docente/evaluaciones']['get']       = 'common/TeacherController/evaluaciones';
$route['docente/evaluacion/(:num)']['get']  = 'common/TeacherController/evaluacion/$1';
$route['docente/estudiantes']['get']        = 'common/TeacherController/estudiantes';
$route['docente/contenidos']['get']     	= 'common/TeacherController/contenidos';
$route['docente/recursos']['get']           = 'common/TeacherController/recursos';
$route['docente/herramientas']['get']       = 'common/TeacherController/herramientas';
$route['traer_estudiantes']['get']          = 'common/TeacherController/traer_estudiantes';
$route['anadir_estudiante']['post']         = 'common/TeacherController/anadir_estudiante';
$route['addContent']['post']    	        = 'common/ContenidoController/agregar_contenido';
$route['questionForm']['post']    	        = 'common/ExamenController/registrar_preguntas';
$route['docente/simuladores']['get']        = 'common/TeacherController/simuladores';
$route['docente/asignaciones']['get']       = 'common/TeacherController/asignaciones';
$route['docente/visitas']['get']            = 'common/TeacherController/visitas';

// migla's routes
if ( ! $this->config->item('owner') ){
	$route['restaurar_clave']['get']   			   = 'm/LoginController/recuperar_clave';
	$route['docente/evaluaciones/crear']['get']    = 'm/TeacherControllerM/crear_evaluaciones';
	$route['docente/contenido/crear']['get']  	   = 'm/TeacherControllerM/crear_contenido';
	$route['docente/estudiantes/registrar']['get'] = 'm/TeacherControllerM/registrar_estudiante';
	$route['registrar']['get'] 					   = 'm/LoginController/registrar';
}

// TEst ROutes
$route['evaluacion/(:num)']['get'] = 'common/ExamenController/traer_examen/$1';
$route['evaluaciones']['get'] 	   = 'common/ExamenController/traer_examenes';
$route['test']['get'] = 'common/LoginController';


$route['backup']['get'] = 'common/TeacherController/dbbackup';