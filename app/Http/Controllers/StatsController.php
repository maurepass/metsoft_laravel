<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Offers\Offer;
use App\Models\Offers\Detail;
use App\Models\Offers\OfferStatus;
use App\Models\Offers\MaterialGroup;
use App\AuthGroup;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (isset($request->date_stats_from)) {
            $date_stats_from = $request->date_stats_from;
            $date_stats_to = $request->date_stats_to;
        } else {
            $date_stats_from = date("Y-m-01");
            $date_stats_to = date('Y-m-d');
        }

        $offers = Offer::whereBetween('date_tech_out', [$date_stats_from, $date_stats_to])->get();
        $tech_users = AuthGroup::find(2)->user;
        $offer_statuses = OfferStatus::All();
        $mat_groups = MaterialGroup::All();
        $details = Detail::whereBetween('date_tech_out', [$date_stats_from, $date_stats_to])->join('offers', 'offers.id', '=', 'details.offer_id')->get();

        // offers stats by technologists
        foreach ($tech_users as $key => $tech) {
            $tech_stats[] = [
                'tech' => $tech->first_name,
                'amount' => 0,
                'avg_days' => 0,
                'in_time' => 0,
                'det_amt' => 0,
            ];
            foreach ($offers as $offer) {
                if ($tech->id == $offer->user_tech_id) {
                    $tech_stats[$key]['amount']++;
                    $tech_stats[$key]['avg_days'] += $offer->days_amount;
                    if ($offer->days_amount < 8) {
                        $tech_stats[$key]['in_time']++;
                    }
                    $tech_stats[$key]['det_amt'] += $offer->positions_amount;
                }
            }
        }

        // offers stats by offer statuses
        foreach ($offer_statuses as $key => $of_status) {
            $statuses_stats[] = [
                'status' => $of_status->offer_status,
                'amount' => 0,
            ];
            foreach ($offers as $offer) {
                if ($of_status->id == $offer->status_id) {
                    $statuses_stats[$key]['amount']++;
                }
            }
        }

        // details status by material group
        foreach ($mat_groups as $key => $mat_group) {
            $detail_stats[] = [
                'mat_group' => $mat_group->mat_group,
                'amount' => 0,
            ];
            foreach ($details as $detail) {
                if ($mat_group->id == $detail->material->mat_group_id) {
                    $detail_stats[$key]['amount']++;
                }
            }
        }

        $this->insertLog('stats');

        return view('offers.stats', compact('date_stats_from', 'date_stats_to', 'tech_stats', 'detail_stats', 'statuses_stats'));
    }
}
