<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrackEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trackingData;
    protected $campaign_tracking_table = 'campaign_tracking';
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
        $record_date = Carbon::today();
        $country_code = GeoIP::getLocation($trackingData['cip'])->iso_code;

        $builder = DB::table($this->campaign_tracking_table)
            ->where('record_date', $record_date)
            ->where('country_code', $country_code)
            ->where('campaign_id', $trackingData['cid'])
            ->where('creative_id', $trackingData['crid'])
            ->where('browser_id', $trackingData['bid'])
            ->where('device_id', $trackingData['did']);
        
        // Increment the count if the record already exists
        if ($builder->count()) {
            $builder->increment('count');
        } else {
            // Or add new entry
            DB::table($this->campaign_tracking_table)->insert(
                array(
                    "record_date"=>$record_date,
                    "country_code" => $country_code,
                    "campaign_id" => $trackingData['cid'],
                    "creative_id" => $trackingData['crid'],
                    "browser_id" => $trackingData['bid'],
                    "device_id" => $trackingData['did']
                )
            );
        } 
    }
}
