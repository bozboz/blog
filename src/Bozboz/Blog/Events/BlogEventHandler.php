<?php namespace Bozboz\Blog\Events;

use Bozboz\Admin\Components\Menu;

class BlogEventHandler
{
	public function subscribe($events)
	{
		$events->listen('admin.renderMenu', get_class($this).  '@onRenderMenu');
	}

	public function onRenderMenu(Menu $menu)
	{
		$menu['Blog Posts'] = route('admin.blog.posts.index');
		$menu['Blog Categories'] = route('admin.blog.categories.index');
	}
}
