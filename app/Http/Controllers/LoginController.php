<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Member;

class LoginController extends Controller
{
    public function login_index()
    {
        return view('admin.login.login');
    }

    public function postlogin(Request $request) {
        // dd($request->all());
        if(Auth::attempt($request->only('username', 'password'))) {
          $check = User::where('id', auth()->user()->id)->first();
          if(($check->status == 1 and $check->role == 'superadmin') or ($check->status == 1 and $check->role == 'admin')) {
             return redirect('/dashboard'); 
          } else if (($check->status == 0 and $check->role == 'superadmin') or ($check->status == 0 and $check->role == 'admin')) {
             auth()->logout();
             return back()->with('status', 'Maaf, anda bukan admin aktif');
          } else if ($check->role == 'member') {
             auth()->logout();
             return back()->with('status', 'Maaf, anda adalah member, silahkan login di halaman membership');
          }
        } 
        return redirect('/admin')->with('status', 'Username atau Password Salah !');
     }
 
     public function logout(Request $request) {
         Auth::logout();
         return redirect('/admin');
     }

     public function member_postlogin(Request $request) {
        // dd($request->all());
        if(Auth::attempt($request->only('username', 'password'))) {
          $check = User::where('id', auth()->user()->id)->first();
          if($check->role == 'member' and $check->status == 1 and $check->is_verified == 1) {
                return redirect('/member/dashboard'); 
          } else if ($check->role == 'member' and $check->status == 0 and $check->is_verified == 1){
                auth()->logout();
                return redirect('/membership#register')->with('status', 'Maaf, akun anda di non-aktif kan');
          } else if ($check->role == 'member' and $check->status == 1 and $check->is_verified == 0){
                auth()->logout();
                return redirect('/membership#register')->with('status', 'Anda belum melakukan verifikasi email');
          } else if ($check->role == 'member' and $check->status == 0 and $check->is_verified == 0) {
                auth()->logout();
                return redirect('/membership#register')->with('status', 'Maaf, akun anda di non-aktif kan');
          } else if ($check->role == 'superadmin' or $check->role == 'admin'){
                auth()->logout();
                return redirect('/membership#register')->with('status', 'Maaf, anda adalah admin, silahkan login di admin');
          }
        } 
        return redirect('/membership#register')->with('status', 'Username atau Password Salah !');
     }
 
     public function member_logout(Request $request) {
         Auth::logout();
         return redirect('/membership');
     }
}
