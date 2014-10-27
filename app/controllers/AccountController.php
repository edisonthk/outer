<?php

class AccountController extends BaseController {
				//method+URI
	public function getSignin()
	{
		$authUrl = GoogleOAuth::getAuthorizationUri();
		
		return View::make("account.signin",["authUrl" => $authUrl]);
	}
	// public function postLogin()
	// {
		// $accounts = Account::all();

		// return View::make('/account/login',[$my_account = $accounts]);
	// }



	public function getSignout()
	{
		GoogleOAuth::logout();
		Session::forget("user");
		
        return Redirect::to("/");
	}

	public function getOauth2callback()
	{
		$googleService = GoogleOAuth::consumer();

        if(Input::has("code")){
            $code = Input::get("code");
            $googleService->requestAccessToken($code);
            return Redirect::to("/account/oauth2callback");
        }

        if(!GoogleOAuth::hasAuthorized()){
        	// fail to authorized
            die("Not authorized yet");
        }


        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
		$account = $this->getAccountByGoogleId($result["id"]);

        if(is_null($account)){
        	// 初めてログインする人はデータベースに保存されます。
        	$account = new Account;
        	$account->name 		= $result["name"];
        	$account->google_id = $result["id"];
        	$account->email 	= $result["email"];
        	$account->level	= false;
        	$account->save();

        }else{
        	// 初めてのではない人はデータベースのデータを更新
        	// Googleアカウントの名前がGoogleの設定で変更された可能性があるので、ログインする都度アカウント名を更新します。
        	$account->name 		= $result["name"];
        	$account->save();
        }
        
        $result["account_id"] = $account->id;
        Session::put('user', $result);
        return Redirect::to('/snippets');
	}

	// 権限がないページへ
	private function getAccountByGoogleId($googleAccountId)
	{
		$accounts = Account::all();
		foreach ($accounts as $acc) {
			
			if($acc->google_id == $googleAccountId){
				return $acc;
			}
		}
		return null;
	}

}