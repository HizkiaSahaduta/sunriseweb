<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class TodayVisitController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view('layouts.TodayVisit');
    }

    public function getTodayVisit($id)
    {

        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("select tr_id, namacustomer, alamat, city,
                FORMAT(tr_date, 'dd MMM yyyy - hh.mm tt') as tr_date
                from web_SalesActivity
                where salesid = '$id'
                and tr_date >=DATEADD(day, DATEDIFF(day,0,GETDATE()),0) AND tr_date < DATEADD(day, DATEDIFF(day,0,GETDATE())+1,0)
                order by tr_date desc"));

        return \DataTables::of($data)

        ->addColumn('Detail', function($data) {
            return '<button data-target="remarkModal" id="getRemark" data-id="'.$data->tr_id.'"
            class="btn-floating waves-effect waves-light light-blue darken-3 z-depth-2 modal-trigger">
            <i class="material-icons left">edit_location</i></button>';
        })
        ->rawColumns(['Detail'])
        ->make(true);
    }


    public function getRemark($id)
    {

        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("select tr_id, namacustomer, alamat, city, sales_longitude, sales_latitude, remark,
                FORMAT(tr_date, 'dd MMM yyyy - hh.mm tt') as tr_date
                from web_SalesActivity
                where tr_id = '$id'
                and tr_date >=DATEADD(day, DATEDIFF(day,0,GETDATE()),0) AND tr_date < DATEADD(day, DATEDIFF(day,0,GETDATE())+1,0)"));

        foreach ($data as $data) {

        $html = "<h4>Visit Detail</h4>
                <p><strong>".$data->namacustomer." (".$data->tr_date.")</strong></p>
                <hr>
                <div class='form-group'>
                    <p><strong>GPS Log</strong></p>
                    <input type='hidden' id='latitude' value=".$data->sales_latitude.">
                    <input type='hidden' id='longitude' value=".$data->sales_longitude.">
                    <div id='map_canvas' style='height:200px; border: 1px solid black;'></div>
                </div>
                <input type='hidden' id='val_remark' value='".$data->remark."'>";
        }

        return response()->json(['html'=>$html]);



    }
}
