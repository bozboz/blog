<h1>{{ $category->name }}</h2>

<ul>
  @if (Config::get('blog::sticky_posts_enabled') && !empty($stickyBlogPost))
    <li>
      <a href="{{ URL::route('blog.detail', ['slug' => $stickyBlogPost->slug]) }}">
	<p>{{ $stickyBlogPost->title }}</p>
	<p>{{ $stickyBlogPost->short_description }}</p>
      </a>
    </li>
  @endif
  @foreach ($category->blogPosts as $post)
      <a href="{{ URL::route('blog.detail', ['slug' => $post->slug]) }}">
	<li>
	  <p>{{ $post->title  }}</p>
	  <p>{{ $post->short_description }}</p>
	</li>
      </a>
  @endforeach
</ul>
