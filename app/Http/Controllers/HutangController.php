<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class HutangController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        
        return view('layouts.Hutang');

    }

    public function getAllSummaryHutang(Request $request){

        $mill = $request->mill;
        $vendor = $request->vendor;
        $paid = $request->paid;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $byWhat = $request->byWhat;
        $where = "";
        $where.= "1=1";
        if ($vendor) {

            $where.= " and vendor_id = '$vendor'";
        }

        if ($paid) {

            $where.= " and paid_flag = '$paid'";
        }

        if ($byWhat == 'byDateInv') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_inv >= '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_inv <= '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_inv between '$dt_start' and '$dt_end'";
            }

        }

        if ($byWhat == 'byDueDate') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_due >= '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_due <= '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_due between '$dt_start' and '$dt_end'";
            }

        }


        switch ($mill) {

            case "SR":

                try{

                    $data = DB::connection("sqlsrv2")
                                ->select(DB::raw("select sum(total_inv) as total_inv, sum(amt_total) as amt_total, sum(amt_paid) as amt_paid,
                                sum(total_paid) as total_paid, sum(total_hutang) as total_hutang
                                from
                                (select cast(count(inv_id) as float) as total_inv, vendor_name, cast(sum(amt_total) as float) as amt_total, cast(sum(amt_paid) as float) as amt_paid,
                                cast(count(paid_flag) as float) as total_paid, paid_flag, cast(sum(hutang) as float) as total_hutang from view_hutang
                                where $where
                                group by vendor_id, vendor_name, paid_flag) x"));
        
                    
                    return response()->json($data);
                }
                catch(QueryException $ex){
                    $error = $ex->getMessage();
                    return response()->json(['error' => $error]);
                }

                    

            break;


            case "SM":

                try{

                    $data = DB::connection("sqlsrv3")
                                ->select(DB::raw("select sum(total_inv) as total_inv, sum(amt_total) as amt_total, sum(amt_paid) as amt_paid,
                                sum(total_paid) as total_paid, sum(total_hutang) as total_hutang
                                from
                                (select cast(count(inv_id) as float) as total_inv, vendor_name, cast(sum(amt_total) as float) as amt_total, cast(sum(amt_paid) as float) as amt_paid,
                                cast(count(paid_flag) as float) as total_paid, paid_flag, cast(sum(hutang) as float) as total_hutang from view_hutang
                                where $where
                                group by vendor_id, vendor_name, paid_flag) x"));
        
                    
                    return response()->json($data);
                }
                catch(QueryException $ex){
                    $error = $ex->getMessage();
                    return response()->json(['error' => $error]);
                }

                   
            break;

            default:

            return redirect('layouts.Hutang')->with("alert", "Wrong Mill ID!");

        }
    }

    public function getSummaryHutang(Request $request){

        $mill = $request->mill;
        $vendor = $request->vendor;
        $paid = $request->paid;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $byWhat = $request->byWhat;
        $where = "";
        $where.= "1=1";
        if ($vendor) {

            $where.= " and vendor_id = '$vendor'";
        }

        if ($paid) {

            $where.= " and paid_flag = '$paid'";
        }

        if ($byWhat == 'byDateInv') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_inv >= '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_inv <= '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_inv between '$dt_start' and '$dt_end'";
            }

        }

        if ($byWhat == 'byDueDate') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_due >= '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_due <= '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_due between '$dt_start' and '$dt_end'";
            }

        }
        


        switch ($mill) {

            case "SR":

                $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select cast(count(inv_id) as float) as total_inv, vendor_id, vendor_name, cast(sum(amt_total) as float) as amt_total, cast(sum(amt_paid) as float) as amt_paid,
                        cast(count(paid_flag) as float) as total_paid, paid_flag, cast(sum(hutang) as float) as total_hutang from view_hutang
                        where $where
                        group by vendor_id, vendor_name, paid_flag"));

                    return \DataTables::of($data)
                    ->editColumn('paid_flag', function ($data) {
                        if ($data->paid_flag == "Y") return '<span class="chip lighten-5 green green-text">Y</span>';
                        if ($data->paid_flag == "N") return '<span class="chip lighten-5 red red-text">N</span>';
                        return '<span class="chip lighten-5 grey black-text">N/A</span>';
                    })
                    ->addColumn('Detail', function($data) {
                        return
                        '<a href="javascript:void(0)" data-target="detail" class="blue-text detail tooltipped modal-trigger" data-position="top" data-tooltip="Detail" data-id1="'.$data->vendor_id.'" data-id2="'.$data->vendor_name.'">
                            <i class="material-icons">remove_red_eye</i>
                        </a>
                        ';
                    })
                    ->rawColumns(['paid_flag','Detail'])
                    ->make(true);


            break;


            case "SM":

               
                $data = DB::connection("sqlsrv3")
                        ->select(DB::raw("select cast(count(inv_id) as float) as total_inv, vendor_id, vendor_name, cast(sum(amt_total) as float) as amt_total, cast(sum(amt_paid) as float) as amt_paid,
                        cast(count(paid_flag) as float) as total_paid, paid_flag, cast(sum(hutang) as float) as total_hutang from view_hutang
                        where $where
                        group by vendor_id, vendor_name, paid_flag"));

                return \DataTables::of($data)
                ->editColumn('paid_flag', function ($data) {
                    if ($data->paid_flag == "Y") return '<span class="chip lighten-5 green green-text">Y</span>';
                    if ($data->paid_flag == "N") return '<span class="chip lighten-5 red red-text">N</span>';
                    return '<span class="chip lighten-5 grey black-text">N/A</span>';
                })
                ->addColumn('Detail', function($data) {
                    return
                    '<a href="javascript:void(0)" data-target="detail" class="blue-text detail tooltipped modal-trigger" data-position="top" data-tooltip="Detail" data-id1="'.$data->vendor_id.'" data-id2="'.$data->vendor_name.'">
                        <i class="material-icons">remove_red_eye</i>
                    </a>
                    ';
                })
                ->rawColumns(['paid_flag','Detail'])
                ->make(true);

            break;

            default:

            return redirect('layouts.Hutang')->with("alert", "Wrong Mill ID!");

        }





    }

    public function getOverviewHutang(Request $request){

        $mill = $request->mill;
        $vendor = $request->vendor;
        $paid = $request->paid;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $byWhat = $request->byWhat;
        $where = "";
        $where.= "1=1";
        if ($vendor) {

            $where.= " and vendor_id = '$vendor'";
        }

        if ($paid) {

            $where.= " and paid_flag = '$paid'";
        }

        if ($byWhat == 'byDateInv') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_inv >= '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_inv <= '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_inv between '$dt_start' and '$dt_end'";
            }

        }

        if ($byWhat == 'byDueDate') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_due >= '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_due <= '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_due between '$dt_start' and '$dt_end'";
            }

        }

        switch ($mill) {

            case "SR":

                    $data = DB::connection("sqlsrv2")
                            ->table('view_hutang')
                            ->selectRaw("vendor_name, 
                            tr_id, inv_id, 
                            FORMAT(dt_inv, 'dd MMM yyyy') as dt_inv,
                            FORMAT(dt_due, 'dd MMM yyyy') as dt_due,
                            curr_id,
                            cast(exchange_rate as float) as exchange_rate,
                            cast(amt_total as float) as amt_total , 
                            cast(amt_paid_disc as float) as amt_paid_disc,  
                            cast(amt_paid as float) as amt_paid,
                            pay_term_id, 
                            paid_flag, 
                            round(cast(hutang as float), 2) as hutang")
                            ->whereRaw($where)
                            ->orderBy('dt_inv', 'desc')
                            ->get();

                    return \DataTables::of($data)
                    ->editColumn('paid_flag', function ($data) {
                        if ($data->paid_flag == "Y") return '<span class="chip lighten-5 green green-text">Y</span>';
                        if ($data->paid_flag == "N") return '<span class="chip lighten-5 red red-text">N</span>';
                        return '<span class="chip lighten-5 grey black-text">N/A</span>';
                    })
                    ->rawColumns(['paid_flag'])
                    ->make(true);

                    // echo $where;

            break;


            case "SM":
                    
                    $data = DB::connection("sqlsrv3")
                            ->table('view_hutang')
                            ->selectRaw("vendor_name, 
                            tr_id, inv_id, 
                            FORMAT(dt_inv, 'dd MMM yyyy') as dt_inv,
                            FORMAT(dt_due, 'dd MMM yyyy') as dt_due,
                            curr_id,
                            cast(exchange_rate as float) as exchange_rate,
                            cast(amt_total as float) as amt_total , 
                            cast(amt_paid_disc as float) as amt_paid_disc,  
                            cast(amt_paid as float) as amt_paid,
                            pay_term_id, 
                            paid_flag, 
                            round(cast(hutang as float), 2) as hutang")
                            ->whereRaw($where)
                            ->orderBy('dt_inv', 'desc')
                            ->get();

                    return \DataTables::of($data)
                    ->editColumn('paid_flag', function ($data) {
                        if ($data->paid_flag == "Y") return '<span class="chip lighten-5 green green-text">Y</span>';
                        if ($data->paid_flag == "N") return '<span class="chip lighten-5 red red-text">N</span>';
                        return '<span class="chip lighten-5 grey black-text">N/A</span>';
                    })
                    ->rawColumns(['paid_flag'])
                    ->make(true);

            break;

            default:

            return redirect('layouts.Hutang')->with("alert", "Wrong Mill ID!");

        }





    }
}
