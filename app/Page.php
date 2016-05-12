<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

	public function scopeMenu($query)
	{
		return $query->where('type', 'page')->select(['title', 'slug'])->get();
	}
}
