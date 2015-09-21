<?php namespace Bozboz\Blog\Decorators;

use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\DateTimeField;
use Bozboz\Admin\Fields\SelectField;
use Bozboz\Admin\Fields\HTMLEditorField;
use Bozboz\Admin\Fields\CheckboxesField;
use Bozboz\Admin\Fields\BelongsToManyField;
use Bozboz\Admin\Decorators\ModelAdminDecorator;
use Bozboz\MediaLibrary\Fields\MediaBrowser;
use Bozboz\MediaLibrary\Models\Media;


class BlogPostAdminDecorator extends ModelAdminDecorator
{
	protected $categoryDecorator;

	public function __construct(BlogPost $blogPostFactory, BlogCategoryAdminDecorator $category)
	{
		parent::__construct($blogPostFactory);
		$this->categoryDecorator = $category;
	}

	public function getColumns($instance)
	{
		$date = $instance->exists ? $this->dateOfBlog($instance) : null;

		return [
			'Title' => $this->getLabel($instance),
			'Categories' => $this->getCategoriesAsString($instance),
			'Posted' => $date && $date->isPast()? $date->diffForHumans() : '-',
			'Scheduled' => $date && $date->isFuture() ? $date->format('jS F Y') : null,
			'Status' => $instance->blog_status_id === BlogStatus::ACTIVE ? 'Active' : 'Inactive'
		];
	}

	private function dateOfBlog(BlogPost $post)
	{
		return $post->post_date ?: $post->created_at;
	}

	public function getSyncRelations()
	{
		return ['categories', 'media', 'relatedPosts'];
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('title');
	}

	public function getFields($instance)
	{
		return [
			new TextField(['name' => 'title']),
			new TextField(['name' => 'short_description']),
			new HTMLEditorField(['name' => 'content']),
			new TextField(['name' => 'youtube_url']),
			new TextField(['name' => 'slug']),
			new BelongsToManyField($this->categoryDecorator, $instance->categories(), ['label' => 'Categories']),
			new BelongsToManyField($this, $instance->relatedPosts(), ['label' => 'Related Posts']),
			new SelectField([
				'name' => 'blog_status_id',
				'label' => 'Status',
				'options' => array_replace(
					['' => 'Select'],
					BlogStatus::lists('name', 'id')
				)
			]),
			new DateTimeField([
                'name' => 'post_date',
                'label' => 'Post Date'
            ]),
			new MediaBrowser($instance->media())
		];
	}

	public function getListingModels($limit = true)
	{
		return $this->model->latest()->get();
	}

	private function getCategoriesAsString($instance)
	{
		$categories = $instance->categories()->where('status', '=', 1)->get();
		if ($categories->count() === 0) {
			$categoriesString = 'None';
		} elseif ($categories->count() === 1) {
			$categoriesString = $categories->get(0)->name;
		} elseif ($categories->count() >= 2) {
			$i = 0;
			$categoriesString = '';
			while ($i < $categories->count() - 2) {
				$categoriesString .= $categories->get($i++)->name . ', ';
			}
			$categoriesString .= $categories->get($i++)->name . ' and ' . $categories->get($i)->name;
		}

		return $categoriesString;
	}
}
