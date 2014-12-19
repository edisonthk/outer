<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		
		$response = $this->call('GET', 'user/profile');

		// to check either the variable is true.
		$this->assertTrue($response->isOk());


		$response = $this->call('GET', '/');
		$this->assertTrue($response->isOk());

		$response = $this->call('GET', '/snippets');
		$this->assertTrue($response->isOk());

		
	}

}
