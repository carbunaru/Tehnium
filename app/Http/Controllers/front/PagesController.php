<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Http\Requests\MessageRequest;

class PagesController extends Controller
{
    public function homePage(){
        return view('front.home');
    }

    public function categoryPage(Category $category){

        if($category->publish==1){
        $category->view ++;
        $category->save(); 
         
        return view('front.category-page')
            ->with('category',$category);
        }
        return redirect(route('homePage'));
    }

    public function articlePage(Page $article){

        if($article->published_at!=null){
            $article->view ++;
            $article->save();

        $keywords=explode(' ',$article->meta_keywords);

        $cat=$article->categories[0];

        $arts=$cat->published_at_same($article);

        if($arts->count()>1){
        
                if($article->id == $arts->max('id')){
                    $next_art=$cat->next_public_page_cat($article)->first();
                    $prev_art=$arts->orderByDesc('id')->where('id','<',$article->id)->first();
                }elseif($article->id == $arts->min('id')){
                    $next_art=$arts->orderBy('id')->where('id','>',$article->id)->first();
                    $prev_art=$cat->prev_public_page_cat($article)->first();
                }else{
                    $next_art=$article->categories[0]->published_at_same($article)->where('id','>',$article->id)->orderBy('id')->first();
                    $prev_art=$article->categories[0]->published_at_same($article)->where('id','<',$article->id)->orderByDesc('id')->first();
                }
        }else{
            $prev=$cat->prev_public_page_cat($article)->first();
            $next=$cat->next_public_page_cat($article)->first();
            if($prev!=null && $prev->categories[0]->published_at_same($prev)->count()>1){
                $prev_art=$prev->categories[0]->published_at_same($prev)->orderByDesc('id')->first();
                $next_art=$cat->next_public_page_cat($article)->first();
            }elseif($next!=null && $cat->published_at_same($next)->count()>1){
                $prev_art=$cat->prev_public_page_cat($article)->first();
                $next_art=$next->categories[0]->published_at_same($next)->orderBy('id')->first();
            }else{
               $prev_art=$prev;
               $next_art=$next; 
            }
            
        }
      
        return view('front.article-page')
            ->with('article',$article)
            ->with('next_art',$next_art)
            ->with('prev_art',$prev_art)
            ->with('keywords',$keywords);
        }

        return redirect(route('homePage'));
    }

    public function showArticles(){  

        if(request('name')){

            $name=request('name');
            $search=request('search');

            $pages=Page::sortable(['published_at'=>'desc'])
                ->where('published_at','<>',null)
                ->where('user_id','LIKE',$search)
                ->orderByDesc('published_at')
                ->paginate(12)
                ->withQueryString();

                if($pages->count()>0){
                        return view('front.all_articles')->with('pages',$pages)->with('search',$search)->with('name',$name);
                }else{

                    $error='No article found!';
                    return view('front.all_articles')->with('error',$error)->with('pages',$pages)->with('search',$search);    
                }

        }elseif(request('name')==null && request('search')==null){

            $pages=Page::sortable(['published_at'=>'desc'])
                ->where('published_at','<>',null)
                ->orderByDesc('published_at')
                ->paginate(12)
                ->withQueryString();  

            return view('front.all_articles')->with('pages',$pages); 
        }else{

            $search=request('search');

            $pages=Page::sortable(['published_at'=>'desc'])
                ->where('published_at','<>',null)
                ->where(function($query){
                    $search=request('search');
                    $query->where('title','LIKE',"%{$search}%")
                            ->orWhere('subtitle','LIKE',"%{$search}%")
                            ->orWhere('meta_title','LIKE',"%{$search}%")
                            ->orWhere('meta_description','LIKE',"%{$search}%");
                })
                ->orderByDesc('published_at')
                ->paginate(12)
                ->withQueryString(); 

                if($pages->count()>0){
                    return view('front.all_articles')->with('pages',$pages)->with('search',$search);
                }else{

                    $error='No article found!';
                    return view('front.all_articles')->with('error',$error)->with('pages',$pages)->with('search',$search);    
                }

        }


        
    }

    public function addComment(MessageRequest $request, $id){

        $page=Page::findOrFail($id);

        if(isset(auth()->user()->id)){

        $message=new Message;

        $message->title=$request->title;
        $message->content=$request->content;
        $message->user_id=auth()->user()->id;
        $message->page_id=$id;

        $message->save();

        return redirect(route('article',['article'=>$page->slug]))->with('status','You must be logged in to [T]-app to post a comment!');

        }else{
        
        return redirect(route('article',['article'=>$page->slug]))->with('err_mess','You must be logged in to [T]-app to post a comment!');
        }

    }

    public function showContact(){
        $contact_user=User::findOrFail(config('custom-contact.contact_user_id'));
        $contact_art=Page::findOrFail(config('custom-contact.contact_art_id'));
        return view('front.contact')->with('contact_user',$contact_user)->with('contact_art',$contact_art);
    }

}
