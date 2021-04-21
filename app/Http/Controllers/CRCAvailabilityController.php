<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cache;
use App\User;
use Hash;
use Auth;
use Carbon\Carbon;


class CRCAvailabilityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.CRCAvailability');

    }

    public function getCRCAvailability (Request $request) {

        $where = "where 1=1";
        $total_wgt_oh = 0;
        $total_qty_oh = 0;
        $total_wgt_plan = 0;
        $total_qty_plan = 0;
        $total_out_po = 0;

        $origin = $request->origin;
        if ($origin) {
            $where .= " and origin_id = '$origin'";
        }
        $commodity = $request->commodity;
        if ($commodity) {
            $where .= " and commodity_id =  '$commodity'";
        }
        $thick = $request->thick;
        if ($thick) {
            $where .= " and thick = '$thick'";
        }
        $width = $request->width;
        if ($width) {
            $where .= " and width = '$width'";
        }


        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(origin)) as origin, LTRIM(RTRIM(commodity)) as commodity, LTRIM(RTRIM(prod_descr)) as prod_descr, 
                CAST(thick AS DECIMAL(10,2)) as thick, CAST(width AS DECIMAL(10,2)) as width, CAST(wgt_oh AS DECIMAL(10,2)) as wgt_oh, 
                CAST(qty_oh AS DECIMAL(10,2)) as qty_oh, CAST(WgtPlant AS DECIMAL(10,2)) as wgt_plan, CAST(QtyPlant AS DECIMAL(10,2)) as qty_plan, 
                CAST(out_po AS DECIMAL(10,2)) as out_po from view_stock_crc
                $where
                group by origin, commodity, prod_descr, thick, width, wgt_oh, qty_oh, WgtPlant, QtyPlant, out_po order by prod_descr"));


        $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select CAST(sum(wgt_oh) AS DECIMAL(10,2)) as total_wgt_oh, 
                    CAST(sum(qty_oh) AS DECIMAL(10,2)) as total_qty_oh, CAST(sum(WgtPlant) AS DECIMAL(10,2)) as total_wgt_plan, CAST(sum(QtyPlant) AS DECIMAL(10,2)) as total_qty_plan, 
                    CAST(sum(out_po) AS DECIMAL(10,2)) as total_out_po from view_stock_crc $where"));

        foreach ($result as $result) {


            $total_wgt_oh = number_format($result->total_wgt_oh,2,",",".");
            $total_qty_oh = number_format($result->total_qty_oh,2,",",".");
            $total_wgt_plan = number_format($result->total_wgt_plan,2,",",".");
            $total_qty_plan = number_format($result->total_qty_plan,2,",",".");
            $total_out_po = number_format($result->total_out_po,2,",",".");

           
        }

        return \DataTables::of($data)
        ->with('total_wgt_oh', $total_wgt_oh)
        ->with('total_qty_oh', $total_qty_oh)
        ->with('total_wgt_plan', $total_wgt_plan)
        ->with('total_qty_plan', $total_qty_plan) 
        ->with('total_out_po', $total_out_po) 
        ->toJson();





    }



}
