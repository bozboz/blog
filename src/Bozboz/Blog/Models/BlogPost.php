<?php namespace Bozboz\Blog\Models;

use Bozboz\Admin\Models\Base;
use Bozboz\Blog\Validators\BlogPostValidator;

class BlogPost extends Base
{
	protected $table = 'blog_posts';

	protected $fillable = ['title', 'short_description', 'content', 'categories_ids'];

	public function getValidator()
	{
		return new BlogPostValidator();
	}

	public function status()
	{
		return $this->belongsTo('Bozboz\Blog\Models\BlogStatus', 'blog_status_id');
	}

	public function categories()
	{
		return $this->belongsToMany(
			'Bozboz\Blog\Models\BlogCategory',
			'blog_posts_mm_blog_categories',
			'blog_post_id',
			'blog_category_id'
		);
	}

	public function setCategoriesIdsAttribute($categories)
	{
		$data = is_array($categories) ? $categories : [];
		$this->categories()->sync($data);
	}

	public function getCategoriesIdsAttribute()
	{
		return $this->categories()->lists('blog_category_id');
	}
}