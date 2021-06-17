<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function home(){
        return view('home');
    }
    public function blog(){
        return view('blog');
    }
    public function services(){
        return view('services');
    }
    public function contact(){
        return view('contact');
    }
    public function exitApp(){
        Auth::logout();
        return redirect('home');
    }
}
