<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
/**
 * @SWG\Model(id="Instructor")
 */
class Instructor extends Model {


	protected $table = 'instructores';
    protected $primaryKey = 'id_instructor';

	protected $fillable = ['nombre', 'direccion', 'email','email2','celular','telefono','RFC','CURP','cursos','activo','id_cede'];

	protected $hidden = [];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function ofertados(){
		return $this->hasMany('App\Models\Curso_ofertar');
	}
}
