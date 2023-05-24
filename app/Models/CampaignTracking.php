<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignTracking extends Model
{
    protected $table = 'campaign_tracking';
    protected $primaryKey = null; // Assuming there is no primary key for this table
    public $incrementing = false; // Assuming there is no auto-incrementing primary key
    public $timestamps = false;

    protected $fillable = [
        'record_date',
        'country_code',
        'campaign_id',
        'creative_id',
        'browser_id',
        'device_id',
        'count'
    ];
}
