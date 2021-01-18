<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = '[
    	    		{
    		    		"name": "Andrés Ucero",
    		            "email": "andresucero241093@gmail.com",
    		            "password": "123456",
    		            "type": 1
    	    		},
    	    		{
    		    		"name": "Augusto Ucero",
    		            "email": "uceroudo@gmail.com",
    		            "password": "123456",
    		            "type": 1
    	    		},
    	    		{
    		    		"name": "Diana Ucero",
    		            "email": "dianaucero2002@gmail.com",
    		            "password": "123456",
    		            "type": 2
    	    		},
    	    		{
    		    		"name": "María Luisa Ucero",
    		            "email": "uceroguerra@gmail.com",
    		            "password": "123456",
    		            "type": 2
    	    		}
    	    	]';
    	foreach (json_decode($users,true) as $key => $value) 
    	{		
	        $user = new User([
	            "name"     => $value["name"],
	            "email"    => $value["email"],
	            "password" => $value["password"],
	            "type"     => $value["type"],
	            "activation_token"     => 123456789,
	            "active"  => 1
	        ]);
	        $user->save();
	        echo PHP_EOL;
	        echo 'User: '.$value["email"].' created'.PHP_EOL;
	        echo PHP_EOL;
    	}

    }
}
