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

class OrderReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $groupid = Session::get('GROUPID');
        $salesid  = Session::get('SALESID');

        if ($groupid == 'SALES') {

            $listsales = DB::connection("sqlsrv2")
                        ->table('salesman')
                        ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                        ->where('salesman_id', '=', $salesid)
                        ->where('active_flag', '=', 'Y')
                        ->get();

            return view('layouts.OrderReport',['listsales' => $listsales]);

        }

        elseif ($groupid == 'KKA') {

            $listsales = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(a.salesman_id)) as salesman_id, LTRIM(RTRIM(b.salesman_name)) as salesman_name
                    from view_order_status a inner join salesman b on a.salesman_id = b.salesman_id
                    where a.cust_id = 'C044'
                    group by a.salesman_id, b.salesman_name"));

            return view('layouts.OrderReport',['listsales' => $listsales]);

        }

        else {

            $listsales = DB::connection("sqlsrv2")
                        ->table('salesman')
                        ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                        ->whereRaw("active_flag = 'Y' or salesman_id = 'S009'")
                        ->get();

            return view('layouts.OrderReport',['listsales' => $listsales]);

        }
       
    }

    public function getOrderReport (Request $request){ 

        $txtMillID = $request->txtMillID;
        $txtStart = $request->txtStart;
        $txtEnd = $request->txtEnd;
        $txtSalesman  = $request->txtSalesman;
        $txtCustomer = $request->txtCustomer;
        $txtOrderID = $request->txtOrderID;
        $txtOutstanding  = $request->txtOutstanding;

        $where = 'where 1=1';

        if ($txtStart && $txtEnd) {
            $where .= " and a.dt_order between '$txtStart' and '$txtEnd'";
        }
        if ($txtStart && !$txtEnd) {
            $where .= " and a.dt_order >= '$txtStart'";
        }
        if (!$txtStart && $txtEnd) {
            $where .= " and a.dt_order <= '$txtEnd'";
        }

        if ($txtCustomer) { 
            $where .= " and a.cust_id = '$txtCustomer'";
        }

        if ($txtSalesman) { 
            $where .= " and a.salesman_id = '$txtSalesman'";
        }

        if ($txtOrderID) { 
            $where .= " and a.order_id = '$txtOrderID'";
        }

        if ($txtOutstanding) { 
            if ($txtOutstanding == 'Y') { 

                $where .= " and a.wgt_outstanding >= 0";

            }
            else {

                $where .= " and a.wgt_outstanding <= 0";

            }
        }

        $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select FORMAT(a.dt_order, 'dd MMM yyyy') as dt_order, a.order_id, a.stat, a.cust_name, a.salesman_name,
                    case
                        when dt_sched is not null then concat(FORMAT(b.dt_sched, 'dd MMM yyyy'),' - ',FORMAT(b.dt_akhir, 'dd MMM yyyy'))
                        else 'N/A'
                    end as tgl_plan, sum(a.wgt_outstanding) as wgt_outstanding
                    from view_order_status a
                    left join view_sched b on a.order_id = b.order_id
                    $where
                    group by a.dt_order, a.order_id, a.stat, a.cust_name, a.salesman_name, b.dt_sched, b.dt_akhir"));
        
                    return \DataTables::of($data)
                    ->addColumn('Detail', function($data) {
                        return
                        '<a href="javascript:void(0)" data-target="detailOrderModal" class="black-text detailOrderReport tooltipped modal-trigger" data-id="'.$data->order_id.'">
                            <i class="material-icons">remove_red_eye</i>
                        </a>';
                    })
                
                    ->rawColumns(['Detail'])
                    ->make(true);



    }

    public function getOrderReportDetail (Request $request){ 

        $txtOrderID = $request->txtOrderID;
       
        $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select item_num, descr, req_ship_week, wgt_ord, wgt_rsv, wgt_ppp, wgt_deliv, wgt_shipped, wgt_stock, wgt_plan, wgt_outstanding
                    from view_order_status where order_id = '$txtOrderID' order by 1"));
        
        return \DataTables::of($data)
        ->make(true);



    }

}
