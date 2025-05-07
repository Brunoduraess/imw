<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function menu()
    {
        return view('admin/menu');
    }

}
