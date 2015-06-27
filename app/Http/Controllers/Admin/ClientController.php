<?php namespace App\Http\Controllers\Admin;

use App\Client;

/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/client",
 *     basePath="http://api.intranet.com"
 * )
 */
class ClientController extends ApiGuardController {
/**
 *
 * @SWG\Api(
 *   path="client/register",
 *   description="Referente a los Usuarios",
 *   @SWG\Operation(
*	  method="POST", 
*		summary="Graba un cliente nuevo", 
*		notes="Graba un cliente nuevo en el sistema de la Intranet",
*		type="Client", 
*		nickname="clientRegister",
*		@SWG\Parameter(
	*		name="name", 
	*		description="nombre del usuario", 
	*		paramType="form", 
	*		required=true, 
	*		allowMultiple=false, 
	*		type="string"
* 		),
	*	@SWG\Parameter(
	*		name="email", 
	*		description="Correo del usuario", 
	*		paramType="form", 
	*		required=true, 
	*		allowMultiple=false, 
	*		type="string"
* 		),
	*	@SWG\Parameter(
	*		name="password", 
	*		description="Contraseña del usuario", 
	*		paramType="form", 
	*		required=true, 
	*		allowMultiple=false, 
	*		type="string"
* 		)
*	)
*)
 */
	public function save(UserRequest $request) {
        $client = new Client ();
        $client -> name = $request->name;
        $client -> email = $request->email;
        $client -> password = bcrypt($request->password);
        $client -> save();
    }


}