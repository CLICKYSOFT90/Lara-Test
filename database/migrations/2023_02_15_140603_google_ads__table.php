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
        Schema::create('google_ads', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_state');
            $table->string('campaign');
            $table->string('campaign_status');
            $table->float('budget', 8, 2);
            $table->string('campaign_type');
            $table->date('ad_date');
            $table->string('campaign_bid_strategy_type');
            $table->string('currency_code', 3);
            $table->integer('impressions');
            $table->integer('clicks');
            $table->float('cost', 8, 2);
            $table->integer('conversions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
