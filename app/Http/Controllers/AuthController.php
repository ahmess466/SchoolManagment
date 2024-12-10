<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');


            }

            elseif(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');


            }
            elseif(Auth::user()->user_type == 3){

                return redirect('student/dashboard');

            }
            elseif(Auth::user()->user_type == 4){

                return redirect('parent/dashboard');

            }


        }
        return view('auth.login');
    }
    public function Authlogin(Request $request){
        $remember = !empty($request->remember)? true : false ;
        if(Auth::attempt(['email'=>$request->email ,'password'=>$request->password],$remember)){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');


            }

            elseif(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');


            }
            elseif(Auth::user()->user_type == 3){

                return redirect('student/dashboard');

            }
            elseif(Auth::user()->user_type == 4){

                return redirect('parent/dashboard');

            }
        }
        else{
            return redirect()->back()->with('error','Please Enter Valid Email Or Password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function forgotpassword(){
        return view('auth.forgot');


    }
    public function PostForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){
            $user-> remember_token = Str::random(30);
            $user->save();
            Mail::to($user ->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success','Please Check Your email and reset your password');

        }
        else{
            return redirect()->back()->with('error','Sorry Email Not Found');
        }
    }
}
