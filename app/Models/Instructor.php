<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Swagger\Annotations as SWG;

/**
 * @SWG\Model(id="Instructor")
 */
class Instructor extends Model {


	protected $table = 'instructores';
    protected $primaryKey = 'id_instructor';
/**
 * @SWG\Property(
 *      name="nombre",
 *		type="string",
 *      description="Nombre completo del instructor"),
 *		required=true
 */
/**
 * @SWG\Property(
 *      name="direccion",
 *		type="string",
 *      description="Dirección completa del instructor"),
 *		required=false
 */
/**
 * @SWG\Property(
 *      name="email",
 *		type="string",
 *      description="Correo Electrónico del instructor"),
 *		required=false
 */
/**
 * @SWG\Property(
 *      name="email2",
 *		type="string",
 *      description="Correo Electrónico alterno del instructor"),
 *		required=false
 */
/**
 * @SWG\Property(
 *      name="celular",
 *		type="string",
 *      description="Número telefonico móvil del instructor"),
 *		required=false
 */
/**
 * @SWG\Property(
 *      name="RFC",
 *		type="string",
 *      description="RFC del instructor"),
 *		required=true
 */
/**
 * @SWG\Property(
 *      name="CURP",
 *		type="string",
 *      description="CURP del instructor"),
 *		required=false
 */
/**
 * @SWG\Property(
 *      name="activo",
 *		type="string",
 *      description="Indica si el Instructor se encuentra disponible laboralmente"),
 *		required=true
 */
/**
 * @SWG\Property(
 *      name="id_cede",
 *		type="integer",
 *      description="ID de la cede que lo dio de alta"),
 *		required=true
 */
	protected $fillable = ['nombre', 'direccion', 'email','email2','celular','telefono','RFC','CURP','cursos','activo','id_cede'];

	protected $hidden = [];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function ofertados(){
		return $this->hasMany('App\Models\Curso_ofertar');
	}
}
