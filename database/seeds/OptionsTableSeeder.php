<?php

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Option;

class OptionsTableSeeder extends Seeder
{
    public function run()
    {
        Option::truncate();

        $options = array(
            array(
                'key' => 'site.name',
                'value' => 'Sling Shot',
            ),
            array(
                'key' => 'site.slogan',
                'value' => 'The Great Website!',
            ),
            array(
                'key' => 'site.description',
                'value' => 'Funding platform.',
            ),
            array(
                'key' => 'site.keywords',
                'value' => 'pingpong, gravitano',
            ),
            array(
                'key' => 'tracking',
                'value' => '<!-- GA Here -->',
            ),
            array(
                'key' => 'facebook.link',
                'value' => 'https://www.facebook.com/slingshot',
            ),
            array(
                'key' => 'twitter.link',
                'value' => 'https://twitter.com/slingshot',
            ),
            array(
                'key' => 'google.link',
                'value' => 'https://google.com',
            ),
            array(
                'key' => 'instargam.link',
                'value' => 'https://www.instagram.com/',
            ),
            array(
                'key' => 'linkedin.link',
                'value' => 'https://www.linkedin.com/in/eugene-goian-a19a1659',
            ),
            array(
                'key' => 'post.permalink',
                'value' => '{slug}',
            ),
            array(
                'key' => 'ckfinder.prefix',
                'value' => 'packages/pingpong/admin',
            ),
            array(
                'key' => 'admin.theme',
                'value' => 'default',
            ),
            array(
                'key' => 'pagination.perpage',
                'value' => 20,
            ),
        );

        foreach ($options as $option) {
            Option::create($option);
        }
    }
}
