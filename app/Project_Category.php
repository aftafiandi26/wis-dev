<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project_Category extends Model
{
	protected $table = 'project_category';

	protected $guarded = [];

	public function scopeJoinUsers($query)
	{
		return $query->leftjoin('users', 'users.project_category_id_1', '=', 'project_category.id');
	}

	/**
	 * Get the user that owns the Project_Category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function projectGroup()
	{
		return $this->belongsTo(ProjectGroup::class, 'group', 'id');
	}
}