<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Page extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['title',
                        'created_at',
                        'view'];

     protected $casts = [
                            'published_at' => 'datetime',
                        ];
    
    public function author(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_page','page_id','category_id');
    }
    
    public function getExcerpt($str, $startPos=0, $maxLength=150) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= '...';
        } else {
            $excerpt = $str;
        }
        
        return $excerpt;
    }

    public function photos(){
        return $this->hasMany(Photo::class, 'page_id')->orderBy('position')->paginate(12)->withQueryString();;
    }

    public function messages(){
        return $this->hasMany(Message::class, 'page_id')->orderByDesc('created_at')->paginate(5)->withQueryString();
    }

}
