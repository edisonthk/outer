<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Google' => array(
            'client_id'     => '754486540313-k8qdqh2lgbhc2buil2o0b9qt6vsvahdb.apps.googleusercontent.com',
            'client_secret' => 'FHHI_7uCq8IUUoIwacJwZaT1',
            'redirect_url'	=> 'http://codegarage.edisonthk.com/account/oauth2callback',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),		

	)

);