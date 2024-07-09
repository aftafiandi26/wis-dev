<?php

namespace App\Model\FingerPrint;

use Illuminate\Database\Eloquent\Model;

class Func_Department extends Model
{
    protected $connection = "mysql_fingerprint";

    protected $table = "func";

    protected $guard = [];
}