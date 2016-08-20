<?php namespace App\Services\Api;

use App\Area;
use Validator;
use App\Contracts\AreasInterface as AreasContract;

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
			'image_text' => $data['image_text'],
			'description' => $data['description'],
			'lat' => $data['lat'],
			'lng' => $data['lng'],
		])){
			return true;
		}
		return false;
	}

	/**
	 * The query
	 * @param string $str     The query string to pass
	 * @return 
	 */
	public function query($str){

	}

}
