<?php

namespace App\Http\Controllers;

use App\Models\GoogleAd;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
   function index() {
        $date_from = old("date_from");
        $date_to = old("date_to");
        $select_campaigns = old("campaigns", []);
        return view('report', [
            "googleAds" => [],
            "campaigns" => $this->getCampaigns(),
            "date_from" => $date_from,
            "date_to" => $date_to,
            "select_campaigns" => $select_campaigns
        ]);
   }

   function getReport(ReportRequest $request) {
        $campaigns = $request->input("campaigns", []);
        $date_from = $request->input("date_from");
        $date_to = $request->input("date_to");

        $ads = GoogleAd::selectRaw("
            campaign_state,
            campaign,
            SUM(cost) AS cost,
            SUM(impressions) AS impressions,
            SUM(clicks) AS clicks,
            SUM(conversions) AS conversions,
            ad_date,
            ROUND((SUM(cost)/(DATEDIFF(CAST('".$date_to."' as DATE), CAST('".$date_from."' as DATE))+1)), 2) AS cost_per_day,
            ROUND(SUM(cost)/SUM(clicks), 2) as cpc
        ")->whereBetween("ad_date", [$date_from, $date_to]);

        if(is_array($campaigns) &&  count($campaigns) > 0) {
            $ads->whereIn("campaign", $campaigns);
        }

        $googleAds = $ads->groupBy("campaign")->get();

        return view('report', [
            "googleAds" => $googleAds,
            "campaigns" => $this->getCampaigns(),
            "date_from" => $date_from,
            "date_to" => $date_to,
            "select_campaigns" => $campaigns
        ]);
    }

    public function getCampaigns() {
        return GoogleAd::distinct()->get(['campaign']);
    }
}
