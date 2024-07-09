<?php

namespace App\Model\FingerPrint;

use Illuminate\Database\Eloquent\Model;

class Employes extends Model
{
    protected $connection = "mysql_fingerprint";

    protected $table = "emp";

    protected $guard = [];
}