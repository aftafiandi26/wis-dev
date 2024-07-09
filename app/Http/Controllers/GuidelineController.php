<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GuidelineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function induction()
    {

        return view('guide.introduction');
    }

    public function wfh()
    {
        return view('guide.wfh');
    }

    public function orginazation()
    {
        return view('guide.orginazation');
    }

    public function wiki()
    {
        return redirect('https://3.basecamp.com/4952258/buckets/20262700/message_boards/7482724197');
    }
}