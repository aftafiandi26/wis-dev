<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'kk', 'npwp', 'id_card'
    ];

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getDepartment()
    {
        return Dept_Category::where('id', $this->dept_category_id)->value('dept_category_name');
    }

    public function getProjectName($query)
    {
        if ($query == Null) {
            return null;
        }

        $project =  Project_Category::where('id', $query)->value('project_name');

        return $project;
    }

    public function department()
    {
        return $this->belongsTo(Dept_Category::class, 'dept_category_id', 'id');
    }

    public function converDate($query)
    {
        return date('F d, Y', strtotime($query));
    }

    public function converBirthDate($query)
    {
        return date('d F Y', strtotime($query));
    }

    public function entitled_leave()
    {
        return $this->belongsTo(Entitled_leave_view::class, 'nik', 'nik');
    }

    public function initial($query)
    {
        return Initial_Leave::where('user_id', $query)->get();
    }

    public function all_leave_entitled($nik)
    {
        return Entitled_leave_view::where('nik', $nik)->first();
    }
}