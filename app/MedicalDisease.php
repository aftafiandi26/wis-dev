<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalDisease extends Model
{
    protected $table = 'medical_disease';

    public function scopeJoinUsers($query)
    {
        return $query->leftjoin('users', 'users.id', '=', 'medical_disease.user_id');
    }

    public function scopeJoinLeave($query)
    {
        return $query->leftjoin('leave_transaction', 'leave_transaction.id', '=', 'medical_disease.leave_id');
    }

    public function scopeJoinMedicStaff($query)
    {
        return $query->leftjoin('medical_staff', 'medical_staff.id', '=', 'medical_disease.medic_id');
    }


}
