<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		// to check either the variable is true.
		$this->assertTrue($this->client->getResponse()->isOk());
	}

}
