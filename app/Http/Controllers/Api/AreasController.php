<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contracts\AreasInterface as AreasContract;
use App\Supports\ProcessAndValidateAreas;

use phpFastCache\CacheManager;

class AreasController extends Controller {
	use ProcessAndValidateAreas;


	/**
	 * Creates a new application instance
	 * @param App\Contracts\AreasInterface
	 * @return void
	 */
	public function __construct(AreasContract $areas, CacheManager $cm){

		CacheManager::setDefaultConfig(array(
		    "path" => '/tmp', // or in windows "C:/tmp/"
		));
		$this->cache_instance = $cm;//CacheManager::getInstance('files');

		$this->areas = $areas;
	}

}
