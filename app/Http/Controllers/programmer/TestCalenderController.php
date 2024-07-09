<?php

namespace App\Http\Controllers\programmer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leave;
use App\Leave_Category;
use App\User;
use Illuminate\Support\Str;

class TestCalenderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function testView()
    {
        return view('IT.Progress.calenderTest.index');
    }

    public function objectView()
    {
        $query = Leave::where('ap_hrd', 1)->whereYear('leave_date', date('Y'))->orderBy('id', 'desc')->get();

        foreach ($query as $value) {

            $user = User::find($value['user_id']);
            $leaveName = Leave_Category::find($value['leave_category_id']);

            if ($value['leave_category_id'] === 1) {
                $color = 'lightblue';
            } elseif ($value['leave_category_id'] === 2) {
                $color = 'lightgreen';
            } else {
                $color = 'grey';
            }

            $textColor = 'black';

            if ($color === "grey") {
                $textColor = 'white';
            }

            $arrayQuqery[] = [
                'id' => $value['id'],
                'title' => $user->getFullName() . ' ' . "($leaveName->leave_category_name)",
                'start' => $value['leave_date'],
                'end' => $value['back_work'],
                'color' => $color,
                'textColor' => $textColor,
                // 'url' => 'http://google.com/',
            ];
        }

        return $arrayQuqery;
    }

    private function testA($id)
    {
        dd($id);
    }
}