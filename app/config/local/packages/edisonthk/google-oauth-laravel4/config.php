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
            'client_id'     => '777251833385-i7eg26s8nl2oe6ofovvel91r49g2rmc5.apps.googleusercontent.com',
            'client_secret' => 'OzhWR1-cZ5rrZfSbpZ9m5ten',
            'redirect_url'	=> 'http://localhost:8000/account/oauth2callback',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),		

	)

);