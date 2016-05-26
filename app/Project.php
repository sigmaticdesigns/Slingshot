<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_DECLINED = 'declined';
    const STATUS_APPROVED = 'approved';


	protected $fillable = [
		'name',
		'user_id',
		'status',
		'category_id',
		'country_id',
		'budget',
		'description',
		'file_id',
		'deadline',
		'half_deadline'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Get the user that owns the project.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function category()
	{
		return $this->belongsTo('Pingpong\Admin\Entities\Category');
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
	 * filter only active approved projects
	 */
	public function scopeActive($query)
	{
		return $query->where('status', self::STATUS_APPROVED);
	}
}