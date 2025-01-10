<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainController extends Controller
{
    public function index(){
        return view('index');
    }
    public function about(){
        return view('index');
    }
    public function projects(){
        return view('index');
    }
    public function events(){
        return view('index');
    }
    public function contact(){
        return view('index');
    }
}
