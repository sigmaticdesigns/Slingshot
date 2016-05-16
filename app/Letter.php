<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = [
		'name',
		'slug',
		'subject',
		'content',
	];
}