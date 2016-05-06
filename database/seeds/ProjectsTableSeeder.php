<?php 

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        Project::create([
			'name'			=> 'Psychological Disorder Through Dance',
			'user_id'		=> 2,
			'status'		=> 'pending',
			'category_id'	=> 1,
			'country_id'	=> 1,
			'budget'		=> 1500,
			'description'	=> 'Help me Fund this Short Dance Film on Psychological Disorder to help raise awareness about this illness ',
        ]);

		Project::create([
			'name'			=> 'Robust Domino - A classic game reinvented',
			'user_id'		=> 3,
			'status'		=> 'pending',
			'category_id'	=> 3,
			'country_id'	=> 1,
			'budget'		=> 3000,
			'description'	=> 'WHAT IS ROBUST DOMINO ?

Robust Domino is a traditional game of dominoes made concrete. The circular, concrete and walnut veneer used make this unique domino game in the world.

The rules do not change, only the different materials make the Robust Domino totally revisited.',
		]);
    }

}