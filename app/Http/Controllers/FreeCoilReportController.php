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


class FreeCoilReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.FreeCoilReport');

    }

    public function getFreeCoilReport (Request $request) {

        $where = "where 1=1";
        $total_weight = 0;
        $total_qty = 0;

        $commodity = $request->commodity;
        if ($commodity == "GLV" || $commodity == "SLT") {
            $where .= " and commodity_id = '$commodity'";
        }
        if ($commodity == "All") {
            $where .= " and commodity_id in ('SLT', 'GLV')";
        }
        $brand = $request->brand;
        if ($brand) {
            $where .= " and brand_id = '$brand'";
        }
        $coat = $request->coat;
        if ($coat) {
            $where .= " and AZ =  '$coat'";
        }
        $grade = $request->grade;
        if ($grade) {
            $where .= " and grade_id = '$grade'";
        }
        $thick = $request->thick;
        if ($thick) {
            $where .= " and thick = '$thick'";
        }
        $width = $request->width;
        if ($width) {
            $where .= " and width = '$width'";
        }
        $color = $request->colour;
        if ($color) {
            $where .= " and color_id = '$color'";
        }
        $quality = $request->quality;
        if ($quality) {
            $where .= " and quality_id = '$quality'";

        }

        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("select case
                when commodity_id = 'GLV' then 'FULL WIDTH'
                else 'SLITTED' end as commodity_id, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(brand_desc)) as brand_desc, CAST(thick AS DECIMAL(10,2)) as thick, 
                CAST(width AS DECIMAL(10,2)) as width,
                LTRIM(RTRIM(grade_id)) as grade_id, AZ, LTRIM(RTRIM(color)) as color, LTRIM(RTRIM(quality_id)) as quality_id, sum(wgt)/1000 as total_wgt, sum(qty) as qty from view_stock_free
                $where
                group by commodity_id, descr, brand_desc, thick, width, grade_id, AZ, color, quality_id
                order by descr"));


        $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select sum(qty) as qty, sum(wgt)/1000 total_wgt from view_stock_free $where "));

        foreach ($result as $result) {

            $total_weight = number_format($result->total_wgt,2,",",".");
            $total_qty = $result->qty;
        }

        return \DataTables::of($data)
        ->with('total_weight', $total_weight)
        ->with('total_qty', $total_qty)
        ->toJson();





    }
}
