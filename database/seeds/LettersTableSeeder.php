<?php

use App\Letter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

	    $data = [];
	    $data[] = [
		    'name'      => 'Registration Email',
		    'slug'      => 'registration-email',
		    'subject'   => 'Registration at SlingShot',
		    'content'   => '<p>Hello {name}<br />
You have registered at SlingShot.</p>
',
	    ];
	    $data[] = [
		    'name'      => 'New project created',
		    'slug'      => 'new-project-created',
		    'subject'   => 'New project was created',
		    'content'   => '<p>New project was created<br />Pay attention please.</p>',
	    ];

		$data[] = [
		    'name'      => 'Project was failed',
		    'slug'      => 'project-failed',
		    'subject'   => 'Project was failed',
		    'content'   => '<p>Dear {name}<br />Project "{project_name}" was failed<br />You will get refund.</p>',
	    ];


		$data[] = [
		    'name'      => 'Project ended',
		    'slug'      => 'project-finished',
		    'subject'   => 'Project ended',
		    'content'   => '<p>Project {project_name} ended<br /></p>',
	    ];


	    foreach($data as $row)
	    {
		    if (empty($row['slug'])) {
			    $slug = Str::slug($row['name']);
			    $row['slug'] = $slug;
		    }

		    if (Letter::where('slug', $row['slug'])->count() > 0) {
			    continue;
		    }

		    Letter::create($row);
	    }
        

    }

}