<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendingDataWorkingWeekend extends Model
{
    protected $table = 'sending_data_working_weekends';
    protected $guarded = [];

    public function coordinator()
    {
        return User::find($this->coor_id);
    }

    public function producer()
    {
        return User::find($this->producer_id);
    }

    public function RelationCoor()
    {
        return $this->belongsTo(User::class, 'coor_id', 'id');
    }
}