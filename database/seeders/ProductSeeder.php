<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductModel as Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$products = '[
    	    		{
    	    			"id_category": 1,
    		    		"description": "NVIDIA GeForce 1500Gx",
    		    		"price": 100
    	    		},
    	    		{
    	    			"id_category": 2,
    		    		"description": "Western Digital 1 TB",
    		    		"price": 60
    	    		},
    	    		{
    	    			"id_category": 3,
    		    		"description": "LG GH20",
    		    		"price": 70
    	    		},
    	    		{
    	    			"id_category": 4,
    		    		"description": "Lenovo 42\'\'",
    		    		"price": 90
    	    		}
    	    	]';
    	foreach (json_decode($products,true) as $key => $value) 
    	{		
	        $product = new Product([
	        	"id_category"     => $value["id_category"],
	            "description"     => $value["description"],
	            "price"     => $value["price"]
	        ]);
	        $product->save();
	        echo PHP_EOL;
	        echo 'Product: '.$value["description"].' created'.PHP_EOL;
	        echo PHP_EOL;
    	}
    }
}
