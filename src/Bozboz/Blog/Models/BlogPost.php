<?php namespace Bozboz\Blog\Models;

use Bozboz\Admin\Models\Base;
use Bozboz\Blog\Validators\BlogPostValidator;

class BlogPost extends Base
{
	public $table = 'blog_posts';

	public $fillable = ['title', 'short_description', 'content', 'status'];

	public function getValidator()
	{
		return new BlogPostValidator();
	}
}
