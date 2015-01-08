<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Bozboz\Blog\Models\BlogPost;

class AddPostDateColumnToBlogPosts extends Migration {

	private $tableName = 'blog_posts';
	private $columnName = 'post_date';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table($this->tableName, function($table)
		{
			$table->dateTime($this->columnName);
		});

		foreach(BlogPost::all() as $post) {
			$post->post_date = $post->created_at;
			$post->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table($this->tableName, function($table)
		{
			$table->dropColumn($this->columnName);
		});
	}

}
