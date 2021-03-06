<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::truncate();

        $categories = [
            'Art',
	        'Comics',
	        'Craft',
	        'Dance',
	        'Design',
	        'Fashion',
	        'Film & Video',
	        'Food',
	        'Games',
	        'Journalism',
	        'Music',
	        'Photography',
	        'Publishing',
	        'Technology',
	        'Theater',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
