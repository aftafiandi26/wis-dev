<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ITLeaveSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'it']);
    }

    public function index()
    {
        dd("hallo");
    }
}