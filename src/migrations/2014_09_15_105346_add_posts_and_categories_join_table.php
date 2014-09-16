<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsAndCategoriesJoinTable extends Migration {

	private $tableName = 'blog_posts_mm_blog_categories';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->tableName, function($table)
		{
			$table->increments('id');
			$table->bigInteger('blog_post_id');
			$table->bigInteger('blog_category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->tableName);
	}

}
