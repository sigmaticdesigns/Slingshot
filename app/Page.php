<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
		'title',
		'slug',
		'section',
		'template',
		'body',
	];

	public function scopeMenu($query, $section = 'about')
	{
		return $query->where('section', $section)->select(['title', 'slug'])->get();
	}
}