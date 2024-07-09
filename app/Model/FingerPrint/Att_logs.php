<?php

namespace App\Model\FingerPrint;

use Illuminate\Database\Eloquent\Model;

class Att_logs extends Model
{
    protected $connection = "mysql_fingerprint";

    protected $table = "att_log";

    protected $guard = [];

    /**
     * Get the user that owns the Att_logs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function employes()
    {
        return $this->belongsTo(Employes::class, 'pin', 'pin');
    }
}