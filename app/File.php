<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
		'type',
		'filename',
		'path',
		'fileable_id',
		'fileable_type',
	];

	/**
	 * Get all of the owning fileable models.
	 */
	public function fileable()
	{
		return $this->morphTo();
	}
}