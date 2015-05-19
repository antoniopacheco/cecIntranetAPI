<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;
use Input;
use Illuminate\Http\Request;
use Validator;
/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/instructores",
 *     basePath="http://api.intranet.com"
 * )
 */
class InstructorController  extends ApiGuardController {

public function __construct() {
    parent::__construct();
}

protected $rules = ['nombre' => 'required|min:5',
						'RFC' => 'required|min:10'];
/**
 *
 * @SWG\Api(
 *   path="/instructores",
 *   description="Referente a los Instructores",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Obtiene información de los instructores", 
*		notes="Regresa la información de los Instructores",
*		type="Instructor", 
*		nickname="getInstructores"
*
* 	)
* )
*/

	public function index()
	{
		$instructores = Instructor::orderBy('nombre','asc')->get();
		return response()->json([
			'msg'=>'success',
			'cantidad_instructores' => $instructores->count(),
			'instructores' => $instructores->toArray()
			],200);
	}

/**
 *
 * @SWG\Api(
 *   path="/instructores",
 *   description="Referente a los Instructores",
 *   @SWG\Operation(
*	  method="POST", 
*		summary="Graba un Instructor", 
*		notes="Regresa el ID",
*		type="Instructor", 
*		nickname="storeInstructor",
*		@SWG\Parameter(
*		name="nombre", 
*		description="nombre completo del instructor", 
*		paramType="form", 
*		required=true, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="direccion", 
*		description="Direccion completa del instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="email", 
*		description="Correo Electrónico  del instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="email2", 
*		description="Correo Electrónico Alternativo del instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="celular", 
*		description="Numero telefonico Móvil del Instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="telefono", 
*		description="Numero telefonico Fijo del Instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="RFC", 
*		description="RFC del Instructor", 
*		paramType="form", 
*		required=true, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="CURP", 
*		description="CURP del Instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="cursos", 
*		description="cursos que da el Instructor", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="activo", 
*		description="Indica si el Instructor se encuentra disponible laboralmente", 
*		paramType="form", 
*		required=false, 
*		allowMultiple=false, 
*		type="string"
*  		),
*		@SWG\Parameter(
*		name="id_cede", 
*		description="Cede del instructor", 
*		paramType="form", 
*		required=true, 
*		allowMultiple=false, 
*		type="integer"
*  		)
* 	)
* )
*/

	public function store(Request $request)
	{

		$validator = Validator::make(Input::all(),$this->rules);
		$input = Input::all();
		$instructor = Instructor::create($input);
		return response()->json([
			'input' => $input,
			'validator' => $validator,
			'id_insstructor' => $instructor->id_instructor
		],200);
	}
/**
 *
 * @SWG\Api(
 *   path="/instructores/{id_instructor}",
 *   description="Referente a los Instructores",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Obtiene información de un Instructor Por ID", 
*		notes="Regresa la información del Instructor",
*		type="Instructor", 
*		nickname="getInstructorByID",
*		@SWG\Parameter(
*		name="id_instructor", 
*		description="ID del instructor", 
*		paramType="path", 
*		required=true, 
*		allowMultiple=false, 
*		type="integer"
*  		),
*		@SWG\ResponseMessage(code=401, message="Unauthorized")
* 	),
*
*		
* )
*/
	public function show($id)
	{
		$instructor = Instructor::find($id);
		return response()->json([
			'msg' => 'success',
			'instructor' => $instructor
			],200);
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
