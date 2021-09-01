<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CreatePreOrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        Session::forget('bookId');
        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $salesid  = Session::get('SALESID');
        $now = Carbon::now();
        $year_now =  $now->year;
        $a = $now->addYear(+10);
        $year_later = $a->year;

        switch ($groupid) {

            case "SALES":

                $listsales = DB::connection("sqlsrv2")
                            ->table('salesman')
                            ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                            ->where('salesman_id', '=', $salesid)
                            ->where('active_flag', '=', 'Y')
                            ->get();

                return view('layouts.CreatePreOrder',['listsales' => $listsales,
                'year_now' => $year_now, 'year_later' => $year_later]);
                break;

            case "KOORDINATOR":

                $listsales = DB::connection("sqlsrv2")
                            ->table('salesman')
                            ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                            ->where('active_flag', '=', 'Y')
                            ->get();

                return view('layouts.CreatePreOrder',['listsales' => $listsales,
                'year_now' => $year_now, 'year_later' => $year_later]);
                break;

			case "MANAGEMENT":

                $listsales = DB::connection("sqlsrv2")
                            ->table('salesman')
                            ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                            ->where('active_flag', '=', 'Y')
                            ->get();

                return view('layouts.CreatePreOrder',['listsales' => $listsales,
                'year_now' => $year_now, 'year_later' => $year_later]);
                break;

            case "DEVELOPMENT":

                $listsales = DB::connection("sqlsrv2")
                            ->table('salesman')
                            ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                            ->where('active_flag', '=', 'Y')
                            ->get();

                return view('layouts.CreatePreOrder',['listsales' => $listsales,
                'year_now' => $year_now, 'year_later' => $year_later]);
                break;

            default:

                return redirect('home')->with("alert", "You are not allowed to view this page");
        }
    }

    
    public function order_autocompletecustomer(Request $request){
        $search = $request->get('term');

        $result = DB::connection("sqlsrv2")
            ->table('customer')
            ->where('cust_name', 'LIKE', '%'. $search. '%')
            ->orWhere('cust_id', '=',  $search )
            ->take(50)
            ->get();

        return response()->json($result);
    }

    public function order_getCustDetails($id){

        $result = DB::connection("sqlsrv2")
                    ->table('customer')
                    ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id,
                    LTRIM(RTRIM(cust_name)) as cust_name,
                    LTRIM(RTRIM(address1)) as address1,
                    LTRIM(RTRIM(address2)) as address2,
                    LTRIM(RTRIM(city)) as city,
                    LTRIM(RTRIM(prov)) as prov,
                    LTRIM(RTRIM(phone)) as phone')
                    ->where('cust_id', '=', $id)
                    ->get()
                    ->first();

        return json_encode($result);
    }

    public function order_consignee($id){

        $result = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT LTRIM(RTRIM(a.cons_id)) as cons_id,
                LTRIM(RTRIM(b.cons_name)) as cons_name,
                concat(LTRIM(RTRIM(b.address1)),' ',LTRIM(RTRIM(b.address2)), ',',
                LTRIM(RTRIM(b.city)),',', LTRIM(RTRIM(b.prov)), ' ', LTRIM(RTRIM(b.zip_code))) as address1
                FROM cust_cons_link a JOIN consignee b
                ON a.mill_id = b.mill_id
                AND a.cons_id = b.cons_id
                WHERE a.mill_id = 'SR'
                AND a.cust_id = '$id'
                AND a.active_flag = 'Y'"));

        return response()->json($result);
    }

    public function saveOrderItem(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $bookId = Session::get('bookId');
        if (!$bookId){
            $bookId = 'SKU-'.strtoupper(substr(Session::get('USERNAME'), 0, 3)).substr($tr_date->format('Y'), -2).$tr_date->format('m').$tr_date->format('d').$tr_date->format('H').$tr_date->format('i').$tr_date->format('s');
        }
        $prod_code = $request->prod_code;
        if(!$prod_code){
            $prod_code = '';
        }
        $cust_name = $request->cust_name;
        if(!$cust_name){
            $cust_name = '';
        }
        $cust_address = $request->cust_address;
        if(!$cust_address){
            $cust_address = '';
        }
        $phone = $request->phone;
        if(!$phone){
            $phone = '';
        }
        $cons_id = $request->cons_id;
        if(!$cons_id){
            $cons_id = '';
        }
        $ship_to = $request->ship_to;
        if(!$ship_to){
            $ship_to = '';
        }
        $salesman_id = $request->salesman_id;
        if(!$salesman_id){
            $salesman_id = '';
        }
        $remark1 = $request->remark1;
        if (!$remark1){
            $remark1 = '';
        }
        $remark2 = $request->remark2;
        if (!$remark2){
            $remark2 = '';
        }
        $pay_term_id = $request->pay_term_id;
        if (!$pay_term_id){
            $pay_term_id = '';
        }
        $cust_po_num = $request->cust_po_num;
        if (!$cust_po_num){
            $cust_po_num = '';
        }
        $weight = $request->weight;
        if (!$weight){
            $weight = 0.00;
        }
        $unit_price = $request->unit_price;
        if (!$unit_price){
            $unit_price = 0.00;
        }
        $amt_gross = $request->amt_gross;
        if (!$amt_gross){
            $amt_gross = 0.00;
        }
        $pct_disc = $request->pct_disc;
        if (!$pct_disc){
            $pct_disc = 0.00;
        }
        $amt_disc = $request->amt_disc;
        if (!$amt_disc){
            $amt_disc = 0.00;
        }
        $amt_net = $request->amt_net;
        if (!$amt_net){
            $amt_net = $amt_gross;
        }
        $atr_remark = $request->atr_remark;
        if (!$atr_remark){
            $atr_remark = '';
        }
        $appl_note = $request->appl_note;
        if (!$appl_note){
            $appl_note = '';
        }
        $req_date = $request->req_date;
        if (!$req_date){
            $req_date = '1900-01-01 00:00:00.000';
        }
        $req_week = $request->req_week;
        if (!$req_week){
            $req_week = '';
        }
        $req_month = $request->req_month;
        if (!$req_month){
            $req_month = '';
        }
        $req_year = $request->req_year;
        if (!$req_year){
            $req_year = '';
        }

        try{

            $checkHeader = DB::connection("sqlsrv2")
                            ->table('order_book_hdr')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->where('stat', '=', 'O')
                            ->first();

            if ($checkHeader){

                $header = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->update([
                            'cust_id' => $request->cust_id,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'dt_modified' => $tr_date,
                            'pay_term_id' => $pay_term_id,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

                $seqNum = DB::connection("sqlsrv2")
                        ->table('order_book_dtl')
                        ->select('item_num')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->max('item_num');

                $item = DB::connection("sqlsrv2")
                        ->table('order_book_dtl')
                        ->where('book_id', '=', $bookId)
                        ->insert([
                            'mill_id' => $request->mill_id,
                            'book_id' => $bookId,
                            'item_num' => $seqNum + 1,
                            'prod_code' => $prod_code,
                            'unit_meas' => 'KG',
                            'curr_id' => 'IDR',
                            'wgt' => $weight,
                            'unit_price' => $unit_price,
                            'amt_gross' => $amt_gross,
                            'amt_disc' => $amt_disc,
                            'pct_disc' => $pct_disc,
                            'amt_net' => $amt_net,
                            'remark' => $atr_remark,
                            'dt_req_ship' => $req_date,
                            'req_week' => $req_week,
                            'req_month' => $req_month,
                            'req_year' => $req_year,
                            'stat' => 'O',
                            'dt_created' => $tr_date,
                            'user_id' => $userid,
                            'aplikasi_note' => $appl_note
                        ]);

                $invoiceNo = $bookId;
                return response()->json(['response' => 'Item Added', 'invoiceNo' => $invoiceNo]);
            }

            else{
                $header = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->insert([
                            'mill_id' => $request->mill_id,
                            'book_id' => $bookId,
                            'tr_date' => $tr_date,
                            'cust_id' => $request->cust_id,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'stat' => 'O',
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'user_id' => $userid,
                            'pay_term_id' => $pay_term_id,
                            'dt_created' => $tr_date,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

                $item = DB::connection("sqlsrv2")
                            ->table('order_book_dtl')
                            ->insert([
                                'mill_id' => $request->mill_id,
                                'book_id' => $bookId,
                                'item_num' => 1,
                                'prod_code' => $prod_code,
                                'unit_meas' => 'KG',
                                'curr_id' => 'IDR',
                                'wgt' => $weight,
                                'unit_price' => $unit_price,
                                'amt_gross' => $amt_gross,
                                'amt_disc' => $amt_disc,
                                'pct_disc' => $pct_disc,
                                'amt_net' => $amt_net,
                                'remark' => $atr_remark,
                                'dt_req_ship' => $req_date,
                                'req_week' => $req_week,
                                'req_month' => $req_month,
                                'req_year' => $req_year,
                                'stat' => 'O',
                                'dt_created' => $tr_date,
                                'user_id' => $userid,
                                'aplikasi_note' => $appl_note
                            ]);

                Session::put('bookId', $bookId);
                $invoiceNo = Session::get('bookId', $bookId);
                return response()->json(['response' => 'Item Added', 'invoiceNo' => $invoiceNo]);
            }

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }

    }

    public function saveEditOrderItem(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $bookId = $request->book_id;
        $prod_code = $request->prod_code;
        if(!$prod_code){
            $prod_code = '';
        }
        $cust_name = $request->cust_name;
        if(!$cust_name){
            $cust_name = '';
        }
        $cust_address = $request->cust_address;
        if(!$cust_address){
            $cust_address = '';
        }
        $phone = $request->phone;
        if(!$phone){
            $phone = '';
        }
        $cons_id = $request->cons_id;
        if(!$cons_id){
            $cons_id = '';
        }
        $ship_to = $request->ship_to;
        if(!$ship_to){
            $ship_to = '';
        }
        $salesman_id = $request->salesman_id;
        if(!$salesman_id){
            $salesman_id = '';
        }
        $remark1 = $request->remark1;
        if (!$remark1){
            $remark1 = '';
        }
        $remark2 = $request->remark2;
        if (!$remark2){
            $remark2 = '';
        }
        $pay_term_id = $request->pay_term_id;
        if (!$pay_term_id){
            $pay_term_id = '';
        }
        $cust_po_num = $request->cust_po_num;
        if (!$cust_po_num){
            $cust_po_num = '';
        }
        $weight = $request->weight;
        if (!$weight){
            $weight = 0.00;
        }
        $unit_price = $request->unit_price;
        if (!$unit_price){
            $unit_price = 0.00;
        }
        $amt_gross = $request->amt_gross;
        if (!$amt_gross){
            $amt_gross = 0.00;
        }
        $pct_disc = $request->pct_disc;
        if (!$pct_disc){
            $pct_disc = 0.00;
        }
        $amt_disc = $request->amt_disc;
        if (!$amt_disc){
            $amt_disc = 0.00;
        }
        $amt_net = $request->amt_net;
        if (!$amt_net){
            $amt_net = $amt_gross;
        }
        $atr_remark = $request->atr_remark;
        if (!$atr_remark){
            $atr_remark = '';
        }
        $appl_note = $request->appl_note;
        if (!$appl_note){
            $appl_note = '';
        }
        $req_date = $request->req_date;
        if (!$req_date){
            $req_date = '1900-01-01 00:00:00.000';
        }
        $req_week = $request->req_week;
        if (!$req_week){
            $req_week = '';
        }
        $req_month = $request->req_month;
        if (!$req_month){
            $req_month = '';
        }
        $req_year = $request->req_year;
        if (!$req_year){
            $req_year = '';
        }

        try{

                $checkHeader = DB::connection("sqlsrv2")
                ->table('order_book_hdr')
                ->where('book_id', '=', $bookId)
                ->where('user_id', '=', $userid)
                ->where('stat', '=', 'O')
                ->first();

            if ($checkHeader) {

                $header = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->update([
                            'cust_id' => $request->cust_id,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'dt_modified' => $tr_date,
                            'pay_term_id' => $pay_term_id,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

                $seqNum = DB::connection("sqlsrv2")
                        ->table('order_book_dtl')
                        ->select('item_num')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->max('item_num');

                $item = DB::connection("sqlsrv2")
                        ->table('order_book_dtl')
                        ->where('book_id', '=', $bookId)
                        ->insert([
                            'mill_id' => $request->mill_id,
                            'book_id' => $bookId,
                            'item_num' => $seqNum + 1,
                            'prod_code' => $prod_code,
                            'unit_meas' => 'KG',
                            'curr_id' => 'IDR',
                            'wgt' => $weight,
                            'unit_price' => $unit_price,
                            'amt_gross' => $amt_gross,
                            'amt_disc' => $amt_disc,
                            'pct_disc' => $pct_disc,
                            'amt_net' => $amt_net,
                            'remark' => $atr_remark,
                            'dt_req_ship' => $req_date,
                            'req_week' => $req_week,
                            'req_month' => $req_month,
                            'req_year' => $req_year,
                            'stat' => 'O',
                            'dt_created' => $tr_date,
                            'user_id' => $userid,
                            'aplikasi_note' => $appl_note
                        ]);

                return response()->json(['response' => 'Item Added']);
            }
        }
            catch(QueryException $ex){
                    $error = $ex->getMessage();
                    return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
            }

    }

    public function getItemDetail(Request $request){

        $id = $request->id;
        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT LTRIM(RTRIM(a.mill_id)) as mill_id
                ,LTRIM(RTRIM(a.book_id)) as book_id
                ,a.item_num as item_num
                ,LTRIM(RTRIM(a.prod_code)) as prod_code
                ,COALESCE(LTRIM(RTRIM(b.descr)),'by Remark') as descr
                ,a.wgt as wgt
                ,LTRIM(RTRIM(a.unit_meas)) as unit_meas
                ,LTRIM(RTRIM(a.curr_id)) as curr_id
                ,a.unit_price as unit_price
                ,a.amt_gross as amt_gross
                ,a.amt_disc as amt_disc
                ,a.amt_tax as amt_tax
                ,a.pct_disc as pct_disc
                ,a.amt_net as amt_net
                ,LTRIM(RTRIM(a.ord_desc)) as ord_desc
                ,LTRIM(RTRIM(a.remark)) as remark
                ,FORMAT(a.dt_req_ship, 'dd MMM yyyy') as dt_req_ship
                ,LTRIM(RTRIM(a.req_week)) as req_week
                ,LTRIM(RTRIM(a.req_month)) as req_month
                ,LTRIM(RTRIM(a.req_year)) as req_year
                ,LTRIM(RTRIM(a.stat)) as stat
                ,a.dt_created
                ,a.dt_modified
                ,LTRIM(RTRIM(a.user_id)) as user_id
                ,LTRIM(RTRIM(a.aplikasi_note)) as aplikasi_note
                from order_book_dtl a LEFT OUTER JOIN prod_spec b
                on a.prod_code = b.prod_code
                where a.book_id = '$id'"));

        return \DataTables::of($data)

        ->addColumn('Action', function($data) {
            return '<button id="deleteItem" data-id1="'.$data->book_id.'"
            data-id2="'.$data->item_num.'" class="btn-flat">
            <i class="material-icons left">delete</i></button>';
        })
        ->rawColumns(['Action'])
        ->make(true);

        // dd($data);
    }

    public function getOrderHeader($id){

        $result = DB::connection("sqlsrv2")
                    ->table('order_book_hdr')
                    ->select('cust_id', 'cons_id', 'salesman_id', 'proj_flag', 'pay_term_id','cust_po_num','remark1','remark2')
                    ->where('book_id', '=', $id)
                    ->first();

        return response()->json(['cust_id' => $result->cust_id, 'cons_id' => $result->cons_id, 'salesman_id' => $result->salesman_id,
        'proj_flag' => $result->proj_flag, 'pay_term_id' => $result->pay_term_id, 'cust_po_num' => $result->cust_po_num,
        'remark1' => $result->remark1, 'remark2' => $result->remark2]);

    }

    public function updateOrderHeader(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $cust_name = $request->cust_name;
        if(!$cust_name){
            $cust_name = '';
        }
        $cust_address = $request->cust_address;
        if(!$cust_address){
            $cust_address = '';
        }
        $phone = $request->phone;
        if(!$phone){
            $phone = '';
        }
        $cons_id = $request->cons_id;
        if(!$cons_id){
            $cons_id = '';
        }
        $ship_to = $request->ship_to;
        if(!$ship_to){
            $ship_to = '';
        }
        $salesman_id = $request->salesman_id;
        if(!$salesman_id){
            $salesman_id = '';
        }
        $remark1 = $request->remark1;
        if (!$remark1){
            $remark1 = '';
        }
        $remark2 = $request->remark2;
        if (!$remark2){
            $remark2 = '';
        }
        $pay_term_id = $request->pay_term_id;
        if (!$pay_term_id){
            $pay_term_id = '';
        }
        $cust_po_num = $request->cust_po_num;
        if (!$cust_po_num){
            $cust_po_num = '';
        }

        try{

            $header = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->where('book_id', '=', $request->book_id)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->update([
                            'tr_date' => $tr_date,
                            'cust_id' => $request->cust_id,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'pay_term_id' => $pay_term_id,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

            return response()->json(['response' => 'Order Updated']);
        }
        catch(QueryException $ex){

            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }



    }

    public function cekHarga($id){

        $result = DB::connection("sqlsrv2")
                    ->table('price_list')
                    ->selectRaw('LTRIM(RTRIM(prod_spec.commodity_id)) as commodity_id, prod_spec.quality_id, prod_spec.prod_code, prod_spec.descr,
                    CAST(price_list.thick AS FLOAT(2)) as thick, CAST(price_list.spc_price AS FLOAT(2)) as spc_price, CAST(price_list.slit_cost AS FLOAT(2)) as slit_cost')
                    ->join('prod_spec', function($join){
                        $join->on('prod_spec.mill_id', '=', 'price_list.mill_id');
                        $join->on('prod_spec.thick', '=', 'price_list.thick');
                        $join->on('prod_spec.coat_mass', '=', 'price_list.coat_mass');
                    })
                    ->where('prod_spec.prod_code', '=', $id)
                    ->where('prod_spec.quality_id', '=', 'A')
                    ->first();


        $commodity_id = $result->commodity_id;
        $spc_price = $result->spc_price;
        $thick = $result->thick;
        $slit_cost = $result->slit_cost;

        if($commodity_id == "SLT"){
            if ($thick < 0.4){
                $slit_cost = 0;
                $hasil = ( $spc_price/1.1 ) + $slit_cost;
            }
            else{
                $hasil = ( $spc_price/1.1 ) + $slit_cost;
            }
        }
        else{
            $hasil = $spc_price/1.1;
        }

        return response()->json(['hasil' => $hasil]);


    }

    public function deleteOrderItem(Request $request){

        $i = 1;

        try{

            $del_dtl = DB::connection("sqlsrv2")
                    ->table('order_book_dtl')
                    ->where('book_id', '=', $request->book_id)
                    ->where('item_num', '=', $request->item_num)
                    ->delete();

            $check = DB::connection("sqlsrv2")
                    ->table('order_book_dtl')
                    ->select('item_num')
                    ->where('book_id', '=', $request->book_id)
                    ->pluck('item_num');

            $count = DB::connection("sqlsrv2")
                    ->table('order_book_dtl')
                    ->select('*')
                    ->where('book_id', '=', $request->book_id)
                    ->count();

            if ($count > 0) {

                foreach($check as $check) {

                    $update = DB::connection("sqlsrv2")
                            ->table('order_book_dtl')
                            ->where('book_id', '=', $request->book_id)
                            ->where('item_num', '=', $check)
                            ->update([
                                'item_num' => $i,
                            ]);
                    $i++;
                }
                return response()->json(['response' => 'Item Deleted']);

            }

            else {

                $del_hdr = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->where('book_id', '=', $request->book_id)
                        ->delete();

                return response()->json(['response' => 'All item has been deleted, order canceled']);

            }

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }


    }

    public function editOrderItem($id){


        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $salesid  = Session::get('SALESID');
        $now = Carbon::now();
        $year_now =  $now->year;
        $a = $now->addYear(+10);
        $year_later = $a->year;

            try{

                $result = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->select('*')
                        ->where('book_id', '=', $id)
                        ->first();

                $createdBy = $result->user_id;
                $stat = $result->stat;

                if ($createdBy == $userid && $stat == "O") {

                    $book_id = $result->book_id;
                    $cust_id = $result->cust_id;
                    $cust_name = $result->cust_name;
                    $cust_address = $result->cust_address;
                    $phone = $result->phone;
                    $cons_id = $result->cons_id;
                    $ship_to = $result->ship_to;
                    $salesman_id = $result->salesman_id;
                    $pay_term_id = $result->pay_term_id;
                    $proj_flag = $result->proj_flag;
                    $cust_po_num= $result->cust_po_num;
                    $remark1= $result->remark1;
                    $remark2= $result->remark2;

                    if ($groupid == 'KOORDINATOR' || $groupid == 'PRIV' || $groupid == 'DEVELOPMENT'){

                        $listsales = DB::connection("sqlsrv2")
                                    ->table('salesman')
                                    ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                                    ->where('active_flag', '=', 'Y')
                                    ->get();

                                    return view('layouts.EditPreOrder',[
                                        'listsales' => $listsales,
                                        'book_id' => $book_id,
                                        'cust_id' => $cust_id,
                                        'cust_name' => $cust_name,
                                        'cust_address' => $cust_address,
                                        'phone' => $phone,
                                        'cons_id' => $cons_id,
                                        'ship_to' => $ship_to,
                                        'salesman_id' => $salesman_id,
                                        'pay_term_id' => $pay_term_id,
                                        'proj_flag' => $proj_flag,
                                        'cust_po_num' => $cust_po_num,
                                        'remark1' => $remark1,
                                        'remark2' => $remark2,
                                        'year_now' => $year_now,
                                        'year_later' => $year_later
                                        ]);
                    }
                    else {

                        $listsales = DB::connection("sqlsrv2")
                                    ->table('salesman')
                                    ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                                    ->where('salesman_id', '=', $salesid)
                                    ->where('active_flag', '=', 'Y')
                                    ->get();

                                    return view('layouts.EditPreOrder',[
                                        'listsales' => $listsales,
                                        'book_id' => $book_id,
                                        'cust_id' => $cust_id,
                                        'cust_name' => $cust_name,
                                        'cust_address' => $cust_address,
                                        'phone' => $phone,
                                        'cons_id' => $cons_id,
                                        'ship_to' => $ship_to,
                                        'salesman_id' => $salesman_id,
                                        'pay_term_id' => $pay_term_id,
                                        'proj_flag' => $proj_flag,
                                        'cust_po_num' => $cust_po_num,
                                        'remark1' => $remark1,
                                        'remark2' => $remark2,
                                        'year_now' => $year_now,
                                        'year_later' => $year_later
                                        ]);
                    }

                }
                else if ($createdBy != $userid && $stat != "O"){
                    return redirect('ListPreOrder')->with("alert", "This order not created by you, status is not open either");
                }
                else if ($stat != "O"){
                    return redirect('ListPreOrder')->with("alert", "Status of this order is not OPEN anymore");
                }
                else if ($createdBy != $userid){
                    return redirect('ListPreOrder')->with("alert", "You cant edit this order, this is not an order you made");
                }


            }
            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
            }

    }

    public function submitOrder(Request $request){

        $bookId = $request->book_id;
        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();

        try {

            $checkHeader = DB::connection("sqlsrv2")
                        ->table('order_book_hdr')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->first();

            if($checkHeader){

                $updateHeader = DB::connection("sqlsrv2")
                                ->table('order_book_hdr')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '=', 'O')
                                ->update([
                                    'stat' => 'P',
                                    'dt_posted' => $tr_date
                                ]);

                $updateDetail = DB::connection("sqlsrv2")
                                ->table('order_book_dtl')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '=', 'O')
                                ->update([
                                    'stat' => 'P',
                                    'dt_posted' => $tr_date
                                ]);

               if ($updateHeader && $updateDetail){
                    return response()->json(['response' => 'Order Submitted']);
                }
                else if (!$updateHeader && $updateDetail){
                    return response()->json(['response' => "Something error when update header order"]);
                }
                else if ($updateHeader && !$updateDetail){
                    return response()->json(['response' => "Something error when update detail order"]);
                }
                else {
                    return response()->json(['response' => "Failed to submit order"]);
                }

            }
            else {
                return response()->json(['response' => "Book Id not found"]);

            }
        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }

    }

    public function confirmOrder(Request $request){

        $bookId = $request->book_id;
        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();

        try {

            $checkHeader = DB::connection("sqlsrv2")
                            ->table('order_book_hdr')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->where('stat', '=', 'R')
                            ->first();

            if($checkHeader){

                $totalOrder = DB::connection("sqlsrv2")
                                ->table('order_book_dtl')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->count();

                $countNotR = DB::connection("sqlsrv2")
                                ->table('order_book_dtl')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '<>', 'R')
                                ->count();

                $countR = DB::connection("sqlsrv2")
                            ->table('order_book_dtl')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->where('stat', '=', 'R')
                            ->count();

                    if ($totalOrder != $countR ) {

                        return response()->json(['response' => 'From total of '.$totalOrder. ' items order, there are only '.$countR.' items whose prices have been confirmed, while '.$countNotR.' others have not. Pls kindly contacted your admin. Thankyou.']);
                    }

                    else {


                        $updateHeader = DB::connection("sqlsrv2")
                                ->table('order_book_hdr')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '=', 'R')
                                ->update([
                                    'stat' => 'S',
                                    'dt_confirm' => $tr_date
                                ]);

                        $updateDetail = DB::connection("sqlsrv2")
                                        ->table('order_book_dtl')
                                        ->where('book_id', '=', $bookId)
                                        ->where('user_id', '=', $userid)
                                        ->where('stat', '=', 'R')
                                        ->update([
                                            'stat' => 'S',
                                            'dt_confirm' => $tr_date
                                        ]);

                        if ($updateHeader && $updateDetail){
                            return response()->json(['response' => 'Order Confirmed']);
                        }
                        else if (!$updateHeader && $updateDetail){
                            return response()->json(['response' => "Something error when update header order"]);
                        }
                        else if ($updateHeader && !$updateDetail){
                            return response()->json(['response' => "Something error when update detail order"]);
                        }
                        else {
                            return response()->json(['response' => "Failed to confirm order"]);
                        }
                    }
            }
            else {
                return response()->json(['response' => "You can't confirm order, this is not an order you made"]);
            }
        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }

    }

    public function deleteOrder(Request $request){

        $bookId = $request->book_id;
        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();

        try {

            $result = DB::connection("sqlsrv2")
                            ->table('order_book_hdr')
                            ->select('*')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->first();


            if($result){

                $stat = $result->stat;

                if($stat == "O" || $stat == "P"){

                    $updateHeader = DB::connection("sqlsrv2")
                                    ->table('order_book_hdr')
                                    ->where('book_id', '=', $bookId)
                                    ->where('user_id', '=', $userid)
                                    ->whereIn('stat', ['O','P'])
                                    ->delete();

                    $updateDetail = DB::connection("sqlsrv2")
                                    ->table('order_book_dtl')
                                    ->where('book_id', '=', $bookId)
                                    ->where('user_id', '=', $userid)
                                    ->whereIn('stat', ['O','P'])
                                    ->delete();

                    if ($updateHeader && $updateDetail){
                        return response()->json(['response' => 'Order Deleted']);
                    }
                    else if (!$updateHeader && $updateDetail){
                        return response()->json(['response' => "Something error when delete header order"]);
                    }
                    else if ($updateHeader && !$updateDetail){
                        return response()->json(['response' => "Something error when delete detail order"]);
                    }
                    else {
                        return response()->json(['response' => "Failed to delete order"]);
                    }

                }
                else if ($stat == "R" || $stat == "S" || $stat == "C"){
                    return response()->json(['response' => "Current status from this order make this order not possible to be deleted"]);

                }

            }
            else {
                return response()->json(['response' => "This order not created by you, you can't delete it"]);
            }

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }

    }

}
