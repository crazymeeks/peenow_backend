<?php namespace App\Supports;

/**
 * Serves as core for AreasController
 * @author Jeff Claud<jefferson.claud@nuworks.ph>
 * @created_at Aug. 20, 2016s
 */

use Illuminate\Http\Request;
use Exception;
use DB;
trait ProcessAndValidateAreas{

	protected $areas;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->responseRequestStatus();
	}

	/**
	 * Store new data
	 *
	 * @return json response
	 */
	public function store(Request $request){
		try{
			if($this->areas->create($request->all())){
				// return array('status' => 200,
				// 			 'message' => 'Success'
				// );
				return $this->responseRequestStatus();
			}
			// return array('status' => 500,
			// 			 'message' => 'Error'
			// 	);
			return $this->responseRequestStatus(false);
		}catch(Exception $e){

		}
	}

	
	public function create($lat, $lng){
		
	}
	/**
	 * Query to database
	 *
	 * This will get all the possible area
	 * within 1km
	 *
	 * @param string $latlng     The latitude and longitude delimited by comma (,)
	 * @return App\Area
	 */
	public function show($latlng){
		$latlng = explode(",", $latlng);
		try{
			// invalid parameter: possible 1111
			// expected 1111,11111
			if(count($latlng) == 1){
				return $this->responseRequestStatus(false, "Invalid parameter. Please separate latitude and longitude by comma");
			}
			$lat = $latlng[0];
			$lng = $latlng[1];
			return $this->areas->getLocationRadius($lat, $lng);
		}catch(Exception $e){
			return $this->responseRequestStatus(false);
		}
	}

}