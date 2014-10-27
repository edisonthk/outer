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
            'client_id'     => '754486540313-kg9j4k03tnn0s9d9c29gfkt88qqki6tq.apps.googleusercontent.com',
            'client_secret' => 'GhtQ-pYtrFe3F7Ta1WVoAyzm',
            'redirect_url'	=> 'http://localhost:8000/account/oauth2callback',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),		

	)

);