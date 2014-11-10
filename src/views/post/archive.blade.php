<h1>Archive</h1>

<ul>
  @foreach ($blogPosts as $blogPost)
    <li>
      {{ HTML::linkRoute('blog.detail', $blogPost->title, ['slug' => $blogPost->slug]) }}
    </li>
  @endforeach
</ul>

{{ $blogPosts->links() }}
