<?php namespace Bozboz\Blog\Tests\Models;

use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Blog\Database\Seeds\BlogStatusSeeder;

class BlogStatusTest extends \TestCase
{
	public function setUp()
	{
		parent::setUp();
		$seeder = new BlogStatusSeeder();
		$seeder->run();
	}

	public function testToArray()
	{
		$blogStatus = new BlogStatus();
		$expectedOutput = [
			BlogStatus::INACTIVE => 'Inactive',
			BlogStatus::ACTIVE  => 'Active'
		];

		$actualOutput = $blogStatus->toArray();

		$this->assertEquals($expectedOutput, $actualOutput);
	}
}
