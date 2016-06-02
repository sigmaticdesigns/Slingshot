<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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

	/**
	 * Set the password to be hashed when saved
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = \Hash::make($password);
	}

	/**
	 * Get all user's projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function projects()
	{
		return $this->hasMany('App\Project');
	}
}
