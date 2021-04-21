<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ListPreOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        return view('layouts.ListPreOrder');

    }

    public function getListorder(){

        $salesid  = Session::get('SALESID');

        if ($salesid) {

            $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select a.tr_date, FORMAT(a.tr_date, 'dd MMM yyyy HH:m:ss') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id
                    from order_book_hdr a
                    join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    where a.salesman_id = '$salesid'
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id order by a.tr_date desc"));

            return \DataTables::of($data)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") return '<span class="chip lighten-5 grey black-text">OPEN</span>';
                if ($data->stat == "P") return '<span class="chip lighten-5 orange orange-text">POSTED</span>';
                if ($data->stat == "R") return '<span class="chip lighten-5 green green-text">PRICE</span>';
                if ($data->stat == "S") return '<span class="chip lighten-5 blue blue-text">CONFIRM</span>';
                if ($data->stat == "C") return '<span class="chip lighten-5 purple purple-text">CLOSED</span>';
                if ($data->stat == "X") return '<span class="chip lighten-5 red red-text">REJECT</span>';
            })
            ->editColumn('amt_net', function ($data) {
                $quote_id = $data->quote_id;
                if ($quote_id)
                return ($data->amt_net*(10/100)) + $data->amt_net;

                if (!$quote_id)
                return $data->amt_net;
            })
            ->editColumn('images', function ($data) {
                if ($data->image == "N") return '<a href="UploadImg/id='.$data->book_id.'" class="tooltipped images" data-position="top" data-tooltip="Upload Images"><i class="material-icons">file_upload</i></a>';
                if ($data->image == "Y") return '<a href="UploadImg/id='.$data->book_id.'" class="tooltipped images" data-position="top" data-tooltip="View Images"><i class="material-icons">image</i></a>';
            })
            ->addColumn('Detail', function($data) {
                if ($data->stat == "O")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="black-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="editOrderItem/id='.$data->book_id.'" class="black-text tooltipped" data-position="top" data-tooltip="Edit">
                    <i class="material-icons">edit</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="black-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>
                <a href="javascript:void(0)" class="black-text deleteOrder tooltipped" data-position="top" data-tooltip="Delete" data-id="'.$data->book_id.'">
                    <i class="material-icons">delete_forever</i>
                </a>';

                if ($data->stat == "P")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="orange-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="orange-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>
                <a href="javascript:void(0)" class="orange-text deleteOrder tooltipped" data-position="top" data-tooltip="Delete" data-id="'.$data->book_id.'">
                    <i class="material-icons">delete_forever</i>
                </a>';

                if ($data->stat == "R")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="green-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="green-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>
                <a href="javascript:void(0)" class="green-text confirmOrder tooltipped" data-position="top" data-tooltip="Confirm" data-id="'.$data->book_id.'">
                    <i class="material-icons">check</i>
                </a>';

                if ($data->stat == "S")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="blue-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="blue-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>';

                if ($data->stat == "C")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="purple-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="purple-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>';
                if ($data->stat == "X")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="red-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="red-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>';
            })
            ->rawColumns(['Detail','stat','images','amt_net'])
            ->make(true);
        }
        else {

            $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select a.tr_date, FORMAT(a.tr_date, 'dd MMM yyyy HH:m:ss') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id
                    from order_book_hdr a
                    join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id order by a.tr_date desc"));

            return \DataTables::of($data)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") return '<span class="chip lighten-5 grey black-text">OPEN</span>';
                if ($data->stat == "P") return '<span class="chip lighten-5 orange orange-text">POSTED</span>';
                if ($data->stat == "R") return '<span class="chip lighten-5 green green-text">PRICE</span>';
                if ($data->stat == "S") return '<span class="chip lighten-5 blue blue-text">CONFIRM</span>';
                if ($data->stat == "C") return '<span class="chip lighten-5 purple purple-text">CLOSED</span>';
                if ($data->stat == "X") return '<span class="chip lighten-5 red red-text">REJECT</span>';
            })
            ->editColumn('amt_net', function ($data) {
                $quote_id = $data->quote_id;
                if ($quote_id)
                return ($data->amt_net*(10/100)) + $data->amt_net;

                if (!$quote_id)
                return $data->amt_net;
            })
            ->editColumn('images', function ($data) {
                if ($data->image == "N") return '<a href="UploadImg/id='.$data->book_id.'" class="tooltipped images" data-position="top" data-tooltip="Upload Images"><i class="material-icons">file_upload</i></a>';
                if ($data->image == "Y") return '<a href="UploadImg/id='.$data->book_id.'" class="tooltipped images" data-position="top" data-tooltip="View Images"><i class="material-icons">image</i></a>';
            })
            ->addColumn('Detail', function($data) {
                if ($data->stat == "O")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="black-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="editOrderItem/id='.$data->book_id.'" class="black-text tooltipped" data-position="top" data-tooltip="Edit">
                    <i class="material-icons">edit</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="black-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>
                <a href="javascript:void(0)" class="black-text deleteOrder tooltipped" data-position="top" data-tooltip="Delete" data-id="'.$data->book_id.'">
                    <i class="material-icons">delete_forever</i>
                </a>';

                if ($data->stat == "P")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="orange-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="orange-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>
                <a href="javascript:void(0)" class="orange-text deleteOrder tooltipped" data-position="top" data-tooltip="Delete" data-id="'.$data->book_id.'">
                    <i class="material-icons">delete_forever</i>
                </a>';

                if ($data->stat == "R")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="green-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="green-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>
                <a href="javascript:void(0)" class="green-text confirmOrder tooltipped" data-position="top" data-tooltip="Confirm" data-id="'.$data->book_id.'">
                    <i class="material-icons">check</i>
                </a>';

                if ($data->stat == "S")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="blue-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="blue-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>';

                if ($data->stat == "C")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="purple-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="purple-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>';
                if ($data->stat == "X")
                return
                '<a href="javascript:void(0)" data-target="detailOrderModal" class="red-text detailOrder tooltipped modal-trigger" data-position="top" data-tooltip="Quick View" data-id="'.$data->book_id.'">
                    <i class="material-icons">remove_red_eye</i>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" class="red-text tooltipped" data-position="top" data-tooltip="Print">
                    <i class="material-icons">print</i>
                </a>';
            })
            ->rawColumns(['Detail','stat','images','amt_net'])
            ->make(true);

        }
    }

    public function detailHdr(Request $request){
        $id = $request->id;
        $result = DB::connection("sqlsrv2")
                ->table('order_book_hdr')
                ->leftJoin('pay_term', 'order_book_hdr.pay_term_id', '=', 'pay_term.pay_term_id')
                ->select('order_book_hdr.*', 'pay_term.pay_term_desc')
                ->where('book_id', '=', $id)
                ->first();

        return response()->json(['cust_name' => $result->cust_name, 'cust_address' => $result->cust_address,
        'phone' => $result->phone, 'ship_to' => $result->ship_to, 'proj_flag' => $result->proj_flag,
        'pay_term_desc' => $result->pay_term_desc, 'cust_po_num' => $result->cust_po_num,
        'remark1' => $result->remark1, 'remark2' => $result->remark2]);

    }

    public function detailDtl(Request $request){

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

        ->editColumn('stat', function ($data) {
            if ($data->stat == "O") return '<span class="chip lighten-5 grey black-text">OPEN</span>';
            if ($data->stat == "P") return '<span class="chip lighten-5 orange orange-text">POSTED</span>';
            if ($data->stat == "R") return '<span class="chip lighten-5 green green-text">PRICE</span>';
            if ($data->stat == "S") return '<span class="chip lighten-5 blue blue-text">CONFIRM</span>';
            if ($data->stat == "C") return '<span class="chip lighten-5 purple purple-text">CLOSED</span>';
            if ($data->stat == "X") return '<span class="chip lighten-5 red red-text">REJECT</span>';
        })
        ->rawColumns(['stat'])
        ->make(true);

    }

}
