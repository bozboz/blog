<?php namespace Bozboz\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogStatus;

class BlogPostSeeder extends Seeder
{
	public function run()
	{
		BlogPost::truncate();

		for ($i = 1; $i <= 20; $i++) {
			BlogPost::create([
				'title' => 'BlogPost ' . $i . ' title',
				'short_description' => 'BlogPost ' . $i . ' short_description',
				'content' => 'BlogPost ' . $i . ' content',
				'blog_status_id' => BlogStatus::ACTIVE,
				'slug' => 'blog-' . $i
			]);
		}
	}
}
