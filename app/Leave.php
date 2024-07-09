<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leave_transaction';

    protected $guarded = [];

    public function scopeJoinUsers($query)
    {
        return $query->leftjoin('users', 'users.id', '=', 'leave_transaction.user_id');
    }

    public function scopeJoinLeaveCategory($query)
    {
        return $query->leftjoin('leave_category', 'leave_category.id', '=', 'leave_transaction.leave_category_id');
    }

    public function scopeJoinDeptCategory($query)
    {
        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'users.dept_category_id');
    }

    public function scopeJoinInitialLeave($query)
    {
        return $query->leftjoin('initial_leave', 'users.id', '=', 'initial_leave.user_id');
    }

    public function scopeJoinProjectCategory($query)
    {
        return $query->leftjoin('project_category', 'users.project_category_id_1', '=', 'project_category.id');
    }

    public function getLeaveCategory()
    {
        return Leave_Category::where('id', $this->leave_category_id)->value('leave_category_name');
    }

    //foreach
    public function getUser()
    {
        return User::where('id', $this->user_id);
    }

    public function findEmail($find)
    {
        return User::where('email', $find)->first();
    }

    public function user()
    {
        return User::find($this->user_id);
    }

    public function getDepartment()
    {
        $query = $this->getUser();

        return Dept_Category::where('id', $query->value('dept_category_id'))->value('dept_category_name');
    }

    public function leaveName()
    {
        return Leave_Category::find($this->leave_category_id);
    }

    public function leaveCount()
    {
        return Entitled_leave_view::where('nik', $this->request_nik)->first();
    }
}