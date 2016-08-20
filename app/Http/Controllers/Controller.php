<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Response Status after request
	 *
	 * This will return only the status
	 * @param bool $status = true
	 * @return bool - 200 if success
	 */
	public function responseRequestStatus($status = true, $default_message = null){

		$code = $status ? 200 : 500;

		if($status){
			if(!is_null($default_message)){
				return array(
							'status' => $code,
							'message' => $default_message,
				);
			}
			return array(
						'status' => $code,
						'message' => 'Success',
			);
		}
		
		return ! is_null($default_message) ? array('status' => $code, 'message' => $default_message) : array('status' => $code, 'message' => 'Error');
	}

}
