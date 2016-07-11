<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
		'from_user_id',
		'to_user_id',
		'subject',
		'message',
		'is_viewed',
	];

	public function from()
	{
		return $this->belongsTo('App\User', 'from_user_id', 'id');
	}
	public function to()
	{
		return $this->belongsTo('App\User', 'to_user_id');
	}

}