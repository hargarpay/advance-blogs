<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

        $role_ids = Role::pluck('id')->all();
    	foreach (range(1, 10) as $index) {
	       $user =  User::create([
	        		'email' => $faker->unique()->freeEmail,
	        		'name' => $faker->name,
	        		'password' => Hash::make('secret'),
	        		'api_token' => bin2hex(openssl_random_pseudo_bytes(30))
	        	]);

           $user->roles()->attach([$faker->randomElement($role_ids)]);
    	}
    }
}
