<?php namespace Bozboz\Blog\Models;

use Bozboz\Admin\Models\Base;
use Bozboz\Blog\Validators\BlogCategoryValidator;

class BlogCategory extends Base
{
	protected $table = 'blog_categories';

	protected $fillable = ['name', 'slug', 'status', 'sticky_post_id'];

	public function getValidator()
	{
		return new BlogCategoryValidator();
	}

	public function blogPosts()
	{
		return $this->belongsToMany(
			'Bozboz\Blog\Models\BlogPost',
			'blog_posts_mm_blog_categories'
		);
	}

	public function stickyBlogPost()
	{
		return $this->belongsTo('Bozboz\Blog\Models\BlogPost', 'sticky_post_id');
	}
}
