<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePost()
    {
        $user = factory(\App\User::class)->create();
        $post = Post::create([
            'user_id' => $user->id,
            'text' => request('text'),
        ]);

        $this->assertDatabaseHas('posts',[
            'user_id' => $user->id,
            'text' => request('text'),
        ]);

    }

    public function testDeletePost(){
        $response = $this->post('/posts/delete/1');
        $this->assertDatabaseMissing('posts', ['id' => 1]);
    }

}
