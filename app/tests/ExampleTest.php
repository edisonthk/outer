<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		

		
		$this->checkingGET('/');
		$this->checkingGET('/html/snippet');
		$this->checkingGET('/html/snippet/create');
	}

	public function checkingGET($url){
		$this->call('GET', $url);
    	$this->assertResponseOk();
	}

}
