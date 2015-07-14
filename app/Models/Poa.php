<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
/**
 * @SWG\Model(id="Poa")
 */
class Poa extends Model {
	protected $table = 'poa';
	/**
	 * @SWG\Property(
	 *      name="id",
	 *		type="integer",
	 *      description="Identificador del poa"),
	 *		required=true
	 */
   protected $primaryKey = 'id';

/**
 * @SWG\Property(name="tipo_poa",type="tipo_poa",  description="Tipo POA")
 */
	public function tipo_poa()	{
		return $this->belongsTo('App\Models\Tipo_poa','id_tipo_poa');
	}   	
}