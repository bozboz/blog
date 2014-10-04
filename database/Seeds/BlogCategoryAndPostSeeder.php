<?php namespace Bozboz\Blog\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;

/**
 * Link together BlogPosts and BlogCategories
 */
class BlogCategoryAndPostSeeder extends Seeder
{
	const NO_RELATED_POSTS_ID = 5;
	const NO_RELATED_CATEGORIES_ID = 5;

	public function run()
	{
		DB::statement('TRUNCATE blog_posts_mm_blog_categories');

		$categorySeeder = new BlogCategorySeeder();
		$postSeeder = new BlogPostSeeder();

		$categorySeeder->run();
		$postSeeder->run();

		foreach (BlogCategory::where('id', '!=', self::NO_RELATED_POSTS_ID)->get() as $blogCategory) {
			$blogCount = $blogCategory->id;
			$blogPosts = BlogPost::where('id', '!=', self::NO_RELATED_CATEGORIES_ID)->take($blogCount)->get();
			foreach ($blogPosts as $blogPost) {
				$blogPost->categories()->attach($blogCategory->id);
			}
		}
	}
}
