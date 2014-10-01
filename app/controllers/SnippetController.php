<?php

class SnippetController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		return View::make('snippets.index')->with("snippets",Snippet::all());
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
			return Redirect::to('create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$snippet = new Snippet;
			$snippet->title       = Input::get('title');
			$snippet->content     = Input::get('content');
			$snippet->tags_id     = Input::get('tags_id');
			$snippet->timestamps=true;

			$snippet->save();

			// redirect
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

		return View::make("snippets.show",$snippet)->with("snippet",$snippet);

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

}