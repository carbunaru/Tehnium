<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function pages(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id');
    }

    public function public_pages(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->orderByDesc('published_at')
                    ->paginate(10)
                    ->withQueryString();
    }

    public function recent_4_public_pages($article){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->where('id','<>',$article->id)
                    ->orderByDesc('published_at')
                    ->paginate(4)
                    ->withQueryString();
    }

    public function recent_5_public_pages(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->orderByDesc('view')
                    ->limit(4)
                    ->get();
    }

    public function recent_3_public_pages(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->orderByDesc('published_at')
                    ->limit(3)
                    ->get();
    }

    public function recent_3_public_pages_off(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->orderByDesc('published_at')
                    ->skip(3)
                    ->take(3)
                    ->get();
    }

    public function recent_2_public_pages(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->orderByDesc('published_at')
                    ->limit(2)
                    ->get();
    }

    public function recent_2_public_pages_off(){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->orderByDesc('published_at')
                    ->skip(3)
                    ->take(2)
                    ->get();
    }

    public function published_at_same($article){
        return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                    ->where('published_at','<>',null)
                    ->where('published_at',$article->published_at);
                    
    }

    public function prev_public_page_cat($article){
         return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                     ->where('published_at','<>',null)
                     ->where('published_at', '>', $article->published_at)
                     ->orderBy('published_at');
                    
                    
                    
     }

    public function next_public_page_cat($article){
         return $this->belongsToMany(Page::class,'category_page','category_id','page_id')
                     ->where('published_at','<>',null)
                     ->where('published_at', '<', $article->published_at)
                     ->orderByDesc('published_at');
                     
     }
}
