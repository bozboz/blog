<ul>
  @foreach ($blogPosts as $blogPost)
    <li>
      {{ HTML::linkRoute('blogDetail', $blogPost->title, ['slug' => $blogPost->slug]) }}
    </li>
  @endforeach
</ul>
