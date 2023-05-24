<?php

namespace App\Jobs;

use App\Http\Controllers\TrackingController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
    }
}
