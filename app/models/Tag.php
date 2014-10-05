<?php

class Tag extends Eloquent {



	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tag_table';
	
	public $timestamps = true;

	public static function onlyName(){

		$results = array();

		$tags = self::all(array("name"));
		foreach ($tags as $key => $value) {
			$name = $value->name;
			array_push($results, $name);
		}

		return $results;
	}


}