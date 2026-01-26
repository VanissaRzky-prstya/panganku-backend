<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }
    public function authenticate(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt([
            'email'=> $request->email,
            'password'=> $request->password,
        ])){
            $request->session()->regenerate();
            if(auth()->user()->role !== 'user'){
                Auth::logout();
                return back()->withErrors([
                    'email'=>'Akun ini khusus admin. Silahkan login lewat panel admin!',
                ]);
            }
            return redirect()->route('home')->with('success','Login berhasil');
        }
        return back()->withErrors([
            'email'=>'Nama atau password salah!',
        ]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
