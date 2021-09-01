<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        if($request->isMethod('POST')){
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $data = [
                'email'     => $request->input('email'),
                'password'  => $request->input('password'),
            ];

            Auth::attempt($data);

            if (Auth::check()) {
                return redirect()->route('home');
            } else {
                return redirect()->back()->with('fail', 'Email atau password anda salah');
            }
        }else{
            return view('login');
        }
    }

    public function home(){
        if(Auth::user()->level=='admin'){
            return redirect()->route('admin.requests.index');
        }else{
            return redirect()->route('customer.videos.index');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
