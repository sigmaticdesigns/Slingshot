<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
		'project_id',
		'user_id',
		'amount',
		'method',
		'is_paid',
		'response',
	];

	public function scopePursed($query, $projectId)
	{
		return $query->where('project_id', $projectId)->where('is_paid', 1)->sum('amount');
	}

	/**
	 * Get the user that contribute the project.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function scopeProject($query, $projectId)
	{
		return $query->where('project_id', $projectId)->where('is_paid', 1);
	}
}