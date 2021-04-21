<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PiutangController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        
        return view('layouts.Piutang');

    }

    public function getSummaryPiutang(Request $request){

        $mill = $request->mill;
        $customer = $request->customer;
        $paid = $request->paid;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $byWhat = $request->byWhat;
        $where = "";
        $where.= "1=1";
        if ($customer) {

            $where.= " and cust_id = '$customer'";
        }

        if ($paid) {

            $where.= " and paid_flag = '$paid'";
        }

        if ($byWhat == 'byDateInv') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_inv = '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_inv = '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_inv between '$dt_start' and '$dt_end'";
            }

        }

        if ($byWhat == 'byDueDate') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_due = '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_due = '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_due between '$dt_start' and '$dt_end'";
            }

        }


        switch ($mill) {

            case "SR":

                    $data = DB::connection("sqlsrv2")
                            ->table('view_piutang')
                            ->selectRaw("cast(count(inv_id) as float) as total_inv, cust_name, cast(sum(amt_total) as float) as amt_total, cast(sum(amt_paid) as float) as amt_paid,
                            cast(count(paid_flag) as float) as total_paid, paid_flag, cast(sum(Piutang) as float) as total_piutang")
                            ->whereRaw($where)
                            ->groupBy('cust_id')
                            ->groupBy('cust_name')
                            ->groupBy('paid_flag')
                            ->orderBy('total_inv', 'desc')
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


            case "SM":

                    $data = DB::connection("sqlsrv3")
                            ->table('view_piutang')
                            ->selectRaw("cast(count(inv_id) as float) as total_inv, cust_name, cast(sum(amt_total) as float) as amt_total, cast(sum(amt_paid) as float) as amt_paid,
                            cast(count(paid_flag) as float) as total_paid, paid_flag, cast(sum(Piutang) as float) as total_piutang")
                            ->whereRaw($where)
                            ->groupBy('cust_id')
                            ->groupBy('cust_name')
                            ->groupBy('paid_flag')
                            ->orderBy('total_inv', 'desc')
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

            return redirect('layouts.Piutang')->with("alert", "Wrong Mill ID!");

        }





    }

    public function getOverviewPiutang(Request $request){

        $mill = $request->mill;
        $customer = $request->customer;
        $paid = $request->paid;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $byWhat = $request->byWhat;
        $where = "";
        $where.= "1=1";
        if ($customer) {

            $where.= " and cust_id = '$customer'";
        }

        if ($paid) {

            $where.= " and paid_flag = '$paid'";
        }

        if ($byWhat == 'byDateInv') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_inv = '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_inv = '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_inv between '$dt_start' and '$dt_end'";
            }

        }

        if ($byWhat == 'byDueDate') {

            if ($dt_start && !$dt_end) {

                $where.= " and dt_due = '$dt_start'";
            }
    
            if (!$dt_start && $dt_end) {
    
                $where.= " and dt_due = '$dt_end'";
            }
    
            if ($dt_start && $dt_end) {
    
                $where.= " and dt_due between '$dt_start' and '$dt_end'";
            }

        }


        switch ($mill) {

            case "SR":

                    $data = DB::connection("sqlsrv2")
                            ->table('view_piutang')
                            ->selectRaw("cust_name, 
                            inv_id, order_id, 
                            FORMAT(dt_inv, 'dd MMM yyyy') as dt_inv,
                            FORMAT(dt_due, 'dd MMM yyyy') as dt_due,
                            salesman_name, 
                            cast(amt_total as float) as amt_total , 
                            cast(amt_disc_pay as float) as amt_disc_pay,  
                            cast(amt_paid as float) as amt_paid,
                            cast(amt_retur as float) as amt_retur, 
                            paid_flag, 
                            cast(Piutang as float) as Piutang")
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


                    //echo $byDateInv.", ".$byDueDate;



            break;


            case "SM":
                    
                    $data = DB::connection("sqlsrv3")
                            ->table('view_hutang')
                            ->selectRaw("cust_name, 
                            inv_id, order_id, 
                            FORMAT(dt_inv, 'dd MMM yyyy') as dt_inv,
                            FORMAT(dt_due, 'dd MMM yyyy') as dt_due,
                            salesman_name, 
                            cast(amt_total as float) as amt_total , 
                            cast(amt_disc_pay as float) as amt_disc_pay,  
                            cast(amt_paid as float) as amt_paid,
                            cast(amt_retur as float) as amt_retur, 
                            paid_flag, 
                            cast(Piutang as float) as Piutang")
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

            return redirect('layouts.Piutang')->with("alert", "Wrong Mill ID!");

        }





    }
}
