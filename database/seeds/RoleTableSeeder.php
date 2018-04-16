<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        		'name' => 'Author',
        		'slug' => 'author',
        		'permissions' => json_encode([
        				'create-post' => true,
        				'view-post' => true
        			]),
        	]);

         Role::create([
        		'name' => 'Editor',
        		'slug' => 'editor',
        		'permissions' => json_encode([
        				'update-post' => true,
        				'view-post' => true,
        				'create-post' => true,
                        'draft-post' => true,
        			]),
        	]);

         Role::create([
        		'name' => 'Admin',
        		'slug' => 'admin',
        		'permissions' => json_encode([
        				'update-post' => true,
        				'view-post' => true,
        				'create-post' => true,
        				'delete-post' => true,
                        'draft-post' => true,
                        'update-user' => true,
        				'view-user' => true,
        				'create-user' => true,
        				'delete-user' => true,
        			]),
        	]);
    }
}
