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


class ScShipmentAnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.ScShipmentAnalysis');

    }

    public function getScShipmentAnalysis (Request $request) { 

        $where = "where 1=1";

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
        $customer = $request->customer;
        if ($customer != "All") {
            $where .= " and CustKKA = '$customer'";
        }
        if ($customer == "All") {
            $where .= " and CustKKA in ('KKA', 'Non KKA')";
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
            $where .= " and grade_id = '$grade'";
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
        
        $bySC = DB::connection("sqlsrv2")
                ->select(DB::raw("select periode, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by periode order by periode asc"));

        $byDeliv = DB::connection("sqlsrv2")
                ->select(DB::raw("select periode, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by periode order by periode asc"));

        return response()->json(['bySC' => $bySC, 'byDeliv' => $byDeliv]);


    }

    public function getScShipmentAnalysisDetailbySC (Request $request) {

        $where = "where 1=1";

        $periode = $request->periode;
        if ($periode) {
            $where .= " and periode = '$periode'";
         
        }
        $customer = $request->customer;
        if ($customer != "All") {
            $where .= " and CustKKA = '$customer'";
        }
        if ($customer == "All") {
            $where .= " and CustKKA in ('KKA', 'Non KKA')";
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
            $where .= " and grade_id = '$grade'";
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
                ->select(DB::raw("select LTRIM(RTRIM(STR(width,19,2))) as width, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by width"));

        $qThick = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(STR(thick,19,2))) as thick, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by thick"));

        $qCoatMass = DB::connection("sqlsrv2")
                   ->select(DB::raw("select LTRIM(RTRIM(coat_mass)) as coat_mass, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by coat_mass"));

        $qGrade = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(grade_id)) as grade_id, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by grade_id"));

        $qQuality = DB::connection("sqlsrv2")
                  ->select(DB::raw("select LTRIM(RTRIM(quality_id)) as quality_id, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by quality_id"));

        $qColor = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(color_name)) as color_name, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_sc $where group by color_name"));


        $result = ['qWidth' => $qWidth, 'qThick' => $qThick, 'qCoatMass' => $qCoatMass, 'qGrade' => $qGrade, 'qQuality' => $qQuality, 'qColor' => $qColor];

        return response()->json($result);


    }

    public function getScShipmentAnalysisDetailbyDeliv (Request $request) {

        $where = "where 1=1";

        $periode = $request->periode;
        if ($periode) {
            $where .= " and periode = '$periode'";
         
        }
        $customer = $request->customer;
        if ($customer != "All") {
            $where .= " and CustKKA = '$customer'";
        }
        if ($customer == "All") {
            $where .= " and CustKKA in ('KKA', 'Non KKA')";
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
            $where .= " and grade_id = '$grade'";
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
                ->select(DB::raw("select LTRIM(RTRIM(STR(width,19,2))) as width, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by width"));

        $qThick = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(STR(thick,19,2))) as thick, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by thick"));

        $qCoatMass = DB::connection("sqlsrv2")
                   ->select(DB::raw("select LTRIM(RTRIM(coat_mass)) as coat_mass, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by coat_mass"));

        $qGrade = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(grade_id)) as grade_id, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by grade_id"));

        $qQuality = DB::connection("sqlsrv2")
                  ->select(DB::raw("select LTRIM(RTRIM(quality_id)) as quality_id, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by quality_id"));

        $qColor = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(color_name)) as color_name, CAST(sum(wgt)/1000 AS DECIMAL(10,2)) as total_wgt from view_dashboard_deliv $where group by color_name"));


        $result = ['qWidth' => $qWidth, 'qThick' => $qThick, 'qCoatMass' => $qCoatMass, 'qGrade' => $qGrade, 'qQuality' => $qQuality, 'qColor' => $qColor];

        return response()->json($result);


    }
}
