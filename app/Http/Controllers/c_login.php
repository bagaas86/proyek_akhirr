<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DB;

class c_login extends Controller
{
    public function landingPage()
    {
        return view('v_landingPage');
    }

    public function index()
    {
        return view('v_login');
    }


    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Username wajib terisi',
            'password.required'=>'Password wajib terisi',
        ]);
        $user = $request->username;
        $pass = $request->password;

        if(auth()->attempt(array('username'=>$user,'password'=>$pass)))
        {
            return redirect('/dashboard');
        }
        else
        {
            session()->flash('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
        // Auth::logout();
        // $request->session()->flush();
        // return redirect()->route('user.login');
    }

    // Login multiuser
    public function dashboard(){

        if (Auth::user()->level == "Bagian Umum") {
            return view('admin.v_dashboard');
        } elseif(Auth::user()->level == "Kabag") {
            return view('admin.v_dashboard');
        }elseif(Auth::user()->level == "Wadir 1") {
            return view('admin.v_dashboard');
        }elseif(Auth::user()->level == "Wadir 2") {
            return view('admin.v_dashboard');
        }elseif(Auth::user()->level == "Ormawa") {
            return view('user.v_dashboard');
        }
       
    }

   
}
