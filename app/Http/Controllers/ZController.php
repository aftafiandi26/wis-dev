<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZController extends Controller
{
    public function animation()
    {
        return view('z_animation.1');
    }

    public function animation1()
    {
        return view('z_animation.2');
    }

    public function index()
    {
        return view('z_animation.kado-main.index');
    }
}