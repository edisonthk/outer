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
	//$id,$name,$tag_id,$snippet_id
	public function tagsave($tags){
		$snippet_id = $this->id;
		$tags = DB::select("select id from snippet_tag where snippet_id = ?",array($snippet_id);
		
		foreach($tags as $tag_id){
			DB::delete('delete from snippet_tag where tag_id = ?',array($tag_id));
		}
		
		foreach($tags as $tag_name){
			$tag_id = DB::select("select id from tags where name=?",array($tag_name);
			if(is_null($tag_id)){
				DB::insert("insert into tag_table value (?,?,?,?)",array($tag_id,$tag_name,$created_date,$updated_date));
			}
			DB::insert("insert into snippet_tag value (?,?,?,?,?)",array($id,$tag_id,$snippet_id,$created_date,$updated_date));
		}
	}
}