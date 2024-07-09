<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Freelance extends Model
{
    protected $table = 'user_freelance';

    protected $guarded = ['id'];

    public function fullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}