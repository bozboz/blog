<?php namespace Bozboz\Blog\Decorators;

use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\SelectField;
use Bozboz\Admin\Fields\HTMLEditorField;
use Bozboz\Admin\Fields\CheckboxesField;
use Bozboz\Admin\Decorators\ModelAdminDecorator;

class BlogPostAdminDecorator extends ModelAdminDecorator
{
	public function __construct(BlogPost $blogPostFactory)
	{
		parent::__construct($blogPostFactory);
	}

	public function getColumns($instance)
	{
		if (isset($instance->status->name)) {
			$status = $instance->status->name;
		} else {
			$status = '';
		}

		return [
			'Title' => $this->getLabel($instance),
			'Description' => $instance->getAttribute('short_description'),
			'Status' => $status
		];
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('title');
	}

	public function getFields()
	{
		$blogStatusFactory = new BlogStatus();

		return [
			new TextField(['name' => 'title']),
			new TextField(['name' => 'short_description']),
			new HTMLEditorField(['name' => 'content']),
			new CheckboxesField([
				'name' => 'categories_ids',
				'label' => 'Categories',
				'options' => \Bozboz\Blog\Models\BlogCategory::all(),
			]),
			new SelectField([
				'name' => 'blog_status_id',
				'label' => 'Status',
				'options' => array_replace(
					['' => 'Select'],
					$blogStatusFactory->toArray()
				)
			])
		];
	}

	public function getListingModels()
	{
		return $this->model->orderBy('id')->get();
	}
}
