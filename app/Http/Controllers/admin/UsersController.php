<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UsersController extends Controller{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showUsers(){
        $users=User::all()->sortBy('name');
        return view('admin.users')->with('users',$users);
    }

    public function newUser(){
        
        return view('admin.user-new');
    }

    public function addUser(CreateUserRequest $request){

        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->address=$request->address;
        $user->phone=$request->phone;
        $user->role=$request->role;
        $user->password=bcrypt($request->password);
        
        if($request->hasFile('photo')){
            $extension=$request->file('photo')->getClientOriginalExtension();
            $photoName=str_replace(' ', '', $request->name).'_'.time().'.'.$extension;

            $request->file('photo')->move('admin/images/users', $photoName);
            $user->photo=$photoName;
        }

        $add_mess=" His email address is not verified.";

        if($request->verified==1){
            $user->email_verified_at=now();
            $add_mess=" His email address is verified.";
        }

        $user->save();
        
        return redirect(route('users'))->with('success','<strong>'.$user->name.'</strong> has been successfully added!'.$add_mess);
    }

    public function showEditUser($id){

        $user=User::findOrFail($id);
        return view('admin.user-edit')->with('user', $user);
    }

    public function updateUser(UpdateUserRequest $request, $id){

        $this->validate($request,
        
        [
            'email'=>'unique:users,email,'.$id
        ],

        [
            'email.unique'=>'The email address must be unique'
        ]

        );

        $user=User::findOrFail($id);

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
        $user->role=$request->role;

        //Verificare email
        $add_mess="";

        if($request->checkEmail=='validate'){
            $user->email_verified_at=now(); 
            $add_mess="and the email address has been validated";   
        }
        if($request->checkEmail=='invalidate'){
            $user->email_verified_at=null;
            $add_mess=" and the email address has been invalidated";
        }
        if($request->checkEmail=='send'){
            $user->sendEmailVerificationNotification();
            $add_mess=" and a verification email was sent";
        }

        $user->save();
        return redirect(route("users"))->with("success","<strong>".$user->name."</strong>'s profile has been successfully updated".$add_mess."!");
    }

    function deleteUser(Request $request, $id){

        $user=User::findOrFail($id);

        if(!($user->photo=='default.jpg')){
            File::delete('admin/images/users/'.$user->photo);
            }    

        $user->delete();
        return redirect(route("users"))->with("success","<strong>".$user->name."</strong>'s profile has been successfully deleted!");
    }
}
