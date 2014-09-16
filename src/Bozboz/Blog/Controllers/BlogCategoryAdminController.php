<?php namespace Bozboz\Blog\Controllers;

use Bozboz\Admin\Controllers\ModelAdminController;
use Bozboz\Blog\Decorators\BlogCategoryAdminDecorator;

class BlogCategoryAdminController extends ModelAdminController
{
	public function __construct(BlogCategoryAdminDecorator $blogCategory)
	{
		parent::__construct($blogCategory);
	}
}
