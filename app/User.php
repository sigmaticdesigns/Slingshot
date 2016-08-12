<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Billable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'about'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'links' => 'array',
		'paypal_confirmed'  => 'boolean'
	];

    const STATUS_ACTIVE = 'active';
    const STATUS_BANNED = 'banned';

	/**
	 * @return bool
	 */
	public function deleteImage()
	{
		/*$file = $this->present()->image_path;

		if (file_exists($file)) {
			@unlink($file);

			return true;
		}
		*/

		return false;
	}

	public function avatar()
	{
		$result = '';
		if ($this->avatar) {
			$imgData = json_decode($this->avatar);
			if ($imgData)
			{
				$result = $imgData->path . '/' . $imgData->s;
			}
		}
		return $result;
	}

	public function image()
	{
		$result = '';
		if ($this->avatar) {
			$imgData = json_decode($this->avatar);
			if ($imgData)
			{
				$result = $imgData->path . '/' . $imgData->b;
			}
		}
		return $result;
	}

	/**
	 * Set the password to be hashed when saved
	 */
//	public function setPasswordAttribute($password)
//	{
//		$this->attributes['password'] = \Hash::make($password);
//	}

	/**
	 * Get all user's projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function projects()
	{
		return $this->hasMany('App\Project');
	}

	public function payments()
	{
		return $this->hasMany('App\Payment');
	}

	public function backer($projectId)
	{
		return $this->payments()->where('project_id', $projectId)->count();
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

	/**
	 * Confirm the user.
	 *
	 * @return void
	 */
	public function confirmEmail()
	{
//		$this->verified = true;
		$this->token = null;

		$this->save();
	}

	public function getEmailVerifiedAttribute()
	{
		if ($this->token) {
			return false;
		}
		else {
			return true;
		}
	}
}
