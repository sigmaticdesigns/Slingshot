<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

	    $this->call(CategoriesTableSeeder::class);
	    $this->call(OptionsTableSeeder::class);
	    $this->call(RolesTableSeeder::class);
	    $this->call(PermissionsTableSeeder::class);
	    $this->call(UsersTableSeeder::class);
	    $this->call(PagesTableSeeder::class);
	    $this->call(LettersTableSeeder::class);

        Model::reguard();
    }
}
