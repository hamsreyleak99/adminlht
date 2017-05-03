<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $articles = array(
    		array(
	            'name' => 'Home',  
        	),
        	array(
	          	'name' => 'About Us',
        	),
        	array(
	          	'name' => 'Group Company',
        	),
        	array(
	            'name' => 'Our Team',
        	),
            array(
                'name' => 'Event',
            ),
            array(
                'name' => 'Triding',
            ),
            array(
                'name' => 'Career',
            ),
            array(
                'name' => 'Contact Us',
            )
    	);
         foreach ($articles as $key => $article) {
    		DB::table('articles')->insert([
    			'name' 				=> 	$article['name'],
	            'created_at'		=> 	Carbon::now(), 
	            'updated_at'		=> 	Carbon::now()
    		]);
    	}
	}
}