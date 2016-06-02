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

	public function scopeMenu($query, $category = 1)
	{
		return $query->where('type', 'page')->where('category_id', $category)->select(['title', 'slug'])->get();
	}
}
