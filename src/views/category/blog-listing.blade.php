<h1>{{ $category->name }}</h2>

<ul>
  @if (Config::get('blog::sticky_posts_enabled') && !empty($stickyBlogPost))
    <li>
      <p>{{ $stickyBlogPost->title }}</p>
      <p>{{ $stickyBlogPost->short_description }}</p>
    </li>
  @endif
  @foreach ($category->blogPosts as $post)
	<li>
	  <p>{{ $post->title  }}</p>
	  <p>{{ $post->short_description }}</p>
	</li>
  @endforeach
</ul>
