<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Post;
use App\User;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user_ids = array_pluck(User::all()->toArray(), 'id');

        foreach (range(1, 20) as $index) {
        	Post::create([
        			'title' => $faker->words(5, true),
        			'description' => $faker->text(250),
        			'user_id' => $faker->randomElement($user_ids)
        		]);
        }
    }
}
