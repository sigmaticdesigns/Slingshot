<?php namespace App;
   
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_DECLINED = 'declined';
    const STATUS_APPROVED = 'approved';

	const STATUS_FINISHED = 'finished';
	const STATUS_FAILED = 'failed';

	const TYPE_PROFIT = 'profit';
	const TYPE_NON_PROFIT = 'non_profit';


	protected $fillable = [
		'name',
		'user_id',
		'status',
		'category_id',
		'type',
		'country_id',
		'budget',
		'description',
		'body',
		'file_id',
		'deadline',
		'half_deadline',
		'video'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at', 'deadline'];

	/**
	 * Get funding progress in percent
	*/
	public function progress()
	{
		$result = 0;
		if ($this->purse > 0) {
			$result = intval(round($this->purse / ($this->budget / 100)));
		}
		return $result;
	}

	public function daysLeft()
	{
		return $this->deadline->diffInDays(Carbon::now());
	}

	/**
	 * Get the user that owns the project.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	/**
	 * Get main projects's image
	 */
	public function image()
	{
		return $this->belongsTo('App\File', 'file_id');
	}

	/**
	 * Get all of the projects's files.
	 */
	public function files()
	{
		return $this->morphMany('App\File', 'fileable');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * Get all comments
	 */
	public function comments()
	{
		return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
	}

	public function payments()
	{
		return $this->hasMany('App\Payment');
	}

	/**
	 * filter only active approved projects
	 */
	public function scopeActive($query)
	{
		return $query->where('status', self::STATUS_APPROVED);
	}

	public function getProjectTypeAttribute()
	{
		$result = '';
		switch ($this->type)
		{
			case self::TYPE_PROFIT:
				$result = 'Profit Project';
				break;
			case self::TYPE_NON_PROFIT:
				$result = 'Non Profit Project';
				break;
		}
		return $result;
	}
}