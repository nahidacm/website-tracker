<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class AggregationTest extends TestCase
{
    use DatabaseTransactions;

    public function testCampaignTrackingRecordAdded()
    {
        // Perform an HTTP call or simulate the request
        $response = $this->get('/track?cid=4235&crid=23423&bid=5&did=8&cip=78.60.201.201&conv=post_impression');

        // Assert that the HTTP call was successful
        $response->assertStatus(200);

        // Query the database to check if the record was added
        $recordExists = DB::table('campaign_tracking')
            ->where([
                'country_code'=>'LT'
            ])
            ->exists();

        // Assert that the record was added
        $this->assertTrue($recordExists);
    }
}

