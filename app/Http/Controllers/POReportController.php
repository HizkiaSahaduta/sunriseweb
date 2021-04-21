<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class POReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('layouts.POReport');
    }

    public function getPOReport(Request $request){

        $mill = $request->mill;
        $status = $request->status;
        $vendor = $request->vendor;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $where = "";
        $where.= "1=1";
        if ($status) {

            $where.= " and stat = '$status'";
        }

        if ($vendor) {

            $where.= " and vendor_id = '$vendor'";
        }

        if ($dt_start && !$dt_end) {

            $where.= " and dt_po = '$dt_start'";
        }

        if (!$dt_start && $dt_end) {

            $where.= " and dt_po = '$dt_end'";
        }

        if ($dt_start && $dt_end) {

            $where.= " and dt_po between '$dt_start' and '$dt_end'";
        }


        switch ($mill) {

            case "SR":

                    $data = DB::connection("sqlsrv2")
                            ->table('view_po_dtl')
                            ->selectRaw("FORMAT(dt_po, 'dd MMM yyyy') as dt_po,
                            po_id, po_item, vendor_name, prod_code, descr, item_desc1, stat,
                            cast(qty as float) as qty,
                            cast(wgt as float) as wgt,
                            unit_meas,
                            cast(unit_price as float) as unit_price,
                            curr_id,
                            cast(amt_net as float) as amt_net,
                            cast(qty_recive as float) as qty_recive,
                            cast(wgt_recive as float) as wgt_recive")
                            ->whereRaw($where)
                            ->orderBy('dt_po', 'ASC')
                            ->get();

                    return \DataTables::of($data)
                    ->editColumn('stat', function ($data) {
                        if ($data->stat == "O") return '<span class="chip lighten-5 grey black-text center">O</span>';
                        if ($data->stat == "R") return '<span class="chip lighten-5 green green-text center">R</span>';
                        if ($data->stat == "C") return '<span class="chip lighten-5 purple purple-text center">C</span>';
                    })
                    ->rawColumns(['stat'])
                    ->make(true);


            break;


            case "SM":

                   $data = DB::connection("sqlsrv3")
                            ->table('view_po_dtl')
                            ->selectRaw("FORMAT(dt_po, 'dd MMM yyyy') as dt_po,
                            po_id, po_item, vendor_name, prod_code, descr, item_desc1, stat,
                            cast(qty as float) as qty,
                            cast(wgt as float) as wgt,
                            unit_meas,
                            cast(unit_price as float) as unit_price,
                            curr_id,
                            cast(amt_net as float) as amt_net,
                            cast(qty_recive as float) as qty_recive,
                            cast(wgt_recive as float) as wgt_recive")
                            ->whereRaw($where)
                            ->orderBy('dt_po', 'ASC')
                            ->get();

                     return \DataTables::of($data)
                    ->editColumn('stat', function ($data) {
                        if ($data->stat == "O") return '<span class="chip lighten-5 grey black-text center">O</span>';
                        if ($data->stat == "R") return '<span class="chip lighten-5 green green-text center">R</span>';
                        if ($data->stat == "C") return '<span class="chip lighten-5 purple purple-text center">C</span>';
                    })
                    ->rawColumns(['stat'])
                    ->make(true);
            break;

            default:

            return redirect('layouts.POReport')->with("alert", "Wrong Mill ID!");

        }





    }


}
