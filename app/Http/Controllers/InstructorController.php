<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;

/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/instructores",
 *     basePath="http://api.intranet.com"
 * )
 */
class InstructorController  extends ApiGuardController {

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


	public function store()
	{
		//
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
