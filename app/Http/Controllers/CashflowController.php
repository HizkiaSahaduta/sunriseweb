<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CashflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.Cashflow');
    }

    public function CashflowGraph(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $sqlWhere = '1=1';

        $curr = Carbon::now();
        $month =  $curr->month;
        $year =  $curr->year;

        $currPeriod = $year + $month;

        if($start)
        {
            if($end)
            {
                $sqlWhere = $sqlWhere . " and a.periode between '" .$start. "' and '" .$end. "' ";
            }
            else
            {
                $sqlWhere = $sqlWhere . " and a.periode between '" .$start. "' and '" .$currPeriod. "' ";
            }
        }
        elseif($end)
        {
            $sqlWhere = $sqlWhere . " and a.periode between '" .$end. "' and '" .$currPeriod. "' ";
        }
        else
        {
            $sqlWhere = $sqlWhere . " and a.tahun = '" .$year. "' ";
        }

        $result = DB::connection('sqlsrv2')
                    ->table('cash_flow_in as a')
                    ->join('cash_flow_out as b', 'b.bulan', '=', 'a.bulan')
                    ->selectRaw("a.tahun, sum(a.payment) as cash_in, sum(b.payment) as cash_out, (case 
                                when a.bulan = 1 then 'January'
                                when a.bulan = 2 then 'February'
                                when a.bulan = 3 then 'March'
                                when a.bulan = 4 then 'April'
                                when a.bulan = 5 then 'May'
                                when a.bulan = 6 then 'June'
                                when a.bulan = 7 then 'July'
                                when a.bulan = 8 then 'August'
                                when a.bulan = 9 then 'September'
                                when a.bulan = 10 then 'October'
                                when a.bulan = 11 then 'November'
                                when a.bulan = 12 then 'December'
                                end) as bulan")
                    ->whereRaw($sqlWhere)
                    ->orderBy('a.tahun', 'asc')
                    ->orderBy('a.bulan', 'asc')
                    ->groupBy('a.tahun', 'a.bulan')
                    ->get();

        return response()->json($result);
    }


}
