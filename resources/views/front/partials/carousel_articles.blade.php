<div class="single-post-media">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            @foreach($category->recent_5_public_pages() as $index=>$art)
                <div class="carousel-item {{ $index==0 ? 'active' : '' }}">
                    <div class="masonry-box post-media">
                    <img class="d-block img-fluid" style="max-height:422px;" src="/admin/images/articles/{{ $art->photo }}" alt="First slide">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                    <span class="bg-aqua"><a href="{{ route('category',['category'=>$category->slug]) }}" title="">{{ $category->title }}</a></span>
                                    <h4><a href="{{ route('article',['article'=>$art->slug]) }}" title="">{{ ucfirst($art->title) }}</a></h4>
                                    <small><a href="single.html" title="">{{ $art->published_at->format('d M Y') }}</a></small>
                                    <small><a href="{{ route('showArticles',['search'=>$art->author->id, 'name'=>$art->author->name]) }}" title="">by {{ $art->author->name }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
                </div>
            @endforeach
        </div>
        <ol class="carousel-indicators">
            @foreach($category->recent_5_public_pages() as $index=>$art)
                <li data-target="#carouselExampleControls" data-slide-to="{{$index}}" class="{{ $index==0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
    </div>
</div><!-- end media -->