<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function showComments($id){
        $page=Page::findOrFail($id);

        if(request('author')){
            $messages=Message::sortable(['created_at'=>'desc'])->where('user_id',request('author'))->paginate()->withQueryString();
            $author_name=User::findOrFail(request('author'))->name;

            return view('admin.comments.comments')->with('messages',$messages)->with('page',$page)->with('author_name',$author_name);
        }else{
            
            $messages=$page->messages();

            return view('admin.comments.comments')->with('messages',$messages)->with('page',$page);
        }
    }

    public function deleteComment($id){
        $message=Message::findOrFail($id);
        $message->delete();

        return back()->with("success","The comment has been successfully deleted!");    
    }
}
