<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Offers\Offer;
use App\AuthUser;
use App\AuthGroup;
use DataTables;

class OffersController extends Controller
{
    private $offer;
  
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
        $this->middleware('auth', ['only' => ['create', 'edit']]);
    }

    public function index()
    {
        return view('offers.offers');
    }

    public function getDataIndex()
    {
        $query = Offer::with('offer_status', 'user_mark', 'user_tech')->select('offers.*');
        return Datatables::of($query)->make(true);
    }
   
    public function create()
    {
        $tech_members = AuthGroup::find(2)->user;
        $mark_members = AuthGroup::find(1)->user;

        $last_offer_no = $this->offer->take(1)->orderby('id', 'desc')->select('offer_no')->get();
        $table_with_offer_no = explode("/", $last_offer_no[0]->offer_no);
        $table_with_offer_no[0]++;

        return view('offers.offer_create', compact('tech_members', 'mark_members', 'table_with_offer_no'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['client' => 'required']);
        $this->offer->create($request->all());
        return redirect()->route('offers.index');
    }

    protected function string_from_array($variable)
        {
            $temp_dict = [];
            $end_str = '';

            // sorting by value
            foreach ($variable as $key => $value) {
                if (!in_array($value, array_keys($temp_dict))) {
                    $temp_dict[$value] = [$key + 1];
                } else {
                    array_push($temp_dict[$value], $key + 1);
                }
            }

            // making string from sorted data
            foreach (array_keys($temp_dict) as $key) {
                $end_str .= $key . ' <i> dla </i> ';
                foreach ($temp_dict[$key] as $value) {
                    $end_str .= $value . ',';
                }
                $end_str .= ';';
            }

            return $end_str;
        }

    public function show($id)
    {
        $offer = $this->offer->find($id);
        $details = $offer->detail;

        $machining = [];
        $tapers = [];
        $tolerances = [];
        $atest = [];

        foreach ($details as $detail) {
            $machining[] = $detail->machining->machining;
            $tapers[] = $detail->tapers;
            $tolerances[] = $detail->tolerances;
            $atest[] = $detail->atest;
        }

        $machining_show = $this->string_from_array($machining);
        $tapers_show = $this->string_from_array($tapers);
        $tolerances_show = $this->string_from_array($tolerances);
        $atest_show = $this->string_from_array($atest);

        return view('offers.offer_show', compact('offer', 'details', 'machining_show', 'tapers_show', 'tolerances_show', 'atest_show'));
    }

    public function edit($id)
    {
        // after saving edition move to offer index
        session()->put('offer_status', 'move_out');

        $offer = $this->offer->find($id);
        $tech_members = AuthGroup::find(2)->user;
        $mark_members = AuthGroup::find(1)->user;

        return view('offers.offer_edit', compact('offer', 'mark_members', 'tech_members'));
    }

    public function update(Request $request, $id)
    {
        $offer = $this->offer->find($id);
        $offer->fill($request->input());

        if ($request->status_id == 1) {
            $offer->date_tech_out = null;
        } else {
            $offer->days_amount = round((strtotime($offer->date_tech_out) - strtotime($offer->date_tech_in)) / (60*60*24));
        }
        
        $offer->save();

        // if offer status changed, move to offer index 
        if ($request->status_id) {
            session()->put('offer_status', 'move_out');
        }

        $offer_status = session()->get('offer_status');
        session()->put('offer_status', '');
        
        if ($offer_status == 'move_out') {
            return redirect()->route('offers.index');
        } else {
            return redirect()->route('offers.details.index', ['offer' => $id]);
        }
    }
}
