<ul>
	@foreach ($blogPosts as $post)
	<li>
		<a href="{{ URL::route('blog.detail', ['slug' => $post->slug]) }}">
			<p>{{ $post->title  }}</p>
			<p>{{ $post->short_description }}</p>
		</a>
	</li>
	@endforeach
</ul>
