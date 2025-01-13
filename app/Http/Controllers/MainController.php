<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        return view('home');
    }
    public function about(){
        return view('about');
    }
    public function projects(){
        return view('projects');
    }
    public function events(){
        return view('events');
    }
    public function contact(){
        return view('contact');
    }
}
