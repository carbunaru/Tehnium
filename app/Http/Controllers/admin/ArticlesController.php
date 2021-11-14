<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleAddRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class ArticlesController extends Controller
{
    public function showArticles(){

        $categories=Category::select('id','title','position')->orderBy('position')->get();

        if(request('search')){

            $search=request('search');

          
            $pages=Page::sortable(['created_at'=>'desc'])
                ->where('title','LIKE',"%{$search}%")
                ->orWhere('subtitle','LIKE',"%{$search}%")
                ->orWhere('meta_title','LIKE',"%{$search}%")
                ->orWhere('meta_description','LIKE',"%{$search}%")->paginate()->withQueryString();
                
                return view('admin.articles.article')->with('pages',$pages)->with('search',$search)->with('categories',$categories);
                
        }
        
        if(request('author')){

            $pages=Page::sortable(['created_at'=>'desc'])->where('user_id',request('author'))->paginate()->withQueryString();
            $author_name=User::findOrFail(request('author'))->name;
            return view('admin.articles.article')->with('pages',$pages)->with('author_name',$author_name)->with('categories',$categories);
        }

        if(request('published') == 1){
            $pages=Page::sortable(['created_at'=>'desc'])->where('published_at','<>',null)->paginate()->withQueryString();
            $published_title=' Published ';
            return view('admin.articles.article')->with('pages',$pages)->with('published_title',$published_title)->with('categories',$categories);
        }

        if(request('published') == 2){
            $pages=Page::sortable(['created_at'=>'desc'])->where('published_at',null)->paginate()->withQueryString();
            $published_title=' Draft ';
            return view('admin.articles.article')->with('pages',$pages)->with('published_title',$published_title)->with('categories',$categories);
        }

        if(request('categories')){
            $category=Category::findOrFail(request('categories'));
            $pages=$category->pages()->sortable(['created_at'=>'desc'])->paginate()->withQueryString();
            $cat_title=$category->title;

            return view('admin.articles.article')->with('pages',$pages)->with('categories',$categories)->with('cat_title',$cat_title);
        }

        $pages=Page::sortable(['created_at'=>'desc'])->paginate()->withQueryString();
        return view('admin.articles.article')->with('pages',$pages)->with('categories',$categories);
    }

    public function newArticles(){

        if(auth()->user()->role=='admin'){

            $authors=User::select('id','name')->where('role','author')->orderBy('name')->get();
            return view('admin.articles.article-new')->with('authors',$authors);
        }

        return view('admin.articles.article-new');
    }

    public function addArticles(ArticleAddRequest $request){

        if (! Gate::allows('author-rights')) {
            return redirect(route("admin.showArticles"))->with("err", "You don't have the right to perform this action!");
        }

        $this->validate($request,
        
        [
            'slug'=>'unique:pages,slug'
        ],

        [
            'slug.unique'=>'The slug must be unique'
        ]

        );

        $page=new Page;
        $page->title=$request->title;
        $page->subtitle=$request->subtitle;
        $page->slug=Str::slug($request->slug);
        $page->excerpt=$request->excerpt;
        $page->presentation=$request->presentation;
        $page->content=$request->content;

        $page->view=$request->view;

        if($request->publish==1){

            $page->published_at=$request->published_at;
        }else{
            $request->published_at=null;
        }

        //==Setare autor articol==

        if(auth()->user()->role=='author'){
            $page->user_id=auth()->id();
        }

        if(auth()->user()->role=='admin'){
            $page->user_id=$request->published_by;
        }

        $page->meta_title=$request->meta_title;
        $page->meta_description=$request->meta_description;
        $page->meta_keywords=$request->meta_keywords;
        
        if($request->hasFile('photo')){
            $extension=$request->file('photo')->getClientOriginalExtension();
            $photoName=str_replace(' ', '', $request->title).'_'.time().'.'.$extension;

            $request->file('photo')->move('admin/images/articles', $photoName);
            $page->photo=$photoName;
        }

        $page->save();
        
        return redirect(route('admin.showArticles'))->with('success','The aticle titled "<strong>'.$page->title.'</strong>" has been successfully added!');
    }

    public function editArticles($id){

        $page=Page::findOrFail($id);

        if(auth()->user()->role=='admin'){

            $authors=User::select('id','name')->where('role','author')->orderBy('name')->get();
            return view('admin.articles.article-edit')->with('authors',$authors)->with('page',$page);
        }

        return view('admin.articles.article-edit')->with('page',$page);

    }

    public function updateArticles(ArticleAddRequest $request, $id){

        $this->validate($request,
        
        [
            'slug'=>'unique:pages,slug,'.$id
        ],

        [
            'slug.unique'=>'The slug must be unique'
        ]

        );

        $page=Page::findOrFail($id);

        $page->title=$request->title;
        $page->subtitle=$request->subtitle;
        $page->slug=Str::slug($request->slug);
        $page->excerpt=$request->excerpt;
        $page->presentation=$request->presentation;
        $page->content=$request->content;

        $page->view=$request->view;

        if($request->publish==1){

            $page->published_at=$request->published_at;
        }else{
            $page->published_at=null;
        }

        if($request->hasFile('photo')){

            if(!($page->photo=='article.jpg')){
                File::delete('admin/images/articles/'.$page->photo);
            }  

            $extension=$request->file('photo')->getClientOriginalExtension();
            $photoName=str_replace(' ', '', $request->title).'_'.time().'.'.$extension;

            $request->file('photo')->move('admin/images/articles', $photoName);
            $page->photo=$photoName;
        }

        //==Setare autor articol==

        

        if(auth()->user()->role=='admin'){
            $page->user_id=$request->published_by;
        }

        $page->meta_title=$request->meta_title;
        $page->meta_description=$request->meta_description;
        $page->meta_keywords=$request->meta_keywords;

        $page->save();
        
        return redirect(route('admin.showArticles'))->with('success','The aticle titled "<strong>'.$page->title.'</strong>" has been successfully updated!');
    }

    public function showCategoriesArticles($id){

        $page=Page::findOrFail($id);
        $categories=Category::select('id','title')->orderBy('title')->get();
        return view('admin.articles.article-modal')->with('page',$page)->with('categories',$categories);
    }

    public function setCategoriesArticles(Request $request, $id){

        $page=Page::findOrFail($id);
        $page->categories()->sync($request->categs);
        return redirect(route('admin.showArticles'))->with('success','The categories for '.$page->title.' has been set successfully!');
    }

    public function deleteArticles($id){

        if (! Gate::allows('admin-rights')) {
            return redirect(route("admin.showArticles"))->with("err", "You don't have the right to perform this action!");
        }

        $page=Page::findOrFail($id);

        if(!($page->photo=='article.jpg')){
            File::delete('admin/images/articles/'.$page->photo);
            }

        if($page->photos()->count()>0){
            File::deleteDirectory('admin/images/gallery/'.$page->id);
        }

        $page->categories()->detach();    
        $page->delete();

        return redirect(route("admin.showArticles"))->with("success","The <strong class='text-info'>".ucfirst($page->title)."</strong> article  has been successfully deleted!");
    }

}
