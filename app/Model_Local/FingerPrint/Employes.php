<?php

namespace App\Model_Local\FingerPrint;

use Illuminate\Database\Eloquent\Model;

class Employes extends Model
{
    protected $connection = "mysql_local_fingerprint";

    protected $table = "emp";

    protected $guard = [];
}