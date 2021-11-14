<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile(){

            $user=User::findOrFail(auth()->user()->id);
    
        return view('admin/user-profile')->with('user',$user);
    }

    public function updateProfile(UpdateUserRequest $request){

            $this->validate($request,
            
            [
                'email'=>'unique:users,email,'.auth()->user()->id
            ],

            [
                'email.unique'=>'The email address must be unique'
            ]

            );

            $user=User::findOrFail(auth()->user()->id);

            if($request->hasFile('photo')){

                if(!($user->photo=='default.jpg')){
                    File::delete('admin/images/users/'.$user->photo);
                }    

                $extension=$request->file('photo')->getClientOriginalExtension();
                $photoName=str_replace(' ', '', $request->name).'_'.time().'.'.$extension;

                $request->file('photo')->move('admin/images/users', $photoName);
                $user->photo=$photoName;
            }

            $user->name=$request->name;
            $user->email=$request->email;
            $user->address=$request->address;
            $user->phone=$request->phone;

            $user->save();
            return redirect(route("dashboard"))->with("success","<strong>".auth()->user()->name."</strong>'s profile has been successfully updated!");
    }

    public function resetPassword(ResetPasswordRequest $request){

        if(Auth::attempt(['email'=>auth()->user()->email, 'password'=>$request->password_old])){
            //se creaza noua parola criptata
            $newPassword=bcrypt($request->password_new);
            $user=User::findOrFail(auth()->user()->id);
            $user->password=$newPassword;

            $user->save();
            return redirect(route('dashboard'))->with('success','The password has been successfully reset!');;
        }

    }
}
