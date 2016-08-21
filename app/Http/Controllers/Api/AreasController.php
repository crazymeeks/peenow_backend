<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contracts\AreasInterface as AreasContract;
use App\Supports\ProcessAndValidateAreas;



class AreasController extends Controller {
	use ProcessAndValidateAreas;


	/**
	 * Creates a new application instance
	 * @param App\Contracts\AreasInterface
	 * @return void
	 */
	public function __construct(AreasContract $areas){
		$this->areas = $areas;
	}

}
