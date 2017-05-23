<?php

use App\Article;
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
                'id_table' => '1',
                'lang' => 'en',
        	),
            array(
                'name' => 'ទំព័រដើម',  
                'id_table' => '1',
                'lang' => 'kh',
            ),
        	array(
	          	'name' => 'About Us',
                'id_table' => '2',
                'lang' => 'en',
        	),
            array(
                'name' => 'អំពីយើងខ្ញុំ',  
                'id_table' => '2',
                'lang' => 'kh',
            ),
        	array(
	          	'name' => 'Group Company',
                'id_table' => '3',
                'lang' => 'en',
        	),
            array(
                'name' => 'ក្រុមហ៊ុនជាដៃគូ', 
                'id_table' => '3',
                'lang' => 'kh',
            ),
        	array(
	            'name' => 'Our Team',
                'id_table' => '4',
                'lang' => 'en',
        	),
            array(
                'name' => 'ក្រុមការងាររបស់យើង', 
                'id_table' => '4',
                'lang' => 'kh',
            ),
            array(
                'name' => 'Event',
                'id_table' => '5',
                'lang' => 'en',
            ),
            array(
                'name' => 'ព្រឹតិការណ៏', 
                'id_table' => '5',
                'lang' => 'kh',
            ),
            array(
                'name' => 'Triding',
                'id_table' => '6',
                'lang' => 'en',
            ),
            array(
                'name' => 'ពាណិជ្ជកម្ម',
                'id_table' => '6',
                'lang' => 'kh',
            ),
            array(
                'name' => 'Career',
                'id_table' => '7',
                'lang' => 'en',
            ),
            array(
                'name' => 'កាងារ',  
                'id_table' => '7',
                'lang' => 'kh',
            ),
            array(
                'name' => 'Contact Us',
                'id_table' => '8',
                'lang' => 'en',
            ),
            array(
                'name' => 'ទំនាក់ទំនង', 
                'id_table' => '8',
                'lang' => 'kh',
            ),
    	);
         foreach ($articles as $key => $article) {
    		DB::table('articles')->insert([
                'id_table'          =>  $article['id_table'],
    			'name' 				=> 	$article['name'],
                'lang'              =>  $article['lang'],
	            'created_at'		=> 	Carbon::now(), 
	            'updated_at'		=> 	Carbon::now()
    		]);
    	}
	}
}