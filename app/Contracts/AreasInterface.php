<?php namespace App\Contracts;

interface AreasInterface{
	

	public function create(array $data);

	public function query($string);
}