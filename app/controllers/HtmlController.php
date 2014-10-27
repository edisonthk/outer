<?php

class HtmlController extends BaseController {
	
	public function getSnippet($param = null, $param2 = null){
		if(is_null($param)){
			return View::make("snippets.index");
		}
		
		switch($param){
			case "create":
				return View::make("snippets.modify");
			break;
			case "modify":
				return View::make("snippets.modify");
			break;
		}
	}
}