<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingOnWeekends extends Model
{
    protected $table = 'working_on_weekends';
    protected $guarded = [];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function coordinator()
    {
        return User::find($this->coor_id);
    }

    public function producer()
    {
        return User::find($this->producer_id);
    }
}