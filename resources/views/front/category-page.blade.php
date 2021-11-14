@extends('front.template')


@section('content')
    
<div class="page-title wb">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h2>
                    @if($category->slug == "tech")
                    <i class="fa fa-microchip"></i>
                    @elseif($category->slug == "gaming")
                    <i class="fa fa-gamepad"></i>
                    @elseif($category->slug == "auto")
                    <i class="fa fa-car"></i>
                    @elseif($category->slug == "internet")
                    <i class="fa fa-wifi"></i>
                    @elseif($category->slug == "science")
                    <i class="fa fa-flask"></i>
                    @else
                    <i class="fa fa-list-ul"></i>
                    @endif
                    {{ $category->title }} <small>({{ $category->public_pages()->total() }} articles)</small>
                </h2>
            </div><!-- end col -->
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"><small class="hidden-xs-down hidden-sm-down">{{ $category->subtitle }}</small></div><!-- end col --> 
            <div class="col-lg-2 col-md-2 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li><i class="fa fa-eye" style="background-color: #fff; font-size:20px;color:#5e5e5e !important;"></i>{{ $category->view }}</li>
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ $category->title }}</li>
                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section wb">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    @include('front.partials.widget_search')

                    @include('front.partials.widget_recent_post')

                    @include('front.partials.advert-sidebar')

                    @include('front.partials.widget_instagram_feed')

                    @include('front.partials.widget_popular_categories')

                    @include('front.partials.widget_popular_posts')

                </div><!-- end sidebar -->
            </div><!-- end col -->

            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">

                <div class="page-wrapper">

                    @include('front.partials.carousel_articles')

                    @include('front.partials.advert')

                    <hr class="invis">

                    <div class="portfolio row">

                        @foreach($category->public_pages() as $article)
                            <div class="pitem item-w1 item-h1">
                                <div class="blog-box custom-img">
                                    <div class="post-media">
                                        <a href="{{ route('article',['article'=>$article->slug]) }}" title="">
                                            <img src="/admin/images/articles/{{ $article->photo }}" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta">
                                        <span class="bg-pink"><a href="{{ route('category',$category->slug) }}" title="">{{ ucfirst($category->title) }}</a></span>
                                        <h4><a href="{{ route('article',['article'=>$article->slug]) }}" title="">{{ ucfirst($article->title) }}</a></h4>
                                        <small><a href="{{ route('showArticles',['search'=>$article->author->id, 'name'=>$article->author->name]) }}" title="">By: {{ $article->author->name }}</a></small>
                                        <small><a href="" title="">{{ $article->published_at->format('d M Y') }}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                        @endforeach
                        
                    </div><!-- end portfolio -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            {{$category->public_pages()->links()}}
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

@endsection