<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmailSignatureController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {

        return view('emailsignature.index');
    }

    public function lay(Request $request)
    {
        $iconIFW = asset('assets/Infinite_Studios_Logo-03.png');

        $request->session()->put('esignature_data', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'job' => $request->input('job'),
            'mobile' => $request->input('mobile'),
        ]);

        $data = $request->session()->get('esignature_data');

        return view('emailsignature.layout', compact(['iconIFW', 'data']));
    }
}