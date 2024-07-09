<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = "attendance_news";

    protected $guarded = ['id'];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function relationsUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}