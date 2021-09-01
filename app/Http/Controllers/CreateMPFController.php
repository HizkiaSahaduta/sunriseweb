<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Image;
use DateTime;
use Illuminate\Database\QueryException;


class CreateMPFController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $userid = Session::get('USERNAME');
        $salesid = Session::get('SALESID');
        $groupid = Session::get('GROUPID');
		$officeid = Session::get('OFFICEID');
        
        $category = DB::connection('sqlsrv2')
                        ->table('mpf_category')
                        ->select('cat_id', 'cat_desc')
                        ->where('active_flag', '=', 'Y')
                        ->get();

        $office = DB::connection('sqlsrv2')
                        ->table('branch_office')
                        ->selectRaw('LTRIM(RTRIM(office)) as office')
                        ->where('office_id', '=', $officeid)
                        ->get();
        
        return view('layouts.CreateMPF', ['category' => $category, 'office' => $office]);

        // return view('layouts.CreateMPF', ['category' => $category]);

    }

    public function needOrderID(Request $request){

        $catId = $request->cat_id;

        $category = DB::connection('sqlsrv2')
                        ->table('mpf_category')
                        ->select('needOrderID')
                        ->where('cat_id', '=', $catId)
                        ->where('active_flag', '=', 'Y')
                        ->get();

        return response()->json($category[0]->needOrderID);

    }

    public function fillReceiver(Request $request){

        $catId = $request->cat_id;

        $target = DB::connection('sqlsrv2')
                        ->table('mpf_category')
                        ->select('target_id')
                        ->where('cat_id', '=', $catId)
                        ->where('active_flag', '=', 'Y')
                        ->value('target_id');

        $receiver = DB::connection('sqlsrv2')
                        ->table('mpf_target')
                        ->select('descr')
                        ->where('target_id', '=', $target)
                        ->where('active_flag', '=', 'Y')
                        ->value('descr');

        return response()->json($receiver);

    }

    public function saveApprovalForm(Request $request){
  
        $userid = Session::get('USERNAME');
        $salesid = Session::get('SALESID');
        $officeid = Session::get('OFFICEID');
        if (!$officeid) {
            $officeid = 1;
        }
        $currDate = date("mY", strtotime("0 month,0 year"));

        $txtCategory = $request->txtCategory;
        $txtOrderId = $request->txtOrderId;
        $txtRemark = $request->txtRemark;

        if(!$txtOrderId){
            $txtOrderId = '';
        }

        try {

            $target = DB::connection('sqlsrv2')
                            ->table('mpf_category')
                            ->select('target_id')
                            ->where('cat_id', '=', $txtCategory)
                            ->where('active_flag', '=', 'Y')
                            ->value('target_id');

            $txtReceiver = DB::connection('sqlsrv2')
                            ->table('mpf_target')
                            ->select('descr')
                            ->where('target_id', '=', $target)
                            ->where('active_flag', '=', 'Y')
                            ->value('descr');
                            
            $d = new DateTime();
            $mpf_id = "WEB-".$officeid."-".$d->format("sv")."-".$currDate;                

            $file = $request->file('txtAttachment');

            if($file){
                $txtPhotoName = $mpf_id.'.' . $file->extension();
                \File::delete(public_path('img/mpf/' .$txtPhotoName));
                $file->move(public_path('img/mpf/'), $txtPhotoName);
                $insertPhoto = 'img/mpf/'.$txtPhotoName;
            }
            else{
                $txtPhotoName = '';
            }

            $saveApproval = DB::connection("sqlsrv2")
                                ->table('mpf_data')
                                ->insert([
                                    'office_id' => $officeid,
                                    'mpf_id' => $mpf_id,
                                    'cat_id' => $txtCategory,
                                    'target_id' => $txtReceiver,
                                    'order_id' => $txtOrderId,
                                    'remark1' => $txtRemark,
                                    'attach_path' => $txtPhotoName,
                                    'userid' => $userid
                                ]);

            return response()->json(['response' => "Success"]);
        
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function checkOrder(Request $request){

        $id = $request->id;
        $html = '';

        $result = DB::connection('sqlsrv2')
                    ->select(DB::raw("select ltrim(rtrim(salesman_name)) as salesman_name, 
                    ltrim(rtrim(cust_name)) as cust_name, stat, 
                    convert(varchar(10), dt_order, 120) as dt_order,
                    convert(varchar(10), dt_close, 120) as dt_close, after_close, ppp
                    from view_sc_preorder where order_id = '$id'"));

        foreach ($result as $result) {

            $html .= '
            <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
            <h6>Sales Person: '.$result->salesman_name.'</h6>
            <h6>Customer: '.$result->cust_name.'</h6>
            <h6>Status: '.$result->stat.'</h6>
            <h6>Sc.Date: '.$result->dt_order.'</h6>
            <h6>Closed.Date: '.$result->dt_close.'</h6>';
            
            if($result->after_close >= 0 && $result->after_close <= 7) {

                $html .= '
                <h6 class="text-danger">WillBeClosed: '.$result->after_close.' days</h6>';

            }

            elseif($result->after_close >= 0 && $result->stat == 'C') {

                $html .= '
                <h6 class="text-warning">WillBeClosed: '.$result->after_close.' days</h6>';

            }

            elseif($result->after_close >= 0 && $result->stat == 'O') {

                $html .= '
                <h6 class="text-success">WillBeClosed: '.$result->after_close.' days</h6>';

            }

            elseif($result->after_close >= 0 && $result->stat == 'R') {

                $html .= '
                <h6 class="text-success">WillBeClosed: '.$result->after_close.' days</h6>';

            }

            elseif($result->after_close >= 0 && $result->stat == 'X') {

                $html .= '
                <h6 class="text-danger">WillBeClosed: '.$result->after_close.' days</h6>';

            }

            else {

                $html .= '
                <h6 class="text-black">WillBeClosed: '.$result->after_close.' days</h6>';

            }

            if($result->ppp > 0) {

                $html .= '
                <h6 class="text-success">PPP: Yes</h6>';

            }

            if($result->ppp <= 0) {

                $html .= '
                <h6 class="text-danger">PPP: No</h6>';

            }



        }


        return response()->json(['html' => $html]);


    }

}
