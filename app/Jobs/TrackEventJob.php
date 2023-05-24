<?php

namespace App\Jobs;

use App\Http\Controllers\TrackingController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CampaignTracking;

class TrackEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trackingData;
    /**
     * Create a new job instance.
     */
    public function __construct($trackingData)
    {
        $this->trackingData = $trackingData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $trackingData = $this->trackingData;
        //get country code for the ip in this trackingData, store the data in DB as per requirement.
        //Cache the ip API, to avoid duplicate calls.

        $trackingData = new CampaignTracking();
        $trackingData->record_date = '2023-05-23';
        $trackingData->country_code = 'USA';
        $trackingData->campaign_id = 1;
        $trackingData->creative_id = 1;
        $trackingData->browser_id = 1;
        $trackingData->device_id = 1;
        $trackingData->count = 10;
        $trackingData->save();
    }
}
