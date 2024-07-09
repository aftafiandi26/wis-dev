<?php

namespace App\Model_Local\FingerPrint;

use Illuminate\Database\Eloquent\Model;

class Func_Department extends Model
{
    protected $connection = "mysql_local_fingerprint";

    protected $table = "func";

    protected $guard = [];
}