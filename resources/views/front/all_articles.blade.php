@extends('front.template')


@section('content')

<div class="page-title wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            @if(isset($search) && !isset($name))
                <h2><i class="fa fa-search"></i> Search  <small>({{ $pages->total() }} articles)</small><small class="hidden-xs-down hidden-sm-down">All articles that contain '<strong class="text-info">{{ $search }}</strong>' </small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homePage') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Search</a></li>  
            @elseif(isset($name))
                <h2><img src="/admin/images/users/{{ $pages[0]->author->photo }}" alt="" style="max-height:100px;" class="img-fluid rounded-circle">  {{ $name }} <small class="hidden-xs-down hidden-sm-down">({{ $pages->count() }} articles)</small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homePage') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">{{ $name }}</a></li>     
            @else
                <h2><i class="fa fa-rss"></i> News <small>({{ $pages->total() }} articles)</small><small class="hidden-xs-down hidden-sm-down"> - All news, from all categories </small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homePage') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">News</a></li>    
            @endif
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="portfolio row">
                    
                    @if(isset($error))  
                        <p class="text-info font-italic">{{ $error }}</p>
                    @else
                        @foreach($pages as $pag)   

                            <div class="pitem item-w1 item-h1"  style="max-width: 380px">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('article',['article'=>$pag->slug]) }}" title="">
                                            <img src="admin/images/articles/{{ $pag->photo }}" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta">
                                        <span class="bg-grey"><a href="blog-category-01.html" title="">{{ ($pag->categories)[0]->title }}</a></span>
                                        <h4><a href="{{ route('article',['article'=>$pag->slug]) }}" title="">{{ $pag->title }}</a></h4>
                                        <p>
                                        
                                            {!! $pag->getExcerpt($pag->excerpt) !!}
                                        
                                        </p>
                                        <small><a href="{{ route('showArticles',['search'=>$pag->author->id, 'name'=>$pag->author->name]) }}" title="">By: {{ $pag->author->name }}</a></small>
                                        <small><a href="blog-category-01.html" title="">{{ $pag->published_at->format('d M Y') }}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->

                        @endforeach
                    @endif    
                    </div><!-- end portfolio -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            @if(isset($pages))
                                {{$pages->links()}}
                            @elseif(isset($users))
                                {{$users->articles->links()}}
                            @endif
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->

</section>

@endsection

<!-- Core JavaScript
    ================================================== -->
    <script src="/front/js/jquery.min.js"></script>
    <script src="/front/js/tether.min.js"></script>
    <script src="/front/js/bootstrap.min.js"></script>
    <script src="/front/js/masonry.js"></script>
    <script src="/front/js/custom.js"></script>