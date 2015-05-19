<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
/**
 * @SWG\Model(id="Curso")
 */
class Curso extends Model {
	protected $table = 'cursos';
/**
 * @SWG\Property(
 *      name="id_curso",
 *		type="integer",
 *      description="Identificador del curso"),
 *		required=true
 */
   protected $primaryKey = 'id_curso';
/**
 * @SWG\Property(
 *      name="nombre_curso",
 *		type="string",
 *      description="Nombre completo del curso"),
 *		 required=true
 */
	public function ofertados(){
		return $this->hasMany('App\Models\Curso_ofertar');
	}
}