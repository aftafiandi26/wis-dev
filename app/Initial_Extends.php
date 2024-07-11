<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Initial_Extends extends Model
{
    protected $table = "initial_leave_extends";

    protected $guarded = [];


    public function user()
    {
        return User::find($this->user_id);
    }

    public function getUser($query)
    {
        return User::find($query);
    }

    public function initial_leave()
    {
        return Initial_Leave::find($this->initial_leave_id);
    }
}
