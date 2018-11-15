<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Model\Video;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
class VideoTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateVideo()
    {
        $user = factory(\App\User::class)->create();
        $post = Video::create([
            'user_id' => $user->id,
            'url' => request('url'),
        ]);

        $this->assertDatabaseHas('videos', [
            'user_id' => $user->id,
            'url' => request('url'),
        ]);

    }

    public function testDeleteVideo()
    {
        $response = $this->post('/video/delete/1');
        $this->assertDatabaseMissing('videos', ['id' => 1]);
    }
}
