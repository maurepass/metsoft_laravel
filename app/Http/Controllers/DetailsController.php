<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Offers\Offer;
use App\Models\Offers\Detail;
use App\Models\Offers\Material;
use App\Models\Offers\OfferStatus;
use Yajra\Datatables\Datatables;
use DB;

class DetailsController extends Controller
{
    private $detail;
    private $offer;

    public function __construct(Detail $detail, Offer $offer)
    {
        $this->detail = $detail;
        $this->offer = $offer;
        $this->middleware('auth', ['except' => ['getIndexDetails', 'getDataDetails']]);
    }

    protected function getParameters()
    {
        $materials = Material::orderBy('material')->get();
        $pattern_statuses = DB::table('offer_pattern_statuses')->get();
        $machinings = DB::table('machinings')->get();
        $heat_treatments = DB::table('heat_treatments')->get();
        $pattern_tapers = DB::table('pattern_tapers')->get();
        $atest_types = DB::table('atest_types')->get();

        return compact('materials', 'pattern_statuses', 'machinings', 'heat_treatments', 'pattern_tapers', 'atest_types');
    }
    
    public function index($id)
    {
        session()->put('offer_id', $id);
        $offer = $this->offer->find($id);
        $details = $offer->detail;
        $statuses = OfferStatus::all();
        $uwagi = Storage::get('/public/uwagi.txt');

        return view('offers.offer_details', compact('offer', 'details', 'statuses', 'uwagi'));
    }

    public function create(Request $request, $offer_id)
    {
        $parameters = $this->getParameters();

        if ($request->get('add_detail') == 'steel') {
            $mat_type = 'steel';
        } else {
            $mat_type = 'iron';
        };

        return view('offers.detail_create', compact('offer_id', 'mat_type', 'parameters'));
    }

    public function store(Request $request, $id)
    {
        $this->detail->create($request->all());
        $offer = $this->offer->find($id);
        $offer->positions_amount++;
        $offer->save();

        return redirect()->route('offers.details.index', ['offer' => $id]);
    }

    public function show($id)
    {
        return redirect()->route('offers.index');
    }

    public function edit($offer_id, $id)
    {
        $detail = $this->detail->find($id);
        $parameters = $this->getParameters();
        return view('offers.detail_edit', compact('detail', 'parameters', 'offer_id'));
    }

    public function update(Request $request, $offer_id, $id)
    {
        if ($request->get('action') == 'save') {
            $detail=$this->detail->find($id);
            $detail->fill($request->input())->save();
            
            return redirect()->route('offers.details.index', ['offer' => $offer_id]);
        } elseif ($request->get('action') == 'save_as_new') {
            $this->detail->create($request->all());
            $offer = $this->offer->find($offer_id);
            $offer->positions_amount++;
            $offer->save();

            return redirect()->route('offers.details.index', ['offer' => $offer_id]);
        }
    }

    public function destroy($offer_id, $id)
    {
        $detail = $this->detail->find($id);
        $detail->delete();
        $offer = $this->offer->find($offer_id);
        $offer->positions_amount--;
        $offer->save();
        
        return redirect()->route('offers.details.index', ['offer' => $offer_id]);
    }

    public function getIndexDetails()
    {
        $this->insertLog('details_all');
        return view('offers.details');
    }

    public function getDataDetails()
    {
        $query = Detail::with('offer', 'material');
        return Datatables::of($query)->make(true);
    }
}
