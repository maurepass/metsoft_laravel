<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatus;
use App\Models\Kokila\PoCastOrds;
use App\AuthGroup;
use Yajra\Datatables\Datatables;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit']]);
    }

    protected function update_orders_table()
    {
        $last_id = PoCastOrds::max('id');
        $last_id_poc = Order::max('id_poc');

        if ($last_id_poc == null) {
            $last_id_poc = $last_id-10;
        }

        if ($last_id > $last_id_poc) {

            // add new records and update last 50
            $orders = PoCastOrds::with('porder', 'porder.customer')->where('id', '>', $last_id_poc-50)->get();
            
            foreach ($orders as $order) {
                Order::updateOrCreate(
                    ['id_poc' => $order->id],
                    ['numer_MET' => $order->porder->numer_MET,
                    'company' => $order->porder->customer->company,
                    'cast_name' => $order->cast_name,
                    'cast_pcs' => $order->cast_pcs,
                    'pict_number' => $order->pict_number,
                    'cust_material' => $order->cust_material,
                    'termin_klienta' => $order->porder->termin_klienta,
                    'model' => $order->model,
                    'rawcast' => $order->rawcast,
                    'painting' => $order->painting,
                    'mechrough' => $order->mechrough,
                    'mechfine' => $order->mechfine,
                    'marketing' => $order->porder->wprowadzajacy_id,
                    'ord_in' => $order->created_at,
                    ]
                );
            }
        }
    }

    public function index()
    {
        $this->update_orders_table();
        return view('kokila.orders');
    }
   
    public function getIndexData()
    {
        $query = Order::with('tech_memb', 'ord_status')->select('orders.*');
        return Datatables::of($query)->make(true);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $statuses = OrderStatus::all();
        $technolodzy = AuthGroup::find(2)->user;

        return view('kokila.orders_edit', compact('order', 'statuses', 'technolodzy'));
    }

    public function update(Request $request, $id)
    {
        $user= auth()->user()->name;

        if ($request->status_id != 2 && $user != 'admin') {
            $request->ord_out = date('Y-m-d');
        }
        // if status "in work" then without working time
        if ($request->status_id == 2) {
            $working_time=null;
        } else {
            $working_time = round((strtotime($request->ord_out) - strtotime($request->ord_in))/(60*60*24));
        }

        Order::where('id', $id)
            ->update([
                'ord_out' => $request->ord_out,
                'tech_memb_id' => $request->tech_memb_id,
                'status_id' => $request->status_id,
                'uwagi'=>$request->uwagi,
                'working_time'=>$working_time,
                'important'=>$request->important
            ]);

        return redirect()->route('orders.index');
    }
}
