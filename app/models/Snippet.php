<?php

class Snippet extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'snippet_table';
	
	public $timestamps = true;

	public function tags(){
		return $this->belongsToMany('Tag','snippet_tag','snippet_id','tag_id');
	}

}