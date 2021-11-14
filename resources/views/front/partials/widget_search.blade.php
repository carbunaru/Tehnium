<div class="widget">
    <h2 class="widget-title">Search</h2>
    <form class="form-inline search-form" action="{{ route('showArticles') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search on the site" name="search">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>
</div><!-- end widget -->