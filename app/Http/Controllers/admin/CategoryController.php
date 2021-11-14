<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAddRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function showCategories(){
        
        $categories=Category::all()->sortBy('title');
        return view('admin.categories.categories')->with('categories', $categories);
    }
    
    public function newCategoryForm(){

        if (! Gate::allows('author-rights')) {
            return redirect(route("admin-categories"))->with("err", "You don't have the right to perform this action!");
        }

        return view('admin.categories.category_new');
    }

    public function addCategoryForm(CategoryAddRequest $request){

        if (! Gate::allows('author-rights')) {
            return redirect(route("admin-categories"))->with("err", "You don't have the right to perform this action!");
        }

        $this->validate($request,
        
        [
            'slug'=>'unique:categories,slug'
        ],

        [
            'slug.unique'=>'The slug must be unique'
        ]

        );
        
        $category=new Category;
        $category->title=$request->title;
        $category->subtitle=$request->subtitle;
        $category->slug=Str::slug($request->slug);
        $category->excerpt=$request->excerpt;
        $category->view=$request->view;

        $category->position=$request->position;
        $category->publish=$request->publish;
        
        $category->meta_title=$request->meta_title;
        $category->meta_description=$request->meta_description;
        $category->meta_keywords=$request->meta_keywords;
        
        if($request->hasFile('photo')){
            $extension=$request->file('photo')->getClientOriginalExtension();
            $photoName=str_replace(' ', '', $request->title).'_'.time().'.'.$extension;

            $request->file('photo')->move('admin/images/categories', $photoName);
            $category->photo=$photoName;
        }

        $category->save();
        
        return redirect(route('admin-categories'))->with('success','<strong>'.$category->title.'</strong> has been successfully added!');
    }

    public function editCategoryForm($id){

        $category=Category::findOrFail($id);
        return view('admin.categories.category_edit')->with('category', $category);
    }

    public function updateCategoryForm(CategoryAddRequest $request, $id){

        $this->validate($request,
        
        [
            'slug'=>'unique:categories,slug,'.$id
        ],

        [
            'slug.unique'=>'The slug must be unique'
        ]

        );
        
        $category=Category::findOrFail($id);

        $category->title=$request->title;
        $category->subtitle=$request->subtitle;
        $category->slug=Str::slug($request->slug);
        $category->excerpt=$request->excerpt;
        $category->view=$request->view;

        $category->position=$request->position;
        $category->publish=$request->publish;
        
        $category->meta_title=$request->meta_title;
        $category->meta_description=$request->meta_description;
        $category->meta_keywords=$request->meta_keywords;
        
        if($request->hasFile('photo')){

            if(!($category->photo=='category.jpg')){
                File::delete('admin/images/categories/'.$category->photo);
            }  

            $extension=$request->file('photo')->getClientOriginalExtension();
            $photoName=str_replace(' ', '', $request->title).'_'.time().'.'.$extension;

            $request->file('photo')->move('admin/images/categories', $photoName);
            $category->photo=$photoName;
        }

        $category->save();
        
        return redirect(route('admin-categories'))->with('success','<strong>'.$category->title.'</strong> has been successfully updated!');
    }

    public function deleteCategoryForm(Request $request, $id){

        if (! Gate::allows('admin-rights')) {
            return redirect(route("admin-categories"))->with("err", "You don't have the right to perform this action!");
        }

        $category=Category::findOrFail($id);

        if(!($category->photo=='category.jpg')){
            File::delete('admin/images/categories/'.$category->photo);
            }
        $category->pages()->detach();    
        $category->delete();
        return redirect(route("admin-categories"))->with("success","The <strong>".ucfirst($category->title)."</strong> category  has been successfully deleted!");    
    }

    public function showContact(){

        return view('admin.contact-page');
    }


}

