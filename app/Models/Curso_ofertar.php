<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
/**
 * @SWG\Model(id="Curso_Ofertado")
 */
class Curso_ofertar extends Model {
	protected $table = 'curso_ofertar';
/**
 * @SWG\Property(name="id_curso_ofertar",type="integer", required=true, description ="Identificador del Grupo")
 */	
    protected $primaryKey = 'id_curso_ofertar';

/**
 * @SWG\Property(name="curso",type="Curso", required=true, description="Información del Curso")
 */
	public function curso()	{
		return $this->belongsTo('App\Models\Curso','id_curso');
	}
/**
 * @SWG\Property(name="instructor",type="Instructor", required=true, description="Instructor del Grupo")
 */
	public function instructor(){
		return $this->belongsTo('App\Models\Instructor','instructores_id_instructor');
	}
/**
 * @SWG\Property(name="capacidad_alumnos",type="integer", description="Capacidad máxima del Grupo")
 */	
}