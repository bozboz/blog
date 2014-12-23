<?php namespace Bozboz\Blog;

use Illuminate\Support\ServiceProvider;
use Bozboz\Admin\Components\Menu;

class BlogServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('bozboz/blog');

		foreach (['routes.php', 'composers.php'] as $file) {
			require(__DIR__ . '/../../' . $file);
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$url = $this->app['url'];

		$this->app['events']->listen('admin.renderMenu', function(Menu $menu) use ($url)
		{
			$menu['Blog'] = [
				'Posts' => $url->route('admin.blog.posts.index'),
				'Categories' => $url->route('admin.blog.categories.index'),
			];
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
