<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dormitories extends Model
{
    protected $guarded = [];

    public function getUser()
    {
        return User::where('id', $this->user_id)->first();
    }
}