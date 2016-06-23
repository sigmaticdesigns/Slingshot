<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_REFUNDED = 'refunded';
    const STATUS_DO_REFUND = 'do_refund';

	protected $fillable = [
		'project_id',
		'user_id',
		'amount',
		'method',
		'is_paid',
		'sale_id',
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