<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_WorkingWeekends extends Model
{
    protected $table = "log__working_weekends";

    protected $guarded = [];

    public function user($query)
    {
        $user = User::find($query);

        return $user;
    }
}
