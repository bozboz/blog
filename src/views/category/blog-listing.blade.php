<h1>{{ $category->name }}</h2>

<ul>
  @foreach($category->blogPosts as $post)
	<li>
	  <p>{{ $post->title  }}</p>
	  <p>{{ $post->short_description }}</p>
	</li>
  @endforeach
</ul>
