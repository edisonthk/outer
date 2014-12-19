<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		

		$this->checkingGET('user/profile');
		$this->checkingGET('/');
		$this->checkingGET('/snippets');
		
	}

	private function checkingGET($url){
		$response = $this->call('GET', $url);
		// to check either the variable is true.
		$this->assertTrue($response->isOk());

		echo $url."\n";
	}

}
