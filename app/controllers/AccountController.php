<?php

class AccountController extends BaseController {
				//method+URI
	public function getLogin()
	{
		$accounts = Account::all();

		return View::make('/account/login',[$my_account => $accounts]);
	}
	// public function postLogin()
	// {
		// $accounts = Account::all();

		// return View::make('/account/login',[$my_account = $accounts]);
	// }

	public function logout()
	{
		return View::make('/account/logout');
	}

}