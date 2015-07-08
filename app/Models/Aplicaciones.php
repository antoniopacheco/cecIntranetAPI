<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
/**
 * @SWG\Model(id="Aplicaciones")
 */
class Aplicaciones extends Model {
	protected $table = 'aplicaciones';
/**
 * @SWG\Property(
 *      name="id_aplicacion",
 *		type="integer",
 *      description="Identificador de la Aplicacion"),
 *		required=true
 */
   protected $primaryKey = 'id_aplicacion';
/**
 * @SWG\Property(
 *      name="Nombre",
 *		type="string",
 *      description="Nombre completo de la aplicación"),
 *		 required=true
 */
}