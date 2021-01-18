<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryModel as Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = '[
    	    		{
    		    		"name": "Tarjeta de video"
    	    		},
    	    		{
    		    		"name": "Disco duro HDD/SDD"
    	    		},
    	    		{
    		    		"name": "Unidad CD/DVD/BluRay"
    	    		},
    	    		{
    		    		"name": "Monitor"
    	    		}
    	    	]';
    	foreach (json_decode($categories,true) as $key => $value) 
    	{		
	        $category = new Category([
	            "name"     => $value["name"]
	        ]);
	        $category->save();
	        echo PHP_EOL;
	        echo 'Category: '.$value["name"].' created'.PHP_EOL;
	        echo PHP_EOL;
    	}
    }
}
