<?php 

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LettersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        \App\Letter::create([
	        'name'      => 'Registration Email',
	        'slug'      => 'registration-email',
	        'subject'   => 'Registration at SlingShot',
	        'content'   => '<p>Hello {name}<br />
You have registered at SlingShot.</p>
',
        ]);
    }

}