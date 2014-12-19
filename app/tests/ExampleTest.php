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
		$this->checkingGET('/snippets');
		
	}

	private function checkingGET($url){

		$crawler = $this->client->request('GET', $url);

		$this->assertTrue($this->client->getResponse()->isOk());

		echo $url."\n";
	}

}
