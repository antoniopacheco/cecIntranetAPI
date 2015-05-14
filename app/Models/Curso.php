<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Curso extends Model {
	protected $table = 'cursos';
    protected $primaryKey = 'id_curso';
   
	public function ofertados(){
		return $this->hasMany('App\Models\Curso_ofertar');
	}
}