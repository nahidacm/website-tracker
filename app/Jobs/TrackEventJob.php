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
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

        // $countryCode = GeoIP::getLocation($trackingData['cip'])->iso_code;
        // Log::info($trackingData);
        // Log::info($countryCode);

        $campaignTracking = new CampaignTracking();
        $campaignTracking->record_date = Carbon::today(); // @ToDo Confirm timezone and format
        $campaignTracking->country_code = GeoIP::getLocation($trackingData['cip'])->iso_code;
        $campaignTracking->campaign_id = 1;
        $campaignTracking->creative_id = 1;
        $campaignTracking->browser_id = 1;
        $campaignTracking->device_id = 1;
        $campaignTracking->count = 10;
        $campaignTracking->save();
    }
}
