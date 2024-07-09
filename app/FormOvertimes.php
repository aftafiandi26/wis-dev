<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormOvertimes extends Model
{
    protected $table = "form_overetime_remotes";

    protected $guarded = [];

    /**
     * Get the user that owns the FormOvertimes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function coordinator()
    {
        return $this->hasOne(User::class, 'id', 'coor_id');
    }

    public function projectManager()
    {
        return $this->hasOne(User::class, 'id', 'pm_id');
    }

    public function generalManager()
    {
        return $this->hasOne(User::class, 'id', 'gm_id');
    }

    public function itId()
    {
        return $this->hasOne(User::class, 'id', 'it_id');
    }
}