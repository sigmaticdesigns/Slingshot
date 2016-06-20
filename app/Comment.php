<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
		'user_id',
		'project_id',
		'message',
		'parent_id',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 *
	 * get project starter response
	 */
	public function response()
	{
		return $this->hasOne('app\Comments', 'parent_id');
	}
}