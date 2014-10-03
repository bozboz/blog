<ul>
  @foreach ($categories as $category)
	<li>
	  <a href="{{ URL::route('blog-category.listing', ['slug' => $category->slug]) }}">
		{{ $category->name  }}
	  </a>
	</li>
  @endforeach
</ul>
