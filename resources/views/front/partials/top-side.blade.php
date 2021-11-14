<body>

    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="/front/images/loader.gif" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form class="form-inline" action="{{ route('showArticles') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control" placeholder="What you are looking for?" name="search">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                        <div class="topsocial">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Flickr"><i class="fa fa-flickr"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus"></i></a>
                        </div><!-- end social -->
                    </div><!-- end col -->

                    <div class="col-lg-4">
                            <div class="logo text-center">
                                <a href="{{ route('homePage') }}"><h1 id="tehnium"><span>[ </span>TEHNIUM<span> ]</span></h1></a>
                            </div><!-- end logo -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->

        <header class="header">
            <div class="container">
                <nav class="navbar navbar-inverse navbar-toggleable-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#cloapediamenu" aria-controls="cloapediamenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center" id="cloapediamenu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link color-pink-hover" href="{{ route('homePage') }}"><i class="fa fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                                <ul class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                                    <li>
                                        <div class="mega-menu-content clearfix">
                                            <div class="tab">
                                                @foreach ($categories as $category)
                                                    
                                                <button class="tablinks @if($category->id == $categories[0]['id']) active @endif" onclick="openCategory(event, '{{ $category->id }}')">{{ $category->title }}</button>

                                                @endforeach
                                            </div>
                                            
                                            <div class="tab-details clearfix">
                                                @foreach ($categories as $category)

                                                <div id="{{ $category->id }}" class="tabcontent @if($category->id == $categories[0]['id']) active @endif">
                                                    <div class="row">

                                                    @foreach($category->recent_5_public_pages() as $page)    
                                                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="blog-box">
                                                                <div class="post-media">
                                                                    <a href="{{ route('article',['article'=>$page->slug]) }}" title="">
                                                                        <img src="/admin/images/articles/{{ $page->photo }}" alt="" class="img-fluid">
                                                                        <div class="hovereffect">
                                                                        </div><!-- end hover -->
                                                                        <span class="menucat">{{ $category->title }}</span>
                                                                    </a>
                                                                </div><!-- end media -->
                                                                <div class="blog-meta">
                                                                    <h4><a href="{{ route('article',['article'=>$page->slug]) }}" title="">{{ $page->title }}</a></h4>
                                                                </div><!-- end meta -->
                                                            </div><!-- end blog-box -->
                                                        </div>
                                                    @endforeach
                                                        
                                                    </div><!-- end row -->
                                                </div> 
                                                
                                                @endforeach  
                                            </div><!-- end tab-details -->

                                            

                                        </div><!-- end mega-menu-content -->
                                    </li>
                                </ul>
                            </li>                          
                            <li class="nav-item">
                                <a class="nav-link color-pink-hover" href="{{ route('showNews') }}">News</a>
                            </li>

                            @foreach ($categories as $category)
                                
                            <li class="nav-item">
                                <a class="nav-link color-red-hover" href="{{ route('category',$category->slug) }}">{{ $category->title }}</a>
                            </li>

                            @endforeach

                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('showContact') }}">Contact</a>
                            </li>

    <!--                   <li class="nav-item dropdown has-submenu">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gaming</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown02">
                                    <li><a class="dropdown-item" href="blog-author.html">PC</a></li>
                                    <li><a class="dropdown-item" href="page-contact.html">Console</a></li>
                                    <li><a class="dropdown-item" href="page.html">Mobile</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="blog-category-04.html">Internet</a>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link color-yellow-hover" href="blog-category-05.html">Science</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-grey-hover" href="blog-category-06.html">Auto</a>
                            </li> -->

                        </ul>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->