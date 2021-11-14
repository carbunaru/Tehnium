<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoUploadRequest;
use App\Http\Requests\PhotoUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PhotosController extends Controller
{
    public function showFormPhotos($id){

        $page=Page::findOrFail($id);

        return view('admin.gallery.photos_edit')->with('page',$page);
    }

    public function uploadPhotos(PhotoUploadRequest $request, $id){

        $itr=10;

        $x='x';

        if($request->hasFile('photo')){

            foreach($request->photo as $image){
                $photo=new Photo;

                $extension=$image->getClientOriginalExtension();
                $photoName=$itr.'_'.time().Str::random(5).'.'.$extension;
    
                $image->move('admin/images/gallery/'.$id.'/', $photoName);
                $photo->page_id=$id;
                $photo->position=$itr;
                $photo->file=$photoName;

                $photo->save();

                $itr=$itr+10;
            }

            return back()->with('success','The images were uploaded successfully!')->with('x',$x);

        }
    }

    public function updatePhoto(PhotoUpdateRequest $request,$id){

        $photo=Photo::findOrFail($id);

        if(request('title')){
            $photo->title=$request->title;
        }
        
        if(request('description')){
            $photo->description=$request->description;
        }

        $photo->position=$request->position;

        if(request('publish')){
            $photo->publish=$request->publish;
        }else{
            $photo->publish=0;
        }

        
        if($request->hasFile('photo')){

            if(File::exists($photo->file_path())){
                File::delete($photo->file_path());
            }

            $extension=$request->file('photo')->getClientOriginalExtension();
            $photoName=$request->position.'_'.time().Str::random(5).'.'.$extension;
    
            $request->file('photo')->move('admin/images/gallery/'.$photo->page_id.'/', $photoName); 

            $photo->file=$photoName;
        }

        $photo->save();
        return back()->with('success','The image has been successfully updated!');
    }

    public function deleteAllPhotos($id){

        $page=Page::findOrFail($id);

        if($page->photos()->count()>0){
            foreach($page->photos() as $photo){

                $photo->delete();
            }

            File::deleteDirectory('admin/images/gallery/'.$page->id);

            return back()->with('success','The gallery has been successfully deleted!');
        }
    }

    public function deletePhoto($id){

        $photo=Photo::findOrFail($id);

        if(File::exists($photo->file_path())){
            File::delete($photo->file_path());
        }

        $photo->delete();

        return back()->with('success','The image has been successfully deleted!');
    }
}
