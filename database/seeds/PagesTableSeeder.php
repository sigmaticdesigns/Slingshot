<?php

use App\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Page::create([
		    'title'     => 'About us',
		    'slug'      => Str::slug('About us'),
		    'section'   => 'about',
		    'template'  => 'html',
		    'body'      => 'SlingShot helps artists, musicians, filmmakers, designers, and other creators find the resources and support they need to make their ideas a reality. To date, tens of thousands of creative projects — big and small — have come to life with the support of the SlingShot community. ',
	    ]);

	    Page::create([
		    'title'     => 'How it works',
		    'slug'      => Str::slug('How it works'),
		    'section'   => 'about',
		    'template'  => 'view',
		    'body'      => 'How it works page content',
	    ]);

	    Page::create([
		    'title'     => 'Privacy Policy',
		    'slug'      => Str::slug('Privacy Policy'),
		    'section'   => 'about',
		    'template'  => 'view',
		    'body'      => 'Privacy Policy page content',
	    ]);

	    Page::create([
		    'title'     => 'Terms of Use',
		    'slug'      => Str::slug('Terms of Use'),
		    'section'   => 'about',
		    'template'  => 'view',
		    'body'      => 'Terms of Use page content',
	    ]);

	    Page::create([
		    'section'   => 'help',
		    'template'  => 'view',
		    'title'     => 'FAQ',
		    'slug'      => Str::slug('FAQ'),
		    'body'      => '<b>What are the basics?</b>b>
<br>
A project is a finite work with a clear goal that you’d like to bring to life. Think albums, books, or films.
<br>
The funding goal is the amount of money that a creator needs to complete their project.
<br>
Funding on Kickstarter is all-or-nothing. No one will be charged for a pledge towards a project unless it reaches its funding goal. This way, creators always have the budget they scoped out before moving forward.

A creator is the person or team behind the project idea, working to bring it to life.

Backers are folks who pledge money to join creators in bringing projects to life.',
	    ]);

	    Page::create([
		    'section'   => 'help',
		    'template'  => 'view',
		    'title'     => 'Creator Handbook',
		    'slug'      => Str::slug('Creator Handbook'),
		    'body'      => 'Your project can be anything that you want to create and share with others. It could be a book, a film, a piece of hardware... pretty much anything you dream up can find a home on Kickstarter. Just keep your project focused, with a clear end goal, and you’ll be good.',
	    ]);
    }
}
