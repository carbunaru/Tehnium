<div class="widget">
    <h2 class="widget-title">Popular Posts</h2>
    <div class="blog-list-widget">
        <div class="list-group">
            @foreach($widget_pages_view as $wpv)
                <a href="{{ route('article',['article'=>$wpv->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="w-100 justify-content-between">
                        <img src="/admin/images/articles/{{ $wpv->photo }}" alt="" class="img-fluid float-left">
                        <h5 class="mb-1">{{ $wpv->title }}</h5>
                        <small>{{ $wpv->published_at->format('d M Y') }} /  
                        
                        @foreach($wpv->categories as $categ)
                            {{ $categ->title }} | 
                        @endforeach
                        
                        </small>
                    </div>
                </a>
            @endforeach
        </div>
    </div><!-- end blog-list -->
</div><!-- end widget -->