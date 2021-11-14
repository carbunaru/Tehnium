<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Message extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['title',
                        'created_at'];

    public function mess_author(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function mess_article(){

        return $this->belongsTo(Page::class, 'page_id');
    }
}
