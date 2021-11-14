<div class="widget">
    <h2 class="widget-title">Recent Posts</h2>
    <div class="blog-list-widget">
        <div class="list-group">
            @foreach($widget_pages as $wp)
                <a href="{{ route('article',['article'=>$wp->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="w-100 justify-content-between">
                        <img src="/admin/images/articles/{{ $wp->photo }}" alt="" class="img-fluid float-left">
                        <h5 class="mb-1">{{ $wp->title }}</h5>
                        <small>{{ $wp->published_at->format('d M Y') }} /  
                        
                        @foreach($wp->categories as $categ)
                            {{ $categ->title }} 
                                @if($categ != last($wp->categories)) 
                                 |
                                 @endif
                        @endforeach
                        
                        </small>
                    </div>
                </a>
            @endforeach
        </div>
    </div><!-- end blog-list -->
</div><!-- end widget -->