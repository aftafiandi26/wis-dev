<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicStaff extends Model
{
    protected $table = 'medical_staff';

    public function scopeJoinUsers($query)
    {
        return $query->leftjoin('users', 'users.id', '=', 'medical_staff.user_id');
    }

    public function scopeJoinLeave($query)
    {
        return $query->leftjoin('leave_transaction', 'leave_transaction.id', '=', 'medical_staff.leave_id');
    }

    public function scopeJoinMedicDisease($query)
    {
        return $query->leftjoin('medical_disease', 'medical_disease.medic_id', '=', 'medical_staff.id');
    }
}
