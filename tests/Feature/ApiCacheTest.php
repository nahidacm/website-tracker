<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class ApiCacheTest extends TestCase
{
    public function testCacheKeyExists()
    {
        // Perform an HTTP call or simulate the request
        $response = $this->get('/track?cid=4235&crid=23423&bid=5&did=8&cip=78.60.201.201&conv=post_impression');

        // Assert that the HTTP call was successful
        $response->assertStatus(200);

        // Cache tag was added by the trann/geoip package
        $cachedItem = Cache::getStore()->get("tag:torann-geoip-location:key");
        $this->assertNotEmpty($cachedItem, "Cache with tag torann-geoip-location exists");
    }
}
