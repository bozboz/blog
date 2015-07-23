@foreach ($blogPosts as $blogPost)

	<li>
		{{ HTML::linkRoute('blog.detail', $blogPost->title, ['slug' => $blogPost->slug]) }}
	</li>

@endforeach