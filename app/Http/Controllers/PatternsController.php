<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patterns\Pattern;
use App\Models\Patterns\PatternStatus;
use App\Models\Patterns\PatternHistory;
use DB;
use DateTime;
use DateInterval;
use DataTables;

class PatternsController extends Controller
{
    private $pattern;

    public function __construct(Pattern $pattern)
    {
        $this->pattern = $pattern;
        /*
        $this->middleware('modelarnia',['only' => ['create', 'edit']]);
        $this->middleware('auth',['only' => ['create', 'edit']]);
        */
    }

    public function index()
    {
        return view('patterns.patterns');
    }

    public function getDataIndex()
    {
        $query = $this->pattern->with('pattern_status')->select('patterns.*');
        return Datatables::of($query)->make(true);
    }

    public function create()
    {
        $statuses = PatternStatus::all();
        return view('/patterns/pattern_create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $this->pattern->create($request->all());
        $last_id = $this->pattern->orderBy('id', 'desc')->first();

        PatternHistory::create([
            'pattern_id'    => $last_id->id,
            'status_id'     => $request->status_id,
            'date'          => $request->move_in
        ]);

        return redirect()->route('patterns.index');
    }

    public function show($id)
    {
        $pattern = $this->pattern->find($id);
        $statuses = PatternStatus::all();
        $operations = PatternHistory::where('pattern_id', '=', $id)->get();
        return view('patterns.pattern_show', compact('pattern', 'statuses', 'operations'));
    }

    public function edit($id)
    {
        $pattern = $this->pattern->find($id);
        $statuses = PatternStatus::all();
        return view('/patterns/pattern_edit', compact('pattern', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $pattern = $this->pattern->find($id);
        $pattern->fill($request->input());
        $pattern->save();

        if (isset($request->status_id) && isset($request->move_in)) {
            $last_status = PatternHistory::orderBy('id', 'desc')->where('pattern_id', '=', $id)->first();

            if (!isset($last_status) || $last_status->status_id != $request->status_id) {
                PatternHistory::create([
                    'pattern_id'    => $id,
                    'status_id'     => $request->status_id,
                    'date'          => $request->move_in
                ]);
            }
                
            if (isset($last_status) && $last_status->status_id == $request->status_id && $last_status->date != $request->move_in) {
                PatternHistory::where('id', $last_status->id)->update(['date'=>$request->move_in]);
            }
        }

        $this->insertLog('patterns update');
        return redirect()->route('patterns.index');
    }

    public function changeStatus($id)
    {
        $pattern = $this->pattern->find($id);
        $statuses = PatternStatus::all();
        return view('patterns.status_change', compact('pattern', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $last_status = PatternHistory::orderBy('id', 'desc')->where('pattern_id', '=', $id)->first();

        if (!isset($last_status) || $last_status->status_id != $request->status_id) {
            PatternHistory::create([
                                'pattern_id' => $id,
                                'status_id' => $request->status_id,
                                'date' => $request->move_in
                            ]);
            $pattern = $this->pattern->find($id);
            $pattern->fill([
                    'status_id' => $request->status_id,
                    'move_in'   => $request->move_in
                ])
                ->save();
        }
        return redirect()->route('patterns.index');
    }

    // public function search()
    // {
    //     return view('patterns.patterns_search');
    // }

    // public function search_results(Request $request)
    // {
    //     $customer       = $request->input('customer');
    //     $drawing_number = $request->input('drawing_number');
    //     $pattern_name   = $request->input('pattern_name');
    //     $layer_number   = $request->input('layer_number');
    //     $layer_place    = $request->input('layer_place');
    //     $cart_number    = $request->input('cart_number');
    //     $pattern_index  = $request->input('pattern_index');
    //     $notusing_time  = $request->input('notusing_time');

    //     if(!isset($notusing_time)) {
    //         $notusing_time=0;
    //     }
               
    //     $date = new DateTime();
    //     $date->sub(new DateInterval('P' . $notusing_time . 'M'));

    //     if ($notusing_time != 0) {
    //         $patterns = $this->pattern
    //             ->selectRaw('*, timestampdiff(month, last_order, curdate()) as time' )
    //             ->where('customer', 'like', '%'.$customer.'%')
    //             ->when($drawing_number, function ($query) use ($drawing_number) {
    //                 return $query->where('drawing_number', 'like', '%' . $drawing_number . '%');
    //             })
    //             ->when($pattern_name, function ($query) use ($pattern_name) {
    //                 return $query->where('pattern_name', 'like', '%'.$pattern_name.'%');
    //             })
    //             ->when($layer_number, function ($query) use ($layer_number) {
    //                 return $query->where('layer_number', 'like', '%'.$layer_number.'%');
    //             })
    //             ->when($layer_place, function ($query) use ($layer_place) {
    //                 return $query->where('layer_place', 'like', '%'.$layer_place.'%');
    //             })
    //             ->when($cart_number, function ($query) use ($cart_number) {
    //                 return $query->where('cart_number', 'like', '%'.$cart_number.'%');
    //             })
    //             ->when($pattern_index, function ($query) use ($pattern_index) {
    //                 return $query->where('pattern_index', 'like', '%'.$pattern_index.'%');
    //             })
    //             ->where('last_order', '<', $date)
    //             ->get();
    //     } else {
    //         $patterns = $this->pattern
    //             ->selectRaw('*, timestampdiff(month, last_order, curdate()) as time' )
    //             ->where('customer', 'like', '%'.$customer.'%')
    //             ->when($drawing_number, function ($query) use ($drawing_number) {
    //                 return $query->where('drawing_number', 'like', '%'.$drawing_number.'%');
    //             })
    //             ->when($pattern_name, function ($query) use ($pattern_name) {
    //                 return $query->where('pattern_name', 'like', '%'.$pattern_name.'%');
    //             })
    //             ->when($layer_number, function ($query) use ($layer_number) {
    //                 return $query->where('layer_number', 'like', '%'.$layer_number.'%');
    //             })
    //             ->when($layer_place, function ($query) use ($layer_place) {
    //                 return $query->where('layer_place', 'like', '%'.$layer_place.'%');
    //             })
    //             ->when($cart_number, function ($query) use ($cart_number) {
    //                 return $query->where('cart_number', 'like', '%'.$cart_number.'%');
    //             })
    //             ->when($pattern_index, function ($query) use ($pattern_index) {
    //                 return $query->where('pattern_index', 'like', '%'.$pattern_index.'%');
    //             })
    //             ->get();
    //     }

    //     $statuses = PatternStatus::all();

    //     return view('patterns.patterns_search_results', compact('patterns', 'statuses'));
    // }


    public function raport()
    {
        return view('patterns.patterns_report_form');
    }


    public function raport_show(Request $request)
    {
        $this->validate($request, [
            'customer1' => 'required',
        ]);

        $customer1 = $request->input('customer1');

        $customer2 = $request->input('customer2');
        if (!isset($customer2)) {
            $customer2 = $customer1;
        }

        $customer3 = $request->input('customer3');
        if (!isset($customer3)) {
            $customer3= $customer1;
        }
        
        // $notusing_time = $request->input('notusing_time');
        // if (!isset($notusing_time)) {
        //     $notusing_time = 0;
        // }
        
        // $date = new DateTime();
        // $date->sub(new DateInterval('P'.$notusing_time.'M'));

        // if ($notusing_time == 0) {
        //     $patterns = $this->pattern
        //     ->select('*', DB::raw('timestampdiff(month, last_order, curdate()) as time'))
        //     ->whereRaw('customer like ? or customer like ? or customer like ?', [$customer1, $customer2, $customer3])
        //     ->get();
        // } else {
        //     $patterns = $this->pattern
        //     ->select('*', DB::raw('timestampdiff(month, last_order, curdate()) as time'))
        //     ->whereRaw('last_order < ? and (customer like ? or customer like ? or customer like ?)', [$date, $customer1, $customer2, $customer3])
        //     ->get();
        // }

        $patterns = $this->pattern
            ->select('*', DB::raw('timestampdiff(month, last_order, curdate()) as time'))
            // ->where('customer', 'like', '%' . $customer1 . '%')
            ->whereRaw('customer like ? or customer like ? or customer like ?', ['%'.$customer1.'%', '%'.$customer2.'%', '%'.$customer3.'%'])
            ->get();

        $customers = $this->pattern
            ->select('customer')
            ->where('customer', 'like', '%' . $customer1 . '%')
            ->orWhere('customer', 'like', '%' . $customer2 . '%')
            ->orWhere('customer', 'like', '%' . $customer3 . '%')
            ->distinct()
            ->get();

        $this->insertLog('patterns raport show');

        return view('patterns.patterns_report_results', compact('patterns', 'customers'));
    }
}
