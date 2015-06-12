<ul class="grid--no-padding"><!--
  @foreach($blogPost->relatedPosts()->get() as $relatedPost)
	 --><li class="grid__item medium-3">
			<a class="blog__link" href="{{ URL::route('blog.detail', ['slug' => $relatedPost->slug]) }}">
				
				{{ HTML::media($relatedPost->media(), 'blog_thumb', 'http://placehold.it/250x250', $relatedPost->title, ['width' => '100%']) }}
				<div class="blog__body">
					<h3>{{ $relatedPost->title }}</h3>
					<p>{{ $relatedPost->short_description }}</p>
					<button>Read more</button>
					<time class="blog__post-date" datetime="{{ $relatedPost->post_date }}">{{ date("j / m / y", strtotime($relatedPost->post_date)) }}</time>
				</div>
			</a>
		</li><!--
  @endforeach
--></ul>