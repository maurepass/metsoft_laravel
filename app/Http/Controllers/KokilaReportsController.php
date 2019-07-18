<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\Kokila\Operation;
use App\Models\Kokila\Cast;

class KokilaReportsController extends Controller
{
    public function raporty()
    {
        return view('kokila.raport_raporty');
    }

    public function getIndexOdbiory()
    {
        $this->insertLog('odbiory');
        return view('kokila.raport_odbiory');
    }

    public function getDataOdbiory()
    {
        $query = Operation::with('cast', 'cast.porder', 'cast.material', 'cast.porder.customer')
                            ->where([
                                ['id_opdict', 38],
                                ['completion_date1', '<>', '']
                                ]);

        return Datatables::of($query)->make(true);
    }

    public function getIndexZalania()
    {
        $this->insertLog('zalania');
        return view('kokila.raport_zalania');
    }

    public function getDataZalania()
    {
        $query = Operation::with('cast', 'cast.porder', 'cast.material', 'cast.porder.customer')
                            ->where([
                                ['id_opdict', 6],
                                ['completion_date1', '<>', '']
                            ]);

        return Datatables::of($query)->make(true);
    }

    public function getIndexNiezgodnosci()
    {
        $this->insertLog('niezgodnosci');
        return view('kokila.raport_niezgodnosci');
    }

    public function getDataNiezgodnosci()
    {
        $query = Operation::with('cast', 'cast.porder', 'cast.material', 'cast.porder.customer', 'operation_dict')
                            ->where('accordance', 3);

        return Datatables::of($query)->make(true);
    }

    public function getIndexUwagi()
    {
        $this->insertLog('uwagi');
        return view('kokila.raport_uwagi');
    }

    public function getDataUwagi()
    {
        $query = Operation::with('cast', 'cast.porder', 'cast.material', 'cast.porder.customer', 'operation_dict', 'accordance_dict')
                            ->whereNotNull('operations.notes')
                            ->where('operations.notes', '<>', '');

        return Datatables::of($query)->make(true);
    }

    public function weightperclient()
    {
        $casts = Cast::selectRaw('
                                customer,
                                sum(case when cast_status=1 then cast_weight end) as nowe,
                                sum(case when cast_status=7 then cast_weight end) as w_planowaniu,
                                sum(case when cast_status=2 then cast_weight end) as zalane,
                                sum(case when cast_status=3 then cast_weight end) as odebrane,
                                sum(case when cast_status in (1,7,2,3) then cast_weight end) as tonaz
                                ')
                        ->groupBy('customer')
                        ->whereNotIn('cast_status', [4, 5, 6])
                        ->orderBy('tonaz', 'desc')
                        ->get();
        
        $this->insertLog('weightperclient');
        return view('kokila.raport_weightperclient', compact('casts'));
    }

    public function weightpergroup()
    {
        $casts = Cast::selectRaw('mat_calc_group, sum(cast_weight) as tonaz')
                    ->groupBy('mat_calc_group')
                    ->whereNotIn('cast_status', [3, 4, 5, 6])
                    ->get();

        $this->insertLog('weightpergroup');
        return view('kokila.raport_weightpergroup', compact('casts'));
    }

    public function wybraki()
    {
        $casts = Cast::where('cast_status', 5)->orderBy('updated_at')->get();
        $this->insertLog('wybraki');

        return view('kokila.raport_wybraki', compact('casts'));
    }

    public function getIndexWagiOdlewów()
    {
        $this->insertLog('wagiodlewow');
        return view('kokila.raport_wagiodlewow');
    }

    public function getDataWagiOdlewów()
    {
        $query = Operation::with('cast', 'cast.porder', 'cast.material')
                            ->where([
                                ['id_opdict', 51],
                                ['completion_date1', '<>', '']
                            ]);

        return Datatables::of($query)->make(true);
    }

    public function monitoring_inwork()
    {
        $casts = Cast::selectRaw('
                                numer_MET,
                                customer,
                                casts.cast_name as name,
                                picture_number,
                                cast_weight,
                                username,
                                termin_klienta,
                                cast_pcs,
                                materialname,
                                sum(case when cast_status=1 then 1 end) as nowy,
                                sum(case when cast_status=7 then 1 end) as w_planowaniu,
                                sum(case when cast_status=2 then 1 end) as zalane,
                                sum(case when cast_status=3 then 1 end) as odebrane,
                                sum(case when cast_status=6 then 1 end) as wyslane,
                                sum(case when cast_status=5 then 1 end) as wb,
                                sum(case when cast_status=4 then 1 end) as anulowane,
                                timestampdiff(day, curdate(), termin_klienta) as time
                                ')
                        ->join('porders', 'casts.id_po', '=', 'porders.id')
                        ->join('pocastords', 'pocastords.id', '=', 'casts.id_poc')
                        ->join('users', 'users.id', '=', 'casts.tech_generate')
                        ->join('materials', 'materials.id', '=', 'casts.cast_material')
                        ->groupBy('id_poc')
                        ->orderBy('id_poc', 'desc')
                        ->get();

        $this->insertLog('monitoring_inwork');
        return view('kokila.raport_monitoring_inwork', compact('casts'));
    }

    public function monitoring_all()
    {
        $casts = Cast::selectRaw('
                                numer_MET,
                                customer,
                                casts.cast_name as name,
                                picture_number,
                                cast_weight,
                                username,
                                termin_klienta,
                                cast_pcs,
                                materialname,
                                sum(case when cast_status=1 then 1 end) as nowy,
                                sum(case when cast_status=7 then 1 end) as w_planowaniu,
                                sum(case when cast_status=2 then 1 end) as zalane,
                                sum(case when cast_status=3 then 1 end) as odebrane,
                                sum(case when cast_status=6 then 1 end) as wyslane,
                                sum(case when cast_status=5 then 1 end) as wb,
                                sum(case when cast_status=4 then 1 end) as anulowane,
                                timestampdiff(day, curdate(), termin_klienta) as time
                                ')
                        ->join('porders', 'casts.id_po', '=', 'porders.id')
                        ->join('pocastords', 'pocastords.id', '=', 'casts.id_poc')
                        ->join('users', 'users.id', '=', 'casts.tech_generate')
                        ->join('materials', 'materials.id', '=', 'casts.cast_material')
                        ->groupBy('id_poc')
                        ->orderBy('id_poc', 'desc')
                        ->get();
        
        $this->insertLog('monitoring_all');
        return view('kokila.raport_monitoring_all', compact('casts'));
    }

    public function czaswykonania_search()
    {
        $this->insertLog('czaswykonania_search');
        return view('kokila.raport_czaswykonania_search');
    }

    public function czaswykonania_results(Request $request)
    {
        $met_number     = $request->input('met_number');
        $company        = $request->input('company');
        $cast_name      = $request->input('cast_name');
        $picture_number = $request->input('picture_number');

        $casts= Cast::selectRaw('
                                casts.id as casting_id
                                ,numer_MET
                                ,company
                                ,cast_name
                                ,picture_number
                                ,pc_number
                                ,casts.created_at as utworzono
                                ,max(case when id_opdict=5 then completion_date1 end) as formowanie
                                ,max(case when id_opdict=6 then completion_date1 end) as zalanie
                                ,max(case when id_opdict=38 then completion_date1 end) as odbior
                                ')
                    ->join('porders', 'porders.id', '=', 'casts.id_po')
                    ->join('customers', 'customers.id', '=', 'porders.zamawiajacy')
                    ->join('operations', 'operations.id_cast', '=', 'casts.id')
                    ->where([
                        ['numer_MET', 'like', '%' . $met_number . '%'],
                        ['company', 'like', '%' . $company . '%'],
                        ['cast_name', 'like', '%' . $cast_name . '%'],
                        ['picture_number', 'like', '%' . $picture_number . '%'],
                    ])
                    ->groupBy('casting_id')
                    ->limit('5000')
                    ->get();

        $this->insertLog('czaswykonania_results');
        return view('kokila.raport_czaswykonania_results', compact('casts'));
    }

    public function logs()
    {
        $logs = DB::table('logs')->orderBy('id', 'desc')->get();
        return view('kokila.raport_logs', compact('logs'));
    }
   
    public function stan_magazynowy()
    {
        $casts = Cast::where('cast_status', '=', 3)->orderBy('id', 'desc')->get();
        $this->insertLog('magazyn');
        
        return view('kokila.raport_magazyn', compact('casts'));
    }

    public function getIndexZaformowane()
    {
        $this->insertLog('zaformowane');
        return view('kokila.raport_zaformowane');
    }

    public function getDataZaformowane()
    {
        $query = Operation::with('cast.porder', 'cast.material', 'cast.porder.customer')
                            ->where([
                                ['id_opdict', 5],
                                ['completion_date1', '<>', '']
                            ]);
   
        return Datatables::of($query)->make(true);
    }
   
    public function getIndexBadaniaNDT()
    {
        $this->insertLog('badania_ndt');
        return view('kokila.raport_badania_ndt');
    }

    public function getDataBadaniaNDT()
    {
        $query = Operation::with('cast.porder', 'cast.material', 'cast.porder.customer', 'operation_dict')
                            ->where([
                                ['id_opdict', [10, 21, 22, 24, 25, 26, 28, 56]],
                                ['completion_date1', '<>', '']
                            ]);

        return Datatables::of($query)->make(true);
    }

    public function getIndexMachining()
    {
        $this->insertLog('machining');
        return view('kokila.raport_machining');
    }

    public function getDataMachining()
    {
        $query = Operation::with('cast', 'cast.porder', 'cast.material', 'cast.porder.customer', 'operation_dict')
                            ->where([
                                ['id_opdict', [19, 20, 64, 65, 82, 91]],
                                ['completion_date1', '<>', '']
                            ]);
   
        return Datatables::of($query)->make(true);
    }

    public function getIndexUzyski()
    {
        $this->insertLog('uzyski');
        return view('kokila.raport_uzyski');
    }

    public function getDataUzyski()
    {
        $query = Cast::with('porder', 'material')->where('pc_number', 1);
        return Datatables::of($query)->make(true);
    }

    public function inserted_datas(Request $request)
    {
        $casts = Cast::selectRaw('
                                casts.id as casting_id,
                                numer_MET,
                                company,
                                cast_name,
                                picture_number,
                                max(case when id_opdict=5 then parameter_value1 end) as nr_odlewu,
                                max(case when id_opdict=6 then parameter_value1 end) as nr_wytopu,
                                max(case when id_opdict=6 then parameter_value2 end) as temp_zalewania,
                                max(case when id_opdict=51 or id_opdict=43 then parameter_value1 end) as waga_odlewu,
                                max(case when id_opdict=91 then accordance end) as obr_mech,
                                cast_weight * 100 / material_need as uzysk
                                ')
                    ->join('porders', 'porders.id', '=', 'casts.id_po')
                    ->join('customers', 'customers.id', '=', 'porders.zamawiajacy')
                    ->join('operations', 'operations.id_cast', '=', 'casts.id')
                    ->groupBy('casting_id')
                    ->orderBy('casting_id', 'desc')
                    ->limit('5000')
                    ->get();

        $this->insertLog('inserted_datas');

        return view('kokila.raport_inserted_datas', compact('casts'));
    }
}
