<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Given a post has been created in the database
        $insertedpost = factory(Post::class)->create();
        
        // When I fetch the latest posts
        $retrievedpost = Post::latest()->get();
        
        // Then I should have a correct response of 1 post
        // Inserted post should match first result of latest() method call (retrieved post)
        $this->assertEquals($insertedpost->toArray(), $retrievedpost[0]->toArray());
    }


}
