<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso_ofertar;
use App\Models\Poa;
use App\Models\Alumno_curso;
use App\Models\View_resumen_anual_mensual;

use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;
use Input;
/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/poa",
 *     basePath="http://api.intranet.com"
 * )
 */
class PoaController  extends ApiGuardController {

	public function __construct() {
    	parent::__construct();
	}	

	/**
	 *
	 * @SWG\Api(
	 *   path="/poa/getResume",
	 *   description="Resumen Anual del POA",
	 *   @SWG\Operation(
	*	  method="GET", 
	*		summary="Obtiene información del POA Por trimestre y general", 
	*		notes="Regresa la información del POA",
	*		type="poa", 
	*		nickname="getPoaResume"
	* 	)
	* )
	*/

	public function getResume(){
		$year = date('Y');
		$ingresos = View_resumen_anual_mensual::get()->toarray();
		$poa = Poa::
		with(array('tipo_poa'))
		->where('ano',2015)
		->get();
		$poaArray = array();
		foreach ($poa as $singlepoa) {
			//echo $singlepoa;
			 $poaArray[$singlepoa->ano][$singlepoa->trimestre][$singlepoa->tipo_poa->tipo]['programado'] = $singlepoa->cantidad;

			 if(isset( $poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['programado']))
			 	$poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['programado'] += $singlepoa->cantidad;
			 else
			 	$poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['programado'] = $singlepoa->cantidad;

			switch ($singlepoa->trimestre) {
				case '1':
					//trimestre 1 2015: 2014-13

					$fechaMayorQue = (($singlepoa->ano)-1).'-'.'13';
					//trimestre 1 2015: 2015-04
					$fechaMenorQue = $singlepoa->ano.'-'.'04';
				break;
				case '2':
					//trimestre 2 2015: 2015-03-32
					$fechaMayorQue = $singlepoa->ano.'-'.'03-32';
					//trimestre 2 2015: 2015-07
					$fechaMenorQue = $singlepoa->ano.'-'.'07';				
				break;
				case '3':
					//trimestre 3 2015: 2015-06-32
					$fechaMayorQue = $singlepoa->ano.'-'.'06-32';
					//trimestre 3 2015: 2015-10
					$fechaMenorQue = $singlepoa->ano.'-'.'10';					
				break;
				case '4':
					//trimestre 4 2015: 2015-09-32
					$fechaMayorQue = $singlepoa->ano.'-'.'09-32';
					//trimestre 4 2015: 2016-01
					$fechaMenorQue = ($singlepoa->ano+1).'-'.'01';					
				break;
			}
			switch($singlepoa->tipo_poa->tipo){
				case 'cursos':
					$absoluto = Curso_ofertar::
					where('fechainicial', '<', $fechaMenorQue)
					->where('fechainicial', '>', $fechaMayorQue)
					->where('id_status_cursos', '<', 5)
					->count();
				break;
				case 'ingresos':
					
				break;
				case 'usuarios':
					$absoluto = Alumno_curso::with('curso_ofertar')
					->leftJoin('curso_ofertar','curso_ofertar.id_curso_ofertar','=','alumno_curso.id_curso_ofertar')
					->where('id_status','=',2)
					->where('fechainicial', '<', $fechaMenorQue)
					->where('fechainicial', '>', $fechaMayorQue)
					->count();
				break;
			}
			$poaArray[$singlepoa->ano][$singlepoa->trimestre][$singlepoa->tipo_poa->tipo]['ofertado'] = $absoluto;
			$poaArray[$singlepoa->ano][$singlepoa->trimestre][$singlepoa->tipo_poa->tipo]['porcentaje'] = (int)($absoluto*100/$singlepoa->cantidad);

			 if(isset( $poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['ofertado']))
			 	$poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['ofertado'] += $absoluto;
			 else
			 	$poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['ofertado'] = $absoluto;

$poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['porcentaje'] = (int)($poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['ofertado']*100/$poaArray[$singlepoa->ano]['total'][$singlepoa->tipo_poa->tipo]['programado']);			 			
			
		}
		$ingresoTotal=0;
		foreach ($ingresos as $ingreso) {
			if($ingreso['number'] < 5)
				$index = 1;
			elseif($ingreso['number'] >=4 && $ingreso['number'] < 7)
				$index = 2;
			elseif($ingreso['number'] >=7 && $ingreso['number'] < 10)
				$index = 3;
			else
				$index = 4;

			if(isset($poaArray[$year][$index]['ingresos']['ofertado']))
				$poaArray[$year][$index]['ingresos']['ofertado'] += $ingreso['actual'];
			else
				$poaArray[$year][$index]['ingresos']['ofertado'] = $ingreso['actual'];
			
			$poaArray[$year][$index]['ingresos']['porcentaje'] = (int) ($poaArray[$year][$index]['ingresos']['ofertado']*100 / $poaArray[$year][$index]['ingresos']['programado']);
			$ingresoTotal+= $ingreso['actual'];
		}
			$poaArray[$year]['total']['ingresos']['ofertado'] = $ingresoTotal;
			$poaArray[$year]['total']['ingresos']['porcentaje'] = (int)($poaArray[$year]['total']['ingresos']['ofertado']*100/$poaArray[$year]['total']['ingresos']['programado']);

		return response()->json([
			'msg'=>'success',
			'poa' => $poaArray			
		],200);
	}
}