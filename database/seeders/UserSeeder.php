<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ClientModel as Client;

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
                        "dni": "V22616688",
                        "phone": "04124643188",
    		            "type": 1
    	    		},
    	    		{
    		    		"name": "Augusto Ucero",
    		            "email": "uceroudo@gmail.com",
    		            "password": "123456",
                        "dni": "V20616688",
                        "phone": "04124643188",
    		            "type": 1
    	    		},
    	    		{
    		    		"name": "Diana Ucero",
    		            "email": "dianaucero2002@gmail.com",
    		            "password": "123456",
                        "dni": "V30487338",
                        "phone": "04124643188",
    		            "type": 2
    	    		},
    	    		{
    		    		"name": "María Luisa Ucero",
    		            "email": "uceroguerra@gmail.com",
    		            "password": "123456",
                        "dni": "V26360249",
                        "phone": "04124643188",
    		            "type": 2
    	    		}
    	    	]';
        $clients = '[
                        {
                            "name": "Juan Pérez",
                            "dni": "V8354778",
                            "address": "Av. Primera, calle 1, casa #11",
                            "phone": "04124643188"
                        },
                        {
                            "name": "María Izaguirre",
                            "dni": "V13456745",
                            "address": "Av. Segunda, calle 2, casa #22",
                            "phone": "04124643188"
                        },
                        {
                            "name": "José Piñeda",
                            "dni": "V587149",
                            "address": "Av. Tercera, calle 3, casa #33",
                            "phone": "04124643188"
                        },
                        {
                            "name": "Modesta Vita",
                            "dni": "V2333958",
                            "address": "Av. Cuarta, calle 4, casa #44",
                            "phone": "04124643188"
                        }
                    ]';
    	foreach (json_decode($users,true) as $key => $value) 
    	{		
	        $user = new User([
	            "name"     => $value["name"],
	            "email"    => $value["email"],
	            "password" => bcrypt($value["password"]),
                "dni"     => $value["dni"],
                "phone"     => $value["phone"],
	            "type"     => $value["type"],
	            "activation_token"     => 123456789,
	            "active"  => 1
	        ]);
	        $user->save();
	        echo PHP_EOL;
	        echo 'User: '.$value["email"].' created'.PHP_EOL;
	        echo PHP_EOL;
    	}

        foreach (json_decode($clients,true) as $key => $value) 
        {       
            $user = new Client([
                "name"     => $value["name"],
                "dni"    => $value["dni"],
                "address" => $value["address"],
                "phone"     => $value["phone"]
            ]);
            $user->save();
            echo PHP_EOL;
            echo 'Client: '.$value["name"].' created'.PHP_EOL;
            echo PHP_EOL;
        }

    }
}
