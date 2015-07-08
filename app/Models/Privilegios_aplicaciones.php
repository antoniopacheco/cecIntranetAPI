<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aplicaciones;

/**
 * @SWG\Model(id="Privilegios_aplicaciones")
 */
class Privilegios_aplicaciones extends Model {
	protected $table = 'privilegio_aplicaciones';
/**
 * @SWG\Property(
 *      name="id_privilegio_aplicaciones",
 *		type="integer",
 *      description="Identificador de la Aplicacion"),
 *		required=true
 */
   protected $primaryKey = 'id_privilegio_aplicaciones';

   	public function aplicacion(){
		return $this->belongsTo('App\Models\Aplicaciones','aplicaciones_id_aplicacion');
	}
}