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
}