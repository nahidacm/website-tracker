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
        Log::info($trackingData);
        // Log::info($countryCode);

        
        $record_date = Carbon::today();
        $country_code = GeoIP::getLocation($trackingData['cip'])->iso_code;
        // [$cid, $crid, $bid, $did] = $trackingData;
        // $trackingData;

        $campaignTracking = new CampaignTracking();
        $shouldIncreaseCount = CampaignTracking::where([
            'record_date' => $record_date,
            'country_code' => $country_code,
            'campaign_id' => $trackingData['cid'],
            'creative_id' => $trackingData['crid'],
            'browser_id' => $trackingData['bid'],
            'device_id' => $trackingData['did'],
        ])->first();

        if ($shouldIncreaseCount) {
            $campaignTracking->increment('count');
        }else {
            $campaignTracking->record_date = $record_date;
            $campaignTracking->country_code = $country_code;
            $campaignTracking->campaign_id = $trackingData['cid'];
            $campaignTracking->creative_id = $trackingData['crid'];
            $campaignTracking->browser_id = $trackingData['bid'];
            $campaignTracking->device_id = $trackingData['did'];
            $campaignTracking->count = 1;
            $campaignTracking->save();
        }  
    }
}
