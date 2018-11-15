<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Comment;
use App\Model\Post;

class CommentTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePostComment()
    {
        

        $response = $this->post ('/comment/create/post/1');
        $response->assertStatus(302);
        
    }
    
    public function testCreateVideoComment()
    {
        $response = $this->post ('/comment/create/video/1');
        $response->assertStatus(302);   
    }

    public function testDeleteComment()
    {
        $response = $this->post('/comment/delete/1');
        $this->assertDatabaseMissing('comments', ['id' => 1]);
    }
}
