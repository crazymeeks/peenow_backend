<?php namespace App\Supports;

/**
 * Serves as core for AreasController
 * @author Jeff Claud<jefferson.claud@nuworks.ph>
 * @created_at Aug. 20, 2016s
 */

use Illuminate\Http\Request;
use Exception;
trait ProcessAndValidateAreas{

	protected $areas;

	/**
	 * Save data
	 * @param none
	 * @return
	 */
	public function getCreate(){

	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return array("status" => 'success');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function saveArea(Request $request){
		try{
			if($this->areas->create($request->all())){
				return true;
			}
			return false;
		}catch(Exception $e){

		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}