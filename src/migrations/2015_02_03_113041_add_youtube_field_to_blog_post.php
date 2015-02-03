<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYoutubeFieldToBlogPost extends Migration {

	private $attribute = 'youtube_url';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blog_posts', function(Blueprint $table)
		{
			$table->string($this->attribute, 255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blog_posts', function(Blueprint $table)
		{
			$table->dropColumn($this->attribute);
		});
	}

}
