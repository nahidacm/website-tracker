<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_tracking', function (Blueprint $table) {
            $table->date('record_date');
            $table->char('country_code', 3);
            $table->integer('campaign_id');
            $table->integer('creative_id');
            $table->integer('browser_id');
            $table->integer('device_id');
            $table->bigInteger('count')->unsigned()->default(1);
            $table->primary(['record_date', 'country_code', 'campaign_id', 'creative_id', 'browser_id', 'device_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('campaign_tracking');
    }
};
