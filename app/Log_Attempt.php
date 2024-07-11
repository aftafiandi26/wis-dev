<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_Attempt extends Model
{
    protected $table = "log_attempt";

    protected $guarded = [];

    public function user()
    {
        $user = User::find($this->user_id);

        return $user;
    }
}
