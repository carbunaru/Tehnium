<section class="section first-section">
    <div class="container-fluid"> 
        <div class="masonry-blog clearfix">
            @foreach($categories  as $cat) 
                <div class="left-side">                  
                        @if($cat->title=='Tech')
                            @foreach($cat->recent_3_public_pages() as $pag)
                                <div class="masonry-box {{ $pag->id==($cat->recent_3_public_pages())[0]['id'] ? '' : 'small-box' }} post-media">
                                    <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid" style="max-height:360px;">
                                    <div class="shadoweffect">
                                        <div class="shadow-desc">
                                            <div class="blog-meta">
                                                <span class="bg-green"><a href="{{ route('category', ['category'=> $cat->slug]) }}" title="">{{ $cat->title }}</a></span>
                                                <h4><a href="{{ route('article',['article'=>$pag->slug]) }}" title="">{{ $pag->title }}</a></h4>
                                                @if($pag->id==($cat->recent_3_public_pages())[0]['id'])
                                                <small><a href="single.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                                <small><a href="{{ route('showArticles',['search'=>$pag->author->id, 'name'=>$pag->author->name]) }}" title="">BY {{ $pag->author->name }}</a></small>
                                                @endif
                                            </div><!-- end meta -->
                                        </div><!-- end shadow-desc -->
                                    </div><!-- end shadow -->
                                </div><!-- end post-media -->
                            @endforeach
                        @endif      
                </div><!-- end left-side -->
            
                <div class="center-side">              
                        @if($cat->title=='Internet')
                            @foreach($cat->recent_3_public_pages() as $pag)
                                <div class="masonry-box {{ $pag->id==($cat->recent_3_public_pages())[0]['id'] ? '' : 'small-box' }} post-media">
                                    <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid" style="max-height:360px;">
                                    <div class="shadoweffect">
                                        <div class="shadow-desc">
                                            <div class="blog-meta">
                                                <span class="bg-green"><a href="{{ route('category', ['category'=> $cat->slug]) }}" title="">{{ $cat->title }}</a></span>
                                                <h4><a href="{{ route('article',['article'=>$pag->slug]) }}" title="">{{ $pag->title }}</a></h4>
                                                @if($pag->id==($cat->recent_3_public_pages())[0]['id'])
                                                <small><a href="single.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                                <small><a href="{{ route('showArticles',['search'=>$pag->author->id, 'name'=>$pag->author->name]) }}" title="">BY {{ $pag->author->name }}</a></small>
                                                @endif
                                            </div><!-- end meta -->
                                        </div><!-- end shadow-desc -->
                                    </div><!-- end shadow -->
                                </div><!-- end post-media -->
                            @endforeach
                        @endif                
                </div><!-- end center-side -->

                <div class="right-side hidden-md-down">                   
                        @if($cat->title=='Gaming')
                            @foreach($cat->recent_3_public_pages() as $pag)
                                <div class="masonry-box {{ $pag->id==($cat->recent_3_public_pages())[0]['id'] ? '' : 'small-box' }} post-media">
                                    <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid" style="max-height:360px;">
                                    <div class="shadoweffect">
                                        <div class="shadow-desc">
                                            <div class="blog-meta">
                                                <span class="bg-green"><a href="{{ route('category', ['category'=> $cat->slug]) }}" title="">{{ $cat->title }}</a></span>
                                                <h4><a href="{{ route('article',['article'=>$pag->slug]) }}" title="">{{ $pag->title }}</a></h4>
                                                @if($pag->id==($cat->recent_3_public_pages())[0]['id'])
                                                <small><a href="single.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                                <small><a href="{{ route('showArticles',['search'=>$pag->author->id, 'name'=>$pag->author->name]) }}" title="">BY {{ $pag->author->name }}</a></small>
                                                @endif
                                            </div><!-- end meta -->
                                        </div><!-- end shadow-desc -->
                                    </div><!-- end shadow -->
                                </div><!-- end post-media -->
                            @endforeach
                        @endif              
                </div><!-- end right-side --> 
            @endforeach
        </div><!-- end masonry -->
    </div>
</section>