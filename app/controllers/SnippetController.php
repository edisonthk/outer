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
		foreach (Snippet::all() as $snippet) {
			$temp = $snippet->toArray();
			$temp["tags"] = $snippet->tags()->getResults()->toArray();

			array_push($snippets, $temp); 
		}

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

			$kw = Input::get("kw");
			
			$snippets = array();
			foreach (Snippet::where("title","like","%".$kw."%")->orWhere("content","like","%".$kw."%")->get() as $snippet) {
			
				$temp = $snippet->toArray();
				$temp["tags"] = $snippet->tags()->getResults()->toArray();

				array_push($snippets, $temp); 
			}
			return Response::json($snippets);

		}

		App::abort(404);
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