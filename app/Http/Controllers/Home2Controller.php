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

class Home2Controller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $year =  Carbon::now()->year;
        $subyear =  Carbon::now()->subYear()->year;
        return view('layouts.home2',['year' => $year, 'subyear' => $subyear]);
    }

    public function getDashboardProduction () {

        $year =  Carbon::now()->year;
        $subyear =  Carbon::now()->subYear()->year;

        $cgl1_now = DB::connection("sqlsrv2")
                    ->select(DB::raw("select bulan, tahun, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from (
                        select bulan, tahun, wgt from view_hasil_prod
                        where tahun = '$year' and mach_type = 'GL' and mach_id = '01'
                        union all
                        select distinct bulan, '$year' tahun,0 total_wgt from view_hasil_prod) x 
                        group by bulan, tahun
                        order by bulan"));

         $cgl1_sub = DB::connection("sqlsrv2")
                    ->select(DB::raw("select bulan, tahun, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from (
                        select bulan, tahun, wgt from view_hasil_prod
                        where tahun = '$subyear' and mach_type = 'GL' and mach_id = '01'
                        union all
                        select distinct bulan, '$subyear' tahun,0 total_wgt from view_hasil_prod) x 
                        group by bulan, tahun
                        order by bulan"));

        $cgl2_now = DB::connection("sqlsrv2")
                    ->select(DB::raw("select bulan, tahun, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from (
                        select bulan, tahun, wgt from view_hasil_prod
                        where tahun = '$year' and mach_type = 'GL' and mach_id = '02'
                        union all
                        select distinct bulan, '$year' tahun,0 total_wgt from view_hasil_prod) x 
                        group by bulan, tahun
                        order by bulan"));

         $cgl2_sub = DB::connection("sqlsrv2")
                    ->select(DB::raw("select bulan, tahun, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from (
                        select bulan, tahun, wgt from view_hasil_prod
                        where tahun = '$subyear' and mach_type = 'GL' and mach_id = '02'
                        union all
                        select distinct bulan, '$subyear' tahun,0 total_wgt from view_hasil_prod) x 
                        group by bulan, tahun
                        order by bulan"));


        return response()->json(['cgl1_now' => $cgl1_now, 'cgl1_sub' => $cgl1_sub, 'cgl2_now' => $cgl2_now, 'cgl2_sub' => $cgl2_sub]);
    }
}
