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

class ProductionAnalysisController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $listmachine = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(mach_id)) as mach_id, LTRIM(RTRIM(descr)) as descr from mach_id where mach_type = 'GL'"));

        return view('layouts.ProductionAnalysis',['listmachine' => $listmachine]);

    }

    public function getProductAnalysis (Request $request) {

        $where = "where mach_type = 'GL'";

        $start = $request->start;
        $end = $request->end;

        if ($start && $end) {
            $where .= " and periode between '$start' and '$end'";
         
        }

        if ($start && !$end) {
            $where .= " and periode > '$start'";
        }

        if (!$start && $end) {
            $where .= " and periode < '$end'";
        }

        $mach_id = $request->mach_id;
        if ($mach_id) {
            $where .= " and mach_id = '$mach_id'";
        }
        $brand = $request->brand;
        if ($brand) {
            $where .= " and brand_id = '$brand'";
        }
        $coat = $request->coat;
        if ($coat) {
            $where .= " and coat_mass =  '$coat'";
        }
        $grade = $request->grade;
        if ($grade) {
            $where .= " and grade_name = '$grade'";
        }
        $thick = $request->thick;
        if ($thick) {
            $where .= " and thick = '$thick'";
        }
        $width = $request->width;
        if ($width) {
            $where .= " and Width = '$width'";
        }
        $color = $request->colour;
        if ($color) {
            $where .= " and color_id = '$color'";
        }
        $quality = $request->quality;
        if ($quality) {
            $where .= " and quality_id = '$quality'";
        }
        

        $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select periode, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by periode order by periode asc"));

        return response()->json($result);


    }

    public function getProductAnalysisDetail (Request $request) {

        $where = "where mach_type = 'GL'";

        $periode = $request->periode;
        if ($periode) {
            $where .= " and periode = '$periode'";
         
        }
        $mach_id = $request->mach_id;
        if ($mach_id) {
            $where .= " and mach_id = '$mach_id'";
        }
        $brand = $request->brand;
        if ($brand) {
            $where .= " and brand_id = '$brand'";
        }
        $coat = $request->coat;
        if ($coat) {
            $where .= " and coat_mass =  '$coat'";
        }
        $grade = $request->grade;
        if ($grade) {
            $where .= " and grade_name = '$grade'";
        }
        $thick = $request->thick;
        if ($thick) {
            $where .= " and thick = '$thick'";
        }
        $width = $request->width;
        if ($width) {
            $where .= " and Width = '$width'";
        }
        $color = $request->colour;
        if ($color) {
            $where .= " and color_id = '$color'";
        }
        $quality = $request->quality;
        if ($quality) {
            $where .= " and quality_id = '$quality'";
        }
        
        $qWidth = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(STR(width,19,2))) as width, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by width"));

        $qThick = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(STR(thick,19,2))) as thick, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by thick"));

        $qCoatMass = DB::connection("sqlsrv2")
                   ->select(DB::raw("select LTRIM(RTRIM(coat_mass)) as coat_mass, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by coat_mass"));

        $qGrade = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(grade_name)) as grade_name, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by grade_name"));

        $qQuality = DB::connection("sqlsrv2")
                  ->select(DB::raw("select LTRIM(RTRIM(quality_id)) as quality_id, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by quality_id"));

        $qColor = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(color_desc)) as color_desc, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_hasil_prod $where group by color_desc"));


        $result = ['qWidth' => $qWidth, 'qThick' => $qThick, 'qCoatMass' => $qCoatMass, 'qGrade' => $qGrade, 'qQuality' => $qQuality, 'qColor' => $qColor];

        return response()->json($result);


    }
}
