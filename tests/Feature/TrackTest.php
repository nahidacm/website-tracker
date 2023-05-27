<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_track_route(): void
    {
        $response = $this->get('/track?cid=4235&crid=23423&bid=5&did=8&cip=78.60.201.201&conv=post_impression');

        $response->assertStatus(200);
    }
}
