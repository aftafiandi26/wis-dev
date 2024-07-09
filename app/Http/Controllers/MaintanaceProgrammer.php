<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tglCanteen;

class MaintanaceProgrammer extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth', 'active', 'programmer']);
		
	}

	public function showTglCanteen()
	{
		$showTglCanteen = tglCanteen::first();

		dd($showTglCanteen);
		
	}
}
