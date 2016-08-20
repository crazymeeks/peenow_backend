<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model {

	protected $fillable = array('image_text', 'image_thumb', 'description', 'lat', 'lng');


}
