<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Curso_ofertar;
use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
class CursosController  extends ApiGuardController {

	protected $apiMethods = [
		'get_proximos' => [
            'level' => 5
        ],
	];

	public function index(){

	}

	public function get_proximos(){
		$proximos_cursos = Curso_ofertar::with(array('Curso'))->where('id_status_cursos','=',1)->get();
		return response()->json([
			'msg'=>'success',
			'cantidad_cursos' => $proximos_cursos->count(),
			'proximos_cursos' => $proximos_cursos->toArray()
			],200);
	}

	public function show_proximo($id){
		$curso = Curso_ofertar::with(array('Curso'))->find($id);
		return response()->json([
			'msg' => 'success',
			'cantidad_cursos' => $curso->count(),
			'curso' => $curso
			],200);
	}
}
