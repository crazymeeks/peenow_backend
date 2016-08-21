<?php namespace App\Services\Api;

use App\Area;
use Validator;
use App\Contracts\AreasInterface as AreasContract;
use DB;
class Areas implements AreasContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	// public function validator(array $data)
	// {
	// 	return Validator::make($data, [
	// 		'name' => 'required|max:255',
	// 		'email' => 'required|email|max:255|unique:users',
	// 		'password' => 'required|confirmed|min:6',
	// 	]);
	// }

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return bool - true on success
	 */
	public function create(array $data)
	{
		
		//print_r($data);exit;
		if(Area::create([
			'image_text' 	=> $data['image_text'],
			'description' 	=> $data['description'],
			'image_thumb' 	=> $data['image_thumb'],
			'lat' => $data['lat'],
			'lng' => $data['lng'],
		])){
			return true;
		}
		return false;
	}

	/**
	 * The query
	 *
	 * This is in kilometer. The 0.5 below is equivalent to 500meters
	 * we will search available cr within 500meters
	 *
	 * @param string $lat     The latitude
	 * @param string $lng     The longitude
	 * @param bool $thumb     Check if we need to return image thumb only
	 * @return array
	 */
	public function getLocationRadius($lat, $lng, $thumb = true){
		if($thumb){
			$areas = DB::table('areas')
                     ->select(DB::raw('id, image_thumb, lat, lng,
    								( 6371 * acos( cos( radians(' . $lat . ') ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians( `lat` ) ) ) ) AS distance'))
                     ->having('distance', '<=', 0.5)
                     ->get();
		}
		
        return $areas;
	}

	/**
	 * Find record by id(primary key)
	 *
	 * @param int $id
	 * @return App\Area
	 */
	public function find($id){
		$areas = DB::table('areas')
                     ->select(DB::raw('id, image_text, lat, lng'))
                     ->where('id', '=', $id)
                     ->get();

        return $areas;
	}

}
