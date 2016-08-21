<?php namespace App\Contracts;

/**
 * Contract for Areas
 * Implemented by App\Services\Api\Areas
 *
 * @author Jeff Claud<jeffers.claud@nuworks.ph>
 * @date Aug. 20, 2016
 */
interface AreasInterface{
	

	public function create(array $data);

	public function getLocationRadius($lat, $lng);

	public function find($id);
}