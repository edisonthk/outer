<?php

class HtmlController extends BaseController {

	public function angularJS(){

		// responsive view
		// READ ONLY site
		if(UserAgent::isMobile() || UserAgent::isTablet()){
			return View::make("responsive.base");
		}
		
		// if(Config::get("app.debug")){
		// 	return View::make("responsive.base");
		// }
		return View::make("base");
	}

	public function getHelp(){
		return View::make("snippets.help");
	}	
	
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

	// responsive page
	// Don't need to create mobile or tablet page for landing-page
	public function landingPage() {

		if(!empty(Cookie::get(AccountController::COOKIE_ALREADY_LOGIN_KEY))){
			Cookie::queue(AccountController::COOKIE_ALREADY_LOGIN_KEY,
				AccountController::COOKIE_ALREADY_LOGIN_VALUE, 
				AccountController::COOKIE_ALREADY_LOGIN_TIME);


			return Redirect::to("/snippets");
		}

		return View::make("landing-page");
	}

	// responsive
	// page required in responsive page
	public function getResponsive($request) {
		if($request == "sidebar"){
			return View::make("responsive.sidebar");
		}else if($request == "snippet"){
			return View::make("responsive.snippet");
		}else if($request == "notavailable"){
			return View::make("responsive.notavailable");
		}else if($request == "about"){
			return View::make("responsive.about");
		}
	}
}