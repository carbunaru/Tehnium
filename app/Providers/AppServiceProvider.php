<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories=Category::all()->sortBy('position')->where('publish',1);
        View::share('categories',$categories);

        $widget_pages=Page::select('id','title','published_at','user_id','photo','slug')
            ->where('published_at','<>',null)
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();
        View::share('widget_pages',$widget_pages);

        $widget_pages_view=Page::select('id','title','published_at','user_id','photo','view','slug')
            ->where('published_at','<>',null)
            ->orderByDesc('view')
            ->limit(5)
            ->get();
        View::share('widget_pages_view',$widget_pages_view);

        $widget_cats=Category::select('title', 'view','slug')->orderByDesc('view')->get();
        View::share('widget_cats',$widget_cats);
        

        Paginator::useBootstrap();
    }
}
