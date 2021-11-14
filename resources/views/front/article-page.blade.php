@extends('front.template')

@section('customCSS')

<link href="/admin/assets/gallery/magnific.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="{{ route('homePage') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('category',['category'=>$article->categories[0]->slug]) }}">{{ $article->categories[0]->title }}</a></li>
                            <li class="breadcrumb-item active">{{ $article->title }}</li>
                        </ol>

                        <span class="color-aqua"><a href="blog-category-01.html" title="">{{ $article->categories[0]->title }}</a></span>

                        <h3>{{ $article->title }}</h3>

                        <div class="blog-meta big-meta">
                            <small><a href="single.html" title="">{{ $article->published_at->format('d M Y') }}</a></small>
                            <small><a href="{{ route('showArticles',['search'=>$article->author->id, 'name'=>$article->author->name]) }}" title="">by {{ $article->author->name }}</a></small>
                            <small><a href="#" title=""><i class="fa fa-eye"></i> {{ $article->view }}</a></small>
                        </div><!-- end meta -->

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div><!-- end post-sharing -->
                    </div><!-- end title -->

                    <div class="single-post-media">
                        <img src="/admin/images/articles/{{ $article->photo }}" alt="" class="img-fluid">
                    </div><!-- end media -->

                    <div class="blog-content">  
                        <div class="pp">

                            {!! $article->presentation !!}      
                              
                        </div><!-- end pp -->

                        <div class="pp">
                            <h3><strong>{{ $article->subtitle }} </strong></h3>

                            {!! $article->content !!}

                        </div><!-- end pp -->
                    </div><!-- end content -->

                    <div class="row">
                        @if($article->photos()->total()>0)
                            @foreach($article->photos() as $photo)
                                <div class="zoom-gallery col-md-2 d-flex flex-column justify-content-between">
                                    <a class="magnific-gallery" href="{{ $photo->photo_url() }}">
                                    <img class="photo img mb-2" src="{{ $photo->photo_url() }}" alt="">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                        <div class="gallery_link ml-3">{{ $article->photos()->links() }}</div>

                    </div>

                    <div class="blog-title-area">
                        <div class="tag-cloud-single row">
                            <div class="col-md-1"><span>Tags</span></div>
                            <div class="col-md-11 mt-2 pl-4">
                                @foreach($keywords as $kw)
                                    <small><a class="pl-0" href="{{ route('showArticles',['search'=>$kw])}}" title="">{{ $kw }}</a></small>
                                @endforeach
                            </div>
                        </div><!-- end meta -->

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div><!-- end post-sharing -->
                    </div><!-- end title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <hr class="invis1">

                    <div class="custombox prevnextpost clearfix">
                        <div class="row">
                            @if($prev_art!=null)
                                <small class="col-md-6 m-0"><a href="{{ route('article',$prev_art->slug) }}"><i class="fa fa-angle-double-left"></i> Prev Post</a></small>
                            @endif
                            @if($next_art!=null)              
                                <small class="col-md-6 text-right m-0"><a href="{{ route('article',$next_art->slug) }}">Next Post <i class="fa fa-angle-double-right"></i></a></small>
                            @endif
                        </div>
                        <div class="row">
                            
                            @if($prev_art!=null)
                                <div class="col-lg-6">
                                    <div class="blog-list-widget">
                                        <div class="list-group">
                                            <a href="{{ route('article',$prev_art->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="w-100 justify-content-between text-right">
                                                    <img src="/admin/images/articles/{{ $prev_art->photo }}" alt="" class="img-fluid float-right">
                                                    <h5 class="mb-1">{{ $prev_art->title }}</h5>                                
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            @endif    

                            @if($next_art!=null)
                                <div class="col-lg-6">
                                    <div class="blog-list-widget">
                                        <div class="list-group">
                                            <a href="{{ route('article',$next_art->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="w-100 justify-content-between">
                                                    <img src="/admin/images/articles/{{ $next_art->photo }}" alt="" class="img-fluid float-left">
                                                    <h5 class="mb-1">{{ $next_art->title }}</h5>                                                  
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            @endif
                        </div><!-- end row -->
                    </div><!-- end author-box -->

                    <hr class="invis1">

                    <div class="custombox authorbox clearfix">
                        <h4 class="small-title">About author</h4>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <img src="/admin/images/users/{{ $article->author->photo }}" alt="" class="img-fluid rounded-circle"> 
                            </div><!-- end col -->

                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <h4><a href="{{ route('showArticles',['search'=>$article->author->id, 'name'=>$article->author->name]) }}">{{ $article->author->name }}</a></h4>
                                <p>Quisque sed tristique felis. Lorem <a href="#">visit my website</a> amet, consectetur adipiscing elit. Phasellus quis mi auctor, tincidunt nisl eget, finibus odio. Duis tempus elit quis risus congue feugiat. Thanks for stop Cloapedia!</p>

                                <div class="topsocial">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                                </div><!-- end social -->

                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end author-box -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">You may also like</h4>
                        <div class="row">
                            @foreach($article->categories[0]->recent_4_public_pages($article) as $like)
                                <div class="col-lg-6 mb-3">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="{{ route('article',$like->slug) }}" title="">
                                                <img src="/admin/images/articles/{{ $like->photo }}" alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                    <span class=""></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta">
                                            <h4><a href="{{ route('article',$like->slug) }}" title="">{{ $like->title }}</a></h4>
                                            <small><a href="{{ route('category',$article->categories[0]->slug) }}" title="">{{ $article->categories[0]->title }}</a></small>
                                            <small><a href="" title="">{{ $like->published_at->format('d M Y') }}</a></small>
                                            <small><a href="{{ route('showArticles',['search'=>$like->author->id,'name'=>$like->author->name]) }}" title="">by  {{ $like->author->name }}</a></small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->
                            @endforeach
                            
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">{{ $article->messages()->total() }} Comments</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list">

                                    @foreach ( $article->messages() as $message)

                                        <div class="media">
                                            <a class="media-left" href="{{ route('showArticles',['search'=>$message->mess_author->id,'name'=>$message->mess_author->name]) }}">
                                                <img src="/admin/images/users/{{ $message->mess_author->photo }}" alt="" class="rounded-circle" width="60">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{ route('showArticles',['search'=>$message->mess_author->id,'name'=>$message->mess_author->name]) }}"><h4 class="media-heading user_name">{{ $message->mess_author->name }} <small>{{ $message->created_at->format('d M Y') }}</small></h4></a>
                                                <strong class="media-heading user_name text-dark">{{ ucfirst($message->title) }}</strong>
                                                <p>{{ $message->content }}</p>
                                                <a href="#" class="btn btn-primary btn-sm">Replay</a>
                                                
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                    
                                   
                                    {{-- <div class="media last-child">
                                        <a class="media-left" href="#">
                                            <img src="upload/author_02.jpg" alt="" class="rounded-circle">
                                        </a>
                                        <div class="media-body">

                                            <h4 class="media-heading user_name">Marie Johnson <small>5 days ago</small></h4>
                                            <p>Kickstarter seitan retro. Drinking vinegar stumptown yr pop-up artisan sunt. Deep v cliche lomo biodiesel Neutra selfies. Shorts fixie consequat flexitarian four loko tempor duis single-origin coffee. Banksy, elit small.</p>

                                            <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">Leave a Comment</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <form action="{{ route('addComment', $article->id) }}" method="post" class="form-wrapper">
                                    @csrf
                                    
                                    <span class="text-danger small">{{session('err_mess')}}</span>
                                    
                                    <input type="text" class="form-control mb-0 mt-2" placeholder="Title" name="title">
                                    @error('title') <span class="text-danger small">{{$message}}</span> @enderror 
                                    <textarea class="form-control mb-0 mt-2" placeholder="Your comment" name="content"></textarea>
                                    @error('content') <span class="text-danger small">{{$message}}</span> @enderror<br> 
                                    <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>

                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    @include('front.partials.widget_search')

                    @include('front.partials.widget_recent_post')

                    @include('front.partials.advert-sidebar')

                    @include('front.partials.widget_popular_categories')

                    @include('front.partials.widget_popular_posts')

                </div><!-- end sidebar -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

@endsection

@section('customJS')

<script src="/admin/assets/gallery/magnific.js"></script>

<script>
  $(document).ready(function () {


    $('.zoom-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
		
	});
  
  })


</script>

@endsection