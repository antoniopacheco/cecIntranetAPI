<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Curso_ofertar extends Model {
	protected $table = 'curso_ofertar';
    protected $primaryKey = 'id_curso_ofertar';

	public function curso()	{
		return $this->belongsTo('App\Models\Curso','id_curso');
	}
}