<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ActivityReportController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $salesid  = Session::get('SALESID');

        switch ($groupid) {

            case "SALES":

                $listsales = DB::connection("sqlsrv2")
                        ->table('salesman')
                        ->select('salesman_id', 'salesman_name')
                        ->where('salesman_id', '=', $salesid)
                        ->where('active_flag', '=', 'Y')
                        ->get();

                return view('layouts.ActivityReport',['listsales' => $listsales]);
                break;

            case "KOORDINATOR":

                $listsales = DB::connection("sqlsrv2")
                        ->table('salesman')
                        ->select('salesman_id', 'salesman_name')
                        ->where('active_flag', '=', 'Y')
                        ->get();

                return view('layouts.ActivityReport',['listsales' => $listsales]);
                break;

			case "MANAGEMENT":

                $listsales = DB::connection("sqlsrv2")
                        ->table('salesman')
                        ->select('salesman_id', 'salesman_name')
                        ->where('active_flag', '=', 'Y')
                        ->get();

                return view('layouts.ActivityReport',['listsales' => $listsales]);
                break;

            case "DEVELOPMENT":

                $listsales = DB::connection("sqlsrv2")
                        ->table('salesman')
                        ->select('salesman_id', 'salesman_name')
                        ->where('active_flag', '=', 'Y')
                        ->get();

                return view('layouts.ActivityReport',['listsales' => $listsales]);
                break;

            default:

                return redirect('home')->with("alert", "You are not allowed to view this page");
        }

    }

    public function getActivityReport(Request $request){
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $where = "";
        $where.= "where salesman.active_flag = 'Y'";

        if (isset($request->id)) {

            $where.= " and salesman.salesman_id = '$request->id'";
        }

        if ($dt_start && !$dt_end) {

            $where.= " and web_SalesActivity.tr_date between '$dt_start' and CAST('$dt_start' AS DATETIME) + 1";
        }

        if (!$dt_start && $dt_end) {

            $where.= " and web_SalesActivity.tr_date between '$dt_end' and CAST('$dt_end' AS DATETIME) + 1";
        }

        if ($dt_start && $dt_end) {

            $where.= " and web_SalesActivity.tr_date between '$dt_start' and '$dt_end'";
        }


        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("select salesman.salesman_id, salesman.salesman_name, web_SalesActivity.tr_id, web_SalesActivity.namacustomer, web_SalesActivity.alamat,
                web_SalesActivity.city, FORMAT(web_SalesActivity.tr_date, 'dd MMM yyyy - hh.mm tt') as tr_date, web_SalesActivity.sales_latitude, web_SalesActivity.sales_longitude
                from salesman
                inner join web_SalesActivity on salesman.salesman_id = web_SalesActivity.salesid"." ".$where."
                order by web_SalesActivity.tr_date desc"));

        return \DataTables::of($data)
        ->addColumn('GPSLog & Remark', function($data) {
            return '<a href="javascript:void(0)" data-target="remarkModal" id="getRemark" data-id="'.$data->tr_id.'"
            class="tooltipped modal-trigger" data-position="top" data-tooltip="View Detail" onclick="showMap('.$data->sales_latitude.','.$data->sales_longitude.')">
            <i class="material-icons">map</i></a>';
        })
        ->rawColumns(['GPSLog & Remark'])
        ->make(true);



    }

    public function getRemarkAll($id){

        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("select tr_id, namacustomer, alamat, city, sales_longitude, sales_latitude, remark,
                FORMAT(tr_date, 'dd MMM yyyy - hh.mm tt') as tr_date
                from web_SalesActivity
                where tr_id = '$id'"));

        foreach ($data as $data) {

        $html = "<h4>Visit Detail</h4>
                <p><strong>".$data->namacustomer." (".$data->tr_date.")</strong></p>
                <hr>
                <div class='form-group'>
                    <p><strong>GPS Log</strong></p>
                    <div id='map_canvas' style='height:200px; border: 1px solid black;'></div>
                </div>
                <input type='hidden' id='val_remark' value='".$data->remark."'>";
        }

        return response()->json(['html'=>$html]);



    }


}


