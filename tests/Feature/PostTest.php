<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testcreatePost()
    {
        $data = [
            'text' => 'some me name'
        ];

        $this->post(route('post-create'), $data)
            ->assertStatus(200)
            ->assertRedirect(\back());

    }
}
