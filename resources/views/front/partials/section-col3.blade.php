<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="section-title">
            <h3 class="color-aqua"><a href="{{ route('category','science') }}" title="">Science</a></h3>
        </div><!-- end title -->

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @foreach($categories as $cat)
                    @if($cat->title=="Science")
                        @foreach($cat->recent_2_public_pages() as $pag)
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="{{ route('article',$pag->slug) }}" title="">
                                        <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                            <span></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta big-meta">
                                    <h4><a href="{{ route('article',$pag->slug) }}" title="">{{ $pag->title }}</a></h4>
                                    <p>{!! $pag->getExcerpt($pag->excerpt) !!}</p>
                                    <small><a href="{{ route('category',$cat->slug) }}" title="">{{ $cat->title }}</a></small>
                                    <small><a href="single.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                    <small><a href="{{ route('showArticles',['search'=>$pag->author->id,'name'=>$pag->author->name]) }}" title="">by {{ $pag->author->name }}</a></small>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                         <hr class="invis">
                        @endforeach                   
                    @endif
                @endforeach
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end col -->

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="section-title">
            <h3 class="color-pink"><a href="{{ route('category','auto') }}" title="">Auto</a></h3>
        </div><!-- end title -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                @foreach($categories as $cat)
                    @if($cat->title=="Auto")
                        @foreach($cat->recent_3_public_pages() as $pag)
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="{{ route('article',$pag->slug) }}" title="">
                                        <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                            <span></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="{{ route('article',$pag->slug) }}" title="">{{ $pag->title }}</a></h4>
                                    <small><a href="{{ route('category',$cat->slug) }}" title="">{{ $cat->title }}</a></small>
                                    <small><a href="blog-category-01.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                            <hr class="invis">
                        @endforeach                   
                    @endif
                @endforeach
            </div><!-- end col -->

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                @foreach($categories as $cat)
                    @if($cat->title=="Auto")
                        @foreach($cat->recent_3_public_pages_off() as $pag)
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="{{ route('article',$pag->slug) }}" title="">
                                        <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                            <span></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="{{ route('article',$pag->slug) }}" title="">{{ $pag->title }}</a></h4>
                                    <small><a href="{{ route('category',$cat->slug) }}" title="">{{ $cat->title }}</a></small>
                                    <small><a href="blog-category-01.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                            <hr class="invis">
                        @endforeach                   
                    @endif
                @endforeach
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end col -->
</div><!-- end row -->