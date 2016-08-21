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

		/*$cache_keyword = "*";
		$cache_instance = $this->cache_instance->getInstance('files');
    	$cache = $cache_instance->getItem($cache_keyword);

    	if(is_null($cache->get())) {
    		$areas = DB::table('areas')
                     ->select(DB::raw('id, description, image_thumb, lat, lng'
    								))
                     ->get();
    		$cache->set($areas)->expiresAfter(60);//in seconds, also accepts Datetime
	    	$cache_instance->save($cache); // Save the cache item just like you do with doctrine and 
	    return $cache->get();
	     }*/
	    
	    	$areas = DB::table('areas')
                     ->select(DB::raw('id, description, image_thumb, lat, lng'
    								))
                     ->get();
		//return $cache->get();
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


		// $cache_keyword = count($latlng) == 1 ? 'primary_id' : 'latlng';

		// $cache_instance = $this->cache_instance->getInstance('files');
  //   	$cache = $cache_instance->getItem($cache_keyword);

  //   	if($cache_keyword == 'primary_id'){
  //   		if(is_null($cache->get())) {
		//     	// Get data using id(primary key)
		// 		if(count((array)$this->areas->find($latlng[0])) != 0){
		// 			$areas = $this->areas->find($latlng[0]);
		// 			$cache->set($areas)->expiresAfter(60);
		// 			$cache_instance->save($cache);
		// 			return $cache->get();
		// 			//return $this->areas->find($latlng[0]);
		// 		}
		// 		return $this->responseRequestStatus(true, "No record");
		// 		//return $this->responseRequestStatus(false);
		// 	}
		// 	return $cache->get();
		// 	//return $this->areas->find($latlng[0]);
  //   	}else{
  //   		$lat = $latlng[0];
		// 	$lng = $latlng[1];
  //   		if(is_null($cache->get())){
		// 		//m = km x 1,000
		// 		$results = $this->areas->getLocationRadius($lat, $lng, true);
		// 		if(count((array)$results) != 0){
		// 			$res = array();
		// 			foreach($results as $result){
		// 				$distance_in_meter = $result->distance * 1000;
		// 				$res[] = array(
		// 					array('id' =>$result->id,
		// 						  'image_thumb' => $result->image_thumb,
		// 						  'description' => $result->description,
		// 						  'lat' => $result->lat,
		// 						  'lng' => $result->lng,
		// 						  'distance' => round($distance_in_meter, 2),
		// 					),
		// 				);
					
		// 			}
		// 			$cache->set($res)->expiresAfter(60);
		// 			$cache_instance->save($cache);
		// 			return $cache->get();
		// 			//return $res;
		// 		}

		// 		// no record
		// 		return $this->responseRequestStatus(false);
  //   		}
  //   		return $cache->get();
  //   	}



		// original code
		//$latlng = explode(",", $latlng);
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
				$res = array();
				foreach($results as $result){
					$distance_in_meter = $result->distance * 1000;
					$res[] = array(
						array('id' =>$result->id,
							  'image_thumb' => $result->image_thumb,
							  'description' => $result->description,
							  'lat' => $result->lat,
							  'lng' => $result->lng,
							  'distance' => round($distance_in_meter, 2),
						),
					);
				
				}
				return $res;
			}
			return $this->responseRequestStatus(false);
		}catch(Exception $e){
			return $this->responseRequestStatus(false);
		}
	}

}