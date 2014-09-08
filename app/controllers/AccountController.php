<?php

class AccountController extends BaseController {

	public function login()
	{
		return View::make('/account/login');
	}
	
	public function logout()
	{
		return View::make('/account/logout');
	}

}