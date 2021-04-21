<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Image;
use DateTime;
use Illuminate\Database\QueryException;

class ListMPFController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        return view('layouts.ListMPF');

    }

    public function getListMPF(Request $request){

        $userid = Session::get('USERNAME');
        $salesid = Session::get('SALESID');
        $groupid = Session::get('GROUPID');
        $officeid = Session::get('OFFICEID');
        $region = Session::get('REGIONID');

        if ($groupid == 'SALES'){
            
            $data = DB::connection('sqlsrv2')
                        ->table('mpf_data as a')
                        ->select('a.*', 'b.cat_desc')
                        ->join('mpf_category as b', 'b.cat_id', '=', 'a.cat_id')
                        ->where('a.userid', '=', $userid)
                        ->orderBy('a.tr_date', 'desc')
                        ->get();

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

        else if ($groupid == 'DEVELOPMENT' || $groupid == 'MANAGEMENT' || $groupid == 'KOORDINATOR'){

            $data = DB::connection('sqlsrv2')
                        ->table('mpf_data as a')
                        ->select('a.*', 'b.cat_desc')
                        ->join('mpf_category as b', 'b.cat_id', '=', 'a.cat_id')
                        ->orderBy('a.tr_date', 'desc')
                        ->get();


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

        else {

            $data = DB::connection('sqlsrv2')
                        ->table('mpf_data as a')
                        ->select('a.*', 'b.cat_desc')
                        ->join('mpf_category as b', 'b.cat_id', '=', 'a.cat_id')
                        ->where('a.target_id', '=', $groupid)
                        ->orderBy('a.tr_date', 'desc')
                        ->get();

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

    public function detailMPF(Request $request){

        $id = $request->id;
        $user_action = '';
        $status = '';
        $attach = '';
        $filename = '';
        $headerCC = "<h6>Approval CC/BCC: </h6>";
        $listCC = '';
        
        $data = DB::connection('sqlsrv2')
                ->table('mpf_data as a')
                ->select('a.*', 'b.cat_desc')
                ->join('mpf_category as b', 'b.cat_id', '=', 'a.cat_id')
                ->where('a.mpf_id', '=', $id)
                ->get();
        
        $data2 =  DB::connection('sqlsrv2')
                ->table('mpf_target')
                ->select('*')
                ->get();
                

        foreach ($data as $data) {
            
            
            $userid =  $data->userid;
            $tr_date = date('d M Y', strtotime($data->tr_date));
            $cat_desc = $data->cat_desc;
            $target_id = $data->target_id;
            $remark1 = $data->remark1;
           
            
            if ($data->dt_approve == "1900-01-01 00:00:00.000" && $data->dt_reject == "1900-01-01 00:00:00.000") {

                $status = "PENDING";

            }
                
            if ($data->dt_approve != "1900-01-01 00:00:00.000" && $data->dt_reject == "1900-01-01 00:00:00.000") {

                $status = "APPROVED";

            }
               
            if ($data->dt_approve == "1900-01-01 00:00:00.000" && $data->dt_reject != "1900-01-01 00:00:00.000") {

                $status = "REJECTED";

            }

            if ($data->attach_path) {

                $attach = "img/mpf/".$data->attach_path;
                $filename = $data->attach_path;
            }

            if (!$data->attach_path) {

                $attach = "N/A";
            }

            if ($data->user_action) {
                
                $user_action = $data->user_action;
            }

            if (!$data->user_action) {
                
                $user_action = "N/A";
            }


            
               
        }

        foreach ($data2 as $data2) {

            $listCC .= 
            '<div>
                <label style="margin-left: 10px"><input type="checkbox" name="checkCC" value="'.$data2->target_id.'">
                <span>'.$data2->descr.'</span></label>
            </div>';

        }

        return response()->json(['userid' => $userid, 
                                'tr_date' => $tr_date,
                                'cat_desc' => $cat_desc, 
                                'user_action' => $user_action,
                                'status' => $status,
                                'attach_path' => $attach,
                                'filename' => $filename,
                                'target_id' => $target_id,
                                'remark1' => $remark1,
                                'checkbox' => $headerCC.$listCC
                                ]);


    }

    public function acceptApproval(Request $request){

        $userid = Session::get('USERNAME');
        $mpf_id = $request->id;
        $arrData = $request->arr;

        if($arrData){
            foreach ($arrData as $arr) {
                
                $saveCC = DB::connection("sqlsrv2")
                            ->table('mpf_cc')
                            ->insert([
                                'mpf_id' => $mpf_id,
                                'target_id' => $arr,
                                'userid' => $userid
                            ]);

            }
        }

        $statUpdate = DB::connection('sqlsrv2')
                        ->table('mpf_data')
                        ->where('mpf_id', '=', $mpf_id)
                        ->update(['stat' => 'Y',
                                  'dt_approve' => date("Ymd"),
                                  'user_action' => $userid]);

        // return redirect()->route('ApprovalList');
        return response()->json(['status' => "Sukses"]);
    }

    public function rejectApproval(Request $request){
        $userid = Session::get('USERNAME');
        $mpf_id = $request->id;

        $statUpdate = DB::connection('sqlsrv2')
                        ->table('mpf_data')
                        ->where('mpf_id', '=', $mpf_id)
                        ->update(['stat' => 'N',
                                  'dt_reject' => date("Ymd"),
                                  'user_action' => $userid]);
                
        return response()->json(['status' => "Sukses"]);
    }

       
}
