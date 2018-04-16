<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	DB::table('users')->truncate();
    	DB::table('posts')->truncate();
    	DB::table('comments')->truncate();
        DB::table('roles')->truncate();
        DB::table('users_roles')->truncate();
    	DB::statement('SET FOREIGN_KEY_CHECKS=1');


        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
