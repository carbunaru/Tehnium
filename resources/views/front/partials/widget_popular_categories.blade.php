<div class="widget">
    <h2 class="widget-title">Popular Categories</h2>
    <div class="link-widget">
        <ul>
            @foreach($widget_cats as $wc)
                <li><a href="{{ route('category',['category'=>$wc->slug]) }}">{{ $wc->title }} <span>({{ $wc->view }})</span></a></li>
            @endforeach
        </ul>
    </div><!-- end link-widget -->
</div><!-- end widget -->