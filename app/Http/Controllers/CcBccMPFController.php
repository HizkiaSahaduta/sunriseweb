<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Image;
use DateTime;
use Illuminate\Database\QueryException;

class CcBccMPFController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        return view('layouts.CcBccMPF');

    }

    public function getListCcMPF(Request $request){

        $userid = Session::get('USERNAME');
        $salesid = Session::get('SALESID');
        $groupid = Session::get('GROUPID');
        $officeid = Session::get('OFFICEID');
        $region = Session::get('REGIONID');

        $data = DB::connection('sqlsrv2')
                ->select(DB::raw(" select x.*, y.cat_desc from 
                (select b.*, c.descr from mpf_cc as a
                inner join mpf_data as b on a.mpf_id = b.mpf_id
                inner join mpf_target as c on c.target_id = a.target_id
                inner join mpf_target_user as d on c.target_id = d.target_id
                where d.user_target = '$userid') as x
                inner join mpf_category as y on x.cat_id = y.cat_id"));

        return \DataTables::of($data)
        ->editColumn('tr_date', function ($data) {
            if ($data->tr_date) return date('d M Y', strtotime($data->tr_date));
        })
        ->addColumn('Status', function($data) {
            if ($data->dt_approve == "1900-01-01 00:00:00.000" && $data->dt_reject == "1900-01-01 00:00:00.000") 
            return 
            '<a class="waves-effect waves-light amber btn btn-small modal-trigger detailMPF modal-trigger" data-target="detailMPFModal" data-id="'.$data->mpf_id.'">PENDING</a>';
            if ($data->dt_approve != "1900-01-01 00:00:00.000" && $data->dt_reject == "1900-01-01 00:00:00.000") 
            return 
            '<a class="waves-effect waves-light green btn btn-small modal-trigger detailMPF modal-trigger" data-target="detailMPFModal" data-id="'.$data->mpf_id.'">APPROVED</a>';
            if ($data->dt_approve == "1900-01-01 00:00:00.000" && $data->dt_reject != "1900-01-01 00:00:00.000") 
            return 
            '<a class="waves-effect waves-light red btn btn-small modal-trigger detailMPF modal-trigger" data-target="detailMPFModal" data-id="'.$data->mpf_id.'">REJECTED</a>';
        })
        ->rawColumns(['tr_date','Status'])
        ->make(true);
        
    }
}
