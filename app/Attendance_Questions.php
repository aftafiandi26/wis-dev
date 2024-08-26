<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance_Questions extends Model
{
    protected $table = "attendance_questions";

    protected $guarded = [];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function nameQ1()
    {
        if (empty($this->Q1)) {
            $result = null;
        }
        if ($this->Q1 === 1) {
            $result = "Very Unpleasant";
        }

        if ($this->Q1 === 2) {
            $result = "Unpleasant";
        }

        if ($this->Q1 === 3) {
            $result = "Neutral";
        }

        if ($this->Q1 === 4) {
            $result = "Pleasant";
        }

        if ($this->Q1 === 5) {
            $result = "Very Pleasant";
        }

        return $result;
    }

    public function nameQ2()
    {
        if (empty($this->Q2)) {
            $result = null;
        }

        if ($this->Q2 === 1) {
            $result = "Very Poor";
        }

        if ($this->Q2 === 2) {
            $result = "Good";
        }

        if ($this->Q2 === 3) {
            $result = "Very Good";
        }

        if ($this->Q2 === 4) {
            $result = "Excellent";
        }

        return $result;
    }
}