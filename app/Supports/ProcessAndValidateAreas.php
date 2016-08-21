<?php namespace App\Supports;

/**
 * Serves as core for AreasController
 * @author Jeff Claud<jefferson.claud@nuworks.ph>
 * @created_at Aug. 20, 2016s
 */

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Areas;
trait ProcessAndValidateAreas{

	protected $areas;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$areas = DB::table('areas')
                     ->select(DB::raw('id, description, image_thumb, lat, lng'
    								))
                     ->get();
        return $areas;
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
				if(count((array)$this->areas->find($latlng[0])) != 0){
					return $this->areas->find($latlng[0]);
				}
				return $this->responseRequestStatus(true, "No record");
			}
			$lat = $latlng[0];
			$lng = $latlng[1];
			//m = km x 1,000
			$results = $this->areas->getLocationRadius($lat, $lng, true);
			if(count((array)$results) != 0){
				return $results;
				$res = array();
				foreach($results as $result){
					$res['id'][] = $result->id;
					$res['image_thumb'][] = $result->image_thumb;
					$res['lat'][] = $result->lat;
					$res['lng'][] = $result->lng;
					$distance_in_meter = $result->distance * 1000;
					$res['distance'][] = round($distance_in_meter, 2);
				}
				return $res;
				foreach($res as $re){
					echo "<pre>";
					print_r($re);
						//echo $re['image_thumb'] . '<br>';
					
				}
				exit;
				return $res;
			}exit;
			return $this->responseRequestStatus(false);
		}catch(Exception $e){
			return $this->responseRequestStatus(false);
		}
	}

}