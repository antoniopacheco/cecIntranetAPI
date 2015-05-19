<?php namespace App\Http\Controllers\Admin;

use App\User;

/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/users",
 *     basePath="http://api.intranet.com"
 * )
 */
class UserController extends ApiGuardController {
/**
 *
 * @SWG\Api(
 *   path="users/register",
 *   description="Referente a los Usuarios",
 *   @SWG\Operation(
*	  method="POST", 
*		summary="Graba usuario nuevo", 
*		notes="Graba un usuario nuevo en el sistema de la Intranet",
*		type="User", 
*		nickname="userRegister",
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
        $user = new User ();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = bcrypt($request->password);
        $user -> save();
    }


}