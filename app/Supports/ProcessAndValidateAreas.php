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
			// Get data using id(primary key)
			if(count($latlng) == 1){
				//if(!empty($this->areas->find($latlng[0]))){
					return $this->areas->find($latlng[0]);
				//}
				return $this->responseRequestStatus(true, "No record");
			}
			$lat = $latlng[0];
			$lng = $latlng[1];
			return $this->areas->getLocationRadius($lat, $lng);
		}catch(Exception $e){
			return $this->responseRequestStatus(false);
		}
	}

}