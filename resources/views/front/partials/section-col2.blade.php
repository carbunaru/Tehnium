<div class="row">
    <div class="col-lg-9">
        <div class="blog-list clearfix">
            <div class="section-title">
                <h3 class="color-green"><a href="{{ route('category','tech') }}" title="">Tech</a></h3>
            </div><!-- end title -->

            @foreach($categories as $cat)
                @if($cat->title=="Tech")
                    @foreach($cat->recent_3_public_pages_off() as $pag)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="single.html" title="">
                                        <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
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
            
        </div><!-- end blog-list -->

        <hr class="invis">

        <div class="blog-list clearfix">
            <div class="section-title">
                <h3 class="color-green"><a href="{{ route('category','internet') }}" title="">Internet</a></h3>
            </div><!-- end title -->

            @foreach($categories as $cat)
                @if($cat->title=="Internet")
                    @foreach($cat->recent_3_public_pages_off() as $pag)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="single.html" title="">
                                        <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
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
            
        </div><!-- end blog-list -->
    </div><!-- end col -->

    <div class="col-lg-3">
        <div class="section-title">
            <h3 class="color-yellow"><a href="{{ route('category','gaming') }}" title="">Gaming</a></h3>
        </div><!-- end title -->
        @foreach($categories as $cat)
            @if($cat->title=="Gaming")
                @foreach($cat->recent_3_public_pages_off() as $pag)
                    <div class="blog-box">
                        <div class="post-media">
                            <a href="single.html" title="">
                                <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                <div class="hovereffect">
                                    <span class="videohover"></span>
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
        

        <div class="section-title">
            <h3 class="color-grey"><a href="{{ route('category','auto') }}" title="">Auto</a></h3>
        </div><!-- end title -->

        @foreach($categories as $cat)
            @if($cat->title=="Auto")
                @foreach($cat->recent_2_public_pages_off() as $pag)
                    <div class="blog-box">
                        <div class="post-media">
                            <a href="single.html" title="">
                                <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                <div class="hovereffect">
                                    <span class="videohover"></span>
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