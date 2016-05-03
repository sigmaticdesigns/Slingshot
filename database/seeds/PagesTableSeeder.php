<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Article;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Article::create([
		    'type'  => 'page',
		    'user_id'   => 1,
		    'title'     => 'About us',
		    'slug'      => Str::slug('About us'),
		    'body'      => 'About us page content',
	    ]);

	    Article::create([
		    'type'  => 'page',
		    'user_id'   => 1,
		    'title'     => 'How it works',
		    'slug'      => Str::slug('How it works'),
		    'body'      => 'How it works page content',
	    ]);

	    Article::create([
		    'type'  => 'page',
		    'user_id'   => 1,
		    'title'     => 'Privacy Policy',
		    'slug'      => Str::slug('Privacy Policy'),
		    'body'      => 'Privacy Policy page content',
	    ]);

	    Article::create([
		    'type'  => 'page',
		    'user_id'   => 1,
		    'title'     => 'Terms of Use',
		    'slug'      => Str::slug('Terms of Use'),
		    'body'      => 'Terms of Use page content',
	    ]);
    }
}
