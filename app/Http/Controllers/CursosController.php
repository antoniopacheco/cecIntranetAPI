<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Curso_ofertar;
use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;
use Input;
/**
 * @SWG\Info(
 *   title="CEC Tijuana Intranet",
 *   description="API De la intranet del CEC Tijuana. con información de los cursos y alumnos",
 *   contact="antonio_pacheco@utlook.com",
 *   license="Apache 2.0",
 *   licenseUrl="http://www.apache.org/licenses/LICENSE-2.0.html"
 * )
 */
/**
* @SWG\Authorization(
 *   type="apiKey",
*	passAs = "header",
*	keyname = "X-Authorization"
* )
*/
/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/cursos",
 *     basePath="http://api.intranet.com"
 * )
 */
class CursosController  extends ApiGuardController {

	protected $apiMethods = [
		'get_proximos' => [
            'level' => 5
        ],
        'get_corriendo' =>[
        	'level' =>7
        ]
	];
/**
 *
 * @SWG\Api(
 *   path="/cursos",
 *   description="Referente a los cursos",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Obtiene información de los CursosController", 
*		notes="El parametro extra filtrará los cursos por el areaa",
*		type="Curso", 
*		nickname="showCursos",
*		@SWG\Parameter(
*		name="tipo", 
*		description="ID del tipo de curso", 
*		paramType="query", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*
* 	)
* )
*/
protected static $restful = true;

	public function index(){
		$cursos = Curso::orderBy('nombre_curso','asc');
		// if($area)
		// 	$cursos = $cursos->where('id_tip')
		if(Input::get('tipo'))
			$cursos = $cursos->where('id_tipos_cursos','=',Input::get('tipo'));
		$cursos = $cursos->get();
		return response()->json([
			'msg'=>'success',
			'cantidad_cursos' => $cursos->count(),
			'cursos' => $cursos->toArray()
			],200);
	}
/**
 *
 * @SWG\Api(
 *   path="/cursos/proximos",
 *   description="Referente a los cursos",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Obtiene información de grupos programados", 
*		notes="Regresa la información de los cursos programado (grupo)",
*		type="Curso_Ofertado", 
*		nickname="getProximos"
* 	)
*)
 */
	public function get_proximos(){

		$proximos_cursos = Curso_ofertar::with(array('Curso'))->where('id_status_cursos','=',1)->get();
		return response()->json([
			'msg'=>'success',
			'cantidad_cursos' => $proximos_cursos->count(),
			'proximos_cursos' => $proximos_cursos->toArray()
			],200);
	}

/**
 *
 * @SWG\Api(
 *   path="/cursos/proximos/{id_curso_ofertar}",
 *   description="Referente a los cursos",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Busca Grupo por ID", 
*		notes="Regresa la información de un curso programado (grupo) a partir de su ID",
*		type="Curso_Ofertado", 
*		nickname="getCursoById",
*
*		@SWG\Parameter(
*		name="id_curso_ofertar", 
*		description="ID del curso ofertar", 
*		paramType="path", 
*		required=true, 
*		allowMultiple=false, 
*		type="integer"
*  		),
*		@SWG\ResponseMessage(code=401, message="Unauthorized")
* 	)
*)
 */
	public function show_proximo($id){

		$curso = Curso_ofertar::with(array('Curso','Instructor'))->find($id);
		return response()->json([
			'msg' => 'success',
			'cantidad_cursos' => $curso->count(),
			'curso' => $curso
			],200);
	}
/**
 *
 * @SWG\Api(
 *   path="/cursos/corriendo",
 *   description="Referente a los cursos",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Regresa Cursos Corriendo Actualmente", 
*		notes="Regresa los Cursos Corriendo",
*		type="Curso_Ofertado", 
*		nickname="getCursoById",
*		@SWG\ResponseMessage(code=401, message="Unauthorized")
* 	)
*)
 */
	public function get_corriendo(){
		$cursos = Curso_ofertar::with(array('Curso','Instructor'))->where('id_status_cursos','=',2)->get();
		return response()->json([
		'msg'=>'success',
		'cantidad_cursos' => $cursos->count(),
		'cursos' => $cursos->toArray()
		],200);
	}
}
