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

        if(substr($id, 0, 1) == 1){

            $result = DB::connection('sqlsrv2')
                        ->table('CustomerOrder as a')
                        ->join('Customer as b', 'b.CustomerId', '=', 'a.CustomerId')
                        ->join('Sales as c', 'c.SalesId', '=', 'a.SalesId')
                        ->select('c.NamaSales', 'b.NamaCustomer', 'b.Alamat', 'b.Kota')
                        ->where('a.CustomerOrderNo', '=', $id)
                        ->get();

            return response()->json($result);

        }
        else{

            $result = DB::connection('sqlsrv2')
                        ->table('Penjualan as a')
                        ->join('Customer as b', 'b.CustomerId', '=', 'a.CustomerId')
                        ->join('Sales as c', 'c.SalesId', '=', 'a.SalesId')
                        ->select('c.NamaSales', 'b.NamaCustomer', 'b.Alamat', 'b.Kota')
                        ->where('a.PenjualanNO', '=', $id)
                        ->get();

            return response()->json($result);

        }

    }

}
