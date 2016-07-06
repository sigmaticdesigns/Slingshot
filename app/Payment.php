<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_REFUNDED = 'refunded';
    const STATUS_DO_REFUND = 'do_refund';

	const METHOD_PAYPAL         = 'paypal';
	const METHOD_CREDIT_CARD    = 'credit_card';

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

	public function scopeBackers($query, $projectId)
	{
		return $query->where('project_id', $projectId)->where('is_paid', 1);
	}

	public function getCurrentStatusAttribute()
	{
		$result = '';
		switch ($this->status)
		{
			case self::STATUS_DO_REFUND:
				$result = 'Will be refunded';
				break;
			case self::STATUS_REFUNDED:
				$result = 'Refunded';
				break;
		}
		return $result;
	}

	public function getMethodNameAttribute()
	{
		$result = '';
		switch ($this->method)
		{
			case self::METHOD_PAYPAL:
				$result = 'PayPal';
				break;
			case self::METHOD_CREDIT_CARD:
				$result = 'Credit Card';
				break;
		}
		return $result;
	}

	public function project()
	{
		return $this->belongsTo('App\Project');
	}
}