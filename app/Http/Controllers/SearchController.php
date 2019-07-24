<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Offers\Offer;
use App\Models\Offers\Detail;
use App\Models\Offers\Material;
use DB;

class SearchController extends Controller
{
    private $detail;
    private $offer;

    public function __construct(Detail $detail, Offer $offer)
    {
        $this->detail = $detail;
        $this->offer = $offer;
        //$this->middleware('auth');
    }

    public function searchDetail()
    {
        $this->insertLog('search detail');
        return view('offers.detail_searching_form');
    }

    public function searchDetailResults(Request $request)
    {
        $drawing_no = $request->input('drawing_no');
        $cast_name = $request->input('cast_name');
        $materials = Material::all();

        $details = $this->detail
            ->where('drawing_no', 'like', '%' . $drawing_no . '%')
            ->where('cast_name', 'like', '%' . $cast_name . '%')
            ->orderBy('id', 'desc')
            ->get();
        
        return view('offers.detail_searching_results', compact('details', 'materials'));
    }
}
