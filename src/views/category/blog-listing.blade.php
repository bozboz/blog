<h1>{{ $category->name }}</h2>

<ul>
  @foreach ($blogPosts as $post)
      <a href="{{ URL::route('blog.detail', ['slug' => $post->slug]) }}">
	<li>
	  <p>{{ $post->title  }}</p>
	  <p>{{ $post->short_description }}</p>
	</li>
      </a>
  @endforeach
</ul>
