<?php

class SnippetController extends BaseController {

	public function __construct() {
		 $this->beforeFilter('auth.login', array('except' => array('index','create','show','search')));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){

		$snippets = array();
		foreach (Snippet::orderBy('updated_at','desc')->get() as $snippet) {		//条件付けのときは->get()が必要
			$temp = $snippet->toArray();
			$temp["updated_at"] = $this->convertToUserView($temp["updated_at"]);
			$temp["tags"] = $snippet->tags()->getResults()->toArray();

			array_push($snippets, $temp); 
		}
		//ファイル出力
		$fileName = "/home/vagrant/Code/codegarage/app/storage/history/search.txt";
		$date=date('Y/n/j/G:i:s');
		$ip = $_SERVER["REMOTE_ADDR"];
		file_put_contents($fileName,$ip.' ('.$date.')'.PHP_EOL,FILE_APPEND | LOCK_EX);
		
		return Response::json($snippets);
	}	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return Response::json("snippets.create");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// process the login
		$inputs = Input::all();
		$validator = $this->validate($inputs);

		if ($validator->fails()) {
			return Response::json(["error"=>$validator->messages()],400);
		} else {
			// store
			$snippet = new Snippet;
			$snippet->title       	= Input::get('title');
			$snippet->content     	= Input::get('content');
			$snippet->timestamps 	= true;
			$snippet->lang 			= "jp";
			$snippet->account_id 	= Session::get("user")["account_id"];

			$snippet->save();

			$snippet->tagsave($inputs["tags"]);

		
			return Response::json($snippet->toArray());
		}
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
		$snippet= Snippet::find($id);
		$result = $snippet->toArray();
		$result["tags"] = $snippet->tags()->getResults()->toArray();
		$result["creator_name"] = $snippet->getCreatorName();
		unset($result["account_id"]);

		// ユーザの編集権限
		$result["editable"] = (Session::has("user") && Session::get("user")["account_id"] == $snippet->account_id);
	
/* 		//ファイル出力(スニペット)
		$fileName = "/home/vagrant/Code/codegarage/app/storage/history/selectedsnippet.txt";
		$ip = $_SERVER["REMOTE_ADDR"];
		$date=date('Y/n/j/G:i:s');
		$outputkw =  $date."  ".$ip." : ".$result["id"].":".$result["title"].PHP_EOL;
		$lastline = array_reverse(file($fileName));
		$newsnippet = substr($outputkw, -mb_strlen($result["id"].":".$result["title"]));
		$lastsnippet = substr($lastline[0], -mb_strlen($result["id"].":".$result["title"]));
		if($newsnippet != $lastsnippet){
			file_put_contents($fileName,$outputkw,FILE_APPEND | LOCK_EX);
		} */
		
		//ファイル出力
		$fileName = "/home/vagrant/Code/codegarage/app/storage/history/search.txt";
		$date=date('Y/n/j/G:i:s');
		$outputHead =  "		> ".$result["id"].":".$result["title"];
		$outputkw =  $outputHead.' ('.$date.')'.PHP_EOL;
		$lastline = array_reverse(file($fileName));
		$newsnippet = substr($outputkw, 0,mb_strlen($outputHead));
		$lastsnippet = substr($lastline[0], 0,mb_strlen($outputHead));
		if($newsnippet != $lastsnippet){
			file_put_contents($fileName,$outputkw,FILE_APPEND | LOCK_EX);
		}
		
		return Response::json($result);

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
		// get the shop
		$snippet = Snippet::find($id);

		// show the edit form and pass the shop
		return Response::json('snippets.edit')
			->with('snippet', $snippet);
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
		// validate
		// read more on validation at http://laravel.com/docs/validation
		/*
		$rules = array(
			'title'       => 'required',
			'content'      => 'required',
			'tags_id'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
*/
		$validator = $this->validate(Input::all());
		// process the login
		if ($validator->fails()) {

			return Response::json(["error"=>$validator->messages()], 400);
		/*
			return Redirect::to('snippet/create')
				->withErrors($validator)
				->withInput(Input::except('password')); */
				
		} else {
			// store
			$snippet = Snippet::find($id);
			$snippet->title       	= Input::get('title');
			$snippet->content    	= Input::get('content');
			$snippet->timestamps 	=true;
			$snippet->lang 			= "jp";
			$snippet->save();

			$snippet->tagsave(Input::get('tags'));

			// redirect
			Session::flash('message', 'Successfully created snippet!');
			return Response::json('snippet');
		}
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
		$snippet = Snippet::find($id);
		$snippet->delete();

		Session::flash('message', 'Successfully deleted the nerd!');
		return Response::json('snippet');
	}

	public function search()
	{
		if(Input::has("kw")){
			$snippets = array();
			$tags = array();
			$temptags = array();
			
			//キーワードの整形
			$kw=mb_convert_kana( Input::get("kw"),"s");
			preg_match_all("|\[(.*?)\]|",$kw,$tagresult);
			$snippetresult=array_values(array_filter(preg_split("/,|\s/",implode(",",preg_split("/\[(.*)\]/",$kw)))));
			
/* 		//ファイル出力(キーワード)
			$fileName = "/home/vagrant/Code/codegarage/app/storage/history/searchedkw.txt";
			$ip = $_SERVER["REMOTE_ADDR"];
			$date=date('Y/n/j/G:i:s');
			$outputkw =  $date."  ".$ip." : ".$kw.PHP_EOL;
			file_put_contents($fileName,$outputkw,FILE_APPEND | LOCK_EX); */

			//ファイル出力
			$fileName = "/home/vagrant/Code/codegarage/app/storage/history/search.txt";
			//$ip = $_SERVER["REMOTE_ADDR"].PHP_EOL;
			$date=date('Y/n/j/G:i:s');
			$outputkw =  "	> ".$kw.' ('.$date.')'.PHP_EOL;
			//file_put_contents($fileName,$ip,FILE_APPEND | LOCK_EX);
			file_put_contents($fileName,$outputkw,FILE_APPEND | LOCK_EX);
			
			//タグ検索
			foreach($tagresult[1] as $t){
				foreach (Tag::where("name","=",$t)->get() as $tag) {
					array_push($tags, $tag); 
				}
			}
			foreach($tags as $tag){
				$temp_snippets=$tag->snippets()->getResults();
				array_push($temptags,$temp_snippets);
			}
			foreach($temptags as $item){
				foreach ($item as $snippet) {
					$temp = $snippet->toArray();
					$temp["tags"] = $snippet->tags()->getResults()->toArray();
					array_push($snippets, $temp); 
				}
			}
			//タイトル・コンテンツ検索
			foreach($snippetresult as $t){
				if($t != ''){
					foreach (Snippet::where("title","like","%".$t."%")->orWhere("content","like","%".$t."%")->get() as $snippet) {
						$temp = $snippet->toArray();
						$temp["tags"] = $snippet->tags()->getResults()->toArray();
						array_push($snippets, $temp); 
					}
				}else{
					continue;
				}
			}
			
			//重複の削除
			$tmp = array();
			$snippets_result = array();
			foreach( $snippets as $key => $value ){
				if( !in_array( $value['id'], $tmp ) ) {
					$tmp[] = $value['id'];
					$snippets_result[] = $value;
				}
			}
			//ソート
			// $updated_at=array();
			// foreach($snippets_result as $key=>$value){
			// 	$updated_at[$key]=$value["updated_at"];    
			// }
			usort($snippets_result, function($item1, $item2) {
				$ts1 = strtotime($item1["updated_at"]);
				$ts2 = strtotime($item2["updated_at"]);

				return $ts2 - $ts1;
			});

			$new_snippet_result = [];
			foreach ($snippets_result as $value) {
				$value["updated_at"] = $this->convertToUserView($value["updated_at"]);
				array_push($new_snippet_result, $value);
			}
			// array_multisort($updated_at,SORT_ASC,SORT_NATURAL,$snippets_result);
			return Response::json($new_snippet_result);
		}

		App::abort(404);
	}

	private function convertToUserView($timestamp){
	    $d1 = new DateTime($timestamp);
	    $n = new DateTime("now");
	    $diff = $d1->diff($n);

	    if($diff->y > 0) { 
	        return $diff->format("%y年前");
	    } 
	    if($diff->m > 0) { 
	        return $diff->format("%m月前");
	    } 
	    if($diff->d > 0) { 
	        return $diff->format("%d日前");
	    } 
	    if($diff->h > 0) { 
	        return $diff->format("%h時間前");
	    } 
	    if($diff->i > 0) { 
	        return $diff->format("%i分前");
	    } 

	    return "１分前";
	}

	private function validate($inputs)
	{
		Validator::extend('tag_exists', function($attribute, $value, $parameters)
		{
			if(is_array($value)){
				foreach ($value as $key => $single) {
					$count = Tag::where("name","=",$single)->count();
					if($count <= 0){
						break;
					}
				}
			}else{
				$count = Tag::where("name","=",$value)->count();	
			}
			

		    return $count > 0;
		});

		$rules = array(
			'title'       => 'required',
			'content'      => 'required',
			'tags'      => 'required'
		);

		return Validator::make($inputs, $rules);
	}

}