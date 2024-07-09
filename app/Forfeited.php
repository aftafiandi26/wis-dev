<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forfeited extends Model
{
     protected $table = 'forfeiteds';

      public function users()
    {
         return $this->belongsTo('App\NewUser', 'user_id', 'id');
    } 



}
