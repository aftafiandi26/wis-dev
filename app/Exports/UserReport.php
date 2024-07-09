<?php

namespace App\Exports;
use App\User;
​
use Maatwebsite\Excel\Concerns\FromCollection;

class UserReport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}