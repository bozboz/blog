<?php namespace Bozboz\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
	const INACTIVE_ID = 5;

	public function run()
	{
		BlogCategory::truncate();

		for ($i = 1; $i <= 5; $i++) {
			BlogCategory::create([
				'name' => 'BlogCategory #' . $i,
				'status' => $i === self::INACTIVE_ID ? 0 : 1,
				'slug' => 'category-' . $i,
			]);
		}
	}
}
