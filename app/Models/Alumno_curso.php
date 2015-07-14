<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
/**
 * @SWG\Model(id="Alumno_curso")
 */
class Alumno_curso extends Model {
	protected $table = 'alumno_curso';
	protected $primaryKey = 'id_alumno_curso';

/**
 * @SWG\Property(name="curso_ofertar",type="curso_ofertar", required=true, description="Información del Curso")
 */
	public function curso_ofertar()	{
		return $this->belongsTo('App\Models\Curso_ofertar','id_curso_ofertar');
	}	
}