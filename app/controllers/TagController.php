<?php

class TagController extends BaseController {
				
	public function getIndex(){
		return Response::json(Tag::onlyName());
	}
}