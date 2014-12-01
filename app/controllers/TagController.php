<?php

class TagController extends BaseController {
				
	public function getIndex(){

		if(Input::has("q")){
			// According to TagsInput angularJS plugin json format, it should be return json in this way.
			// 
			// [{ "text": "my_tag1" },{ "text": "my_tag2" },{ "text": "my_tag3" }]

			$result = array();
			foreach (Tag::onlyName(Input::get("q")) as $tag) {
				$temp = array("text" => $tag->name);
				array_push($result, $temp);
			}

			return Response::json($result);
		}

		return Response::json(Tag::onlyName());
	}
}