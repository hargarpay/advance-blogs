<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function testGetPost(){
        $response = $this->get('/post/1/first-post');
    
        $response->assertStatus(200);
        
    }
    
    public function testGetPostComments(){
        $response = $this->get('/post/1/comments');
    
        $response->assertStatus(200);

    }
}
