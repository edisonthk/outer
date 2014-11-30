<?php

class TagController extends BaseController {
				
	public function getIndex(){

		if(Input::has("q")){
			return Response::json(Tag::onlyName(Input::get("q")));
		}

		return Response::json(Tag::onlyName());
	}
}