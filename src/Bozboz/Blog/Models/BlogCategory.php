<?php namespace Bozboz\Blog\Models;

use Bozboz\Admin\Models\Base;
use Bozboz\Blog\Validators\BlogCategoryValidator;

class BlogCategory extends Base
{
	protected $table = 'blog_categories';

	protected $fillable = ['name', 'slug', 'status'];

	public function getValidator()
	{
		return new BlogCategoryValidator();
	}

	public function blogPosts()
	{
		return $this->belongsToMany(
			'Bozboz\Blog\Models\BlogPost',
			'blog_posts_mm_blog_categories',
			'blog_post_id',
			'blog_category_id'
		);
	}

	/**
	 * @return array id => name
	 */
	public function toArray()
	{
		$output = [];
		foreach (BlogCategory::all() as $blogCategory) {
			$output[$blogCategory->id] = $blogCategory->name;
		}

		return $output;
	}
}
