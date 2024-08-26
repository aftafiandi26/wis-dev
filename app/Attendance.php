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

    public function relationsQuest()
    {
        return $this->hasOne(Attendance_Questions::class, 'id', 'quest_id');
    }

    public function quest()
    {
        $return = Attendance_Questions::find($this->quest_id);

        return $return;
    }
}