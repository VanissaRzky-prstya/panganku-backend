<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function index(){
        return view('akun.index');
    }
    public function update(Request $request){
        $user=Auth::user();
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'foto'=>'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        if ($request->hasFile('foto')){
            $file=$request->file('foto');
            $namaFile=time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('foto_profil'),$namaFile);
            $user->foto=$namaFile;
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        return redirect()->back()->with('succes', 'Profil berhasil diperbarui');
    }
}

