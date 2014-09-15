<?php namespace Bozboz\Blog\Database\Seeds;

use Bozboz\Blog\Models\BlogStatus;
use Illuminate\Database\Seeder;

class BlogStatusSeeder extends Seeder
{
	public function run()
	{
		BlogStatus::truncate();
		$blogStatusesData = [
			['name' => 'Inactive'],
			['name' => 'Active']
		];
		foreach ($blogStatusesData as $blogStatusData) {
			BlogStatus::create($blogStatusData);
		}
	}
}
