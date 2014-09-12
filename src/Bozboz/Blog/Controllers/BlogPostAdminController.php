<?php namespace Bozboz\Blog\Controllers;

use Bozboz\Blog\Decorators\BlogPostAdminDecorator;
use Bozboz\Admin\Reports\Report;
use Bozboz\Admin\Controllers\ModelAdminController;

class BlogPostAdminController extends ModelAdminController
{
	public function __construct(BlogPostAdminDecorator $blogPost)
	{
		parent::__construct($blogPost);
	}
}
