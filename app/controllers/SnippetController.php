<?php

class SnippetController extends BaseController {

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
		return View::make("snippets.create");
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
		$inputs["tags"] = json_decode($inputs["tags"],true);
		$validator = $this->validate($inputs);

		if ($validator->fails()) {
			return Redirect::to('/snippet/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$snippet = new Snippet;
			$snippet->title       = Input::get('title');
			$snippet->content     = Input::get('content');
			$snippet->timestamps=true;

			$snippet->save();

			$tags = array();
			foreach ($inputs["tags"] as $value) {
				$t = Tag::where("name","=",$value)->first();
				if(!is_null($t)){
					$snippet->tags()->save($t);	
				}
			}

			

			
			Session::flash('message', 'Successfully created Snippet!');
			return Redirect::to('/snippet');
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
		return View::make('snippets.edit')
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
		$rules = array(
			'title'       => 'required',
			'content'      => 'required',
			'tags_id'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('snippet/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$snippet = Snippet::find($id);
			$snippet->title       = Input::get('title');
			$snippet->content     = Input::get('content');
			$snippet->tags_id     = Input::get('tags_id');
			$snippet->timestamps=true;

			$snippet->save();

			// redirect
			Session::flash('message', 'Successfully created snippet!');
			return Redirect::to('snippet');
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
		return Redirect::to('snippet');
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
			'tags'      => 'required|tag_exists'
		);

		return Validator::make($inputs, $rules);
	}

}