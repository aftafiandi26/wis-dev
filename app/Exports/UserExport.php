<?php

namespace App\Exports;

use App\Project_Category;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Project_Category::all();
    }
}
