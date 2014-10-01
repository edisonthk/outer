<?php

class TagController extends BaseController {
				
	public function Tag()
	{
		$tags = Tag::all();

		return View::make('snippet',[$my_tag => $tags]);
	}
}