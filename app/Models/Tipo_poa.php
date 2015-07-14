<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
/**
 * @SWG\Model(id="Tipo_poa")
 */
class Tipo_poa extends Model {
	protected $table = 'tipos_poa';
/**
 * @SWG\Property(
 *      name="id",
 *		type="integer",
 *      description="Identificador del tipo POA"),
 *		required=true
 */
   protected $primaryKey = 'id';	
}
