<?php

use Illuminate\Database\Seeder;

class Acticle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acticle = array(
    		array(
	            'name' => 'home',
        	),
        	array(
	            'name' => 'image_gallery',
        	),
        	array(
	            'name' => 'setup_slider',
        	),
        	array(
	            'name' => 'group_company',
        	),
        	array(
	            'name' => 'our_team',
        	),
            array(
                'name' => 'event',
            ),
            array(
                'name' => 'triding',
            ),
            array(
                'name' => 'career',
            )

    	);

    	foreach ($masterTypes as $key => $masterType) {
    		DB::table('master_types')->insert([
    			'name' => $masterType['name'],
	            'created_at'=> Carbon::now(), 
	            'updated_at'=> Carbon::now(),
    		]);
    	}
    }
}
