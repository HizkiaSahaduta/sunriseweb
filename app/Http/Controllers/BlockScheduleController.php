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

class BlockScheduleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.BlockSchedule');
    }

    public function getBlockSchedule (Request $request) {


        $orderid = $request->orderid;
        $foundInfo = '';

        // CGL1
        $sched_id_1 = '';
        $header1 = '';
        $listStep1 = '';
        $detailStep1 = '';
        $listFound1 = '';
        $headerFound1 = '';

        $cgl1 = DB::connection("sqlsrv2")
                    ->select(DB::raw("SELECT mach_type, mach_id, LTRIM(RTRIM(sched_id)) as sched_id, 
                    FORMAT(dt_sched, 'dd MMM yyyy') as dt_sched,
                    FORMAT(dt_awal, 'dd MMM yyyy') as dt_awal,
                    FORMAT(dt_akhir, 'dd MMM yyyy') as dt_akhir, 
                    stat from view_sched where mach_id = '01' and stat = 'P'
                    group by mach_type, mach_id, sched_id, dt_sched, dt_awal, dt_akhir, stat"));

        foreach ($cgl1 as $cgl1) {

            $sched_id_1 = $cgl1->sched_id;

            $header1 .= '
            <div class="col s12 m12 users-view-timeline">
                <h6 class="indigo-text m-0">'.$sched_id_1.'('.$cgl1->dt_sched.')</h6>
                <p>'.$cgl1->dt_awal.' - '.$cgl1->dt_akhir.'</p>
                <div id="headerQuery1"></div>
            </div>';
            
        }

        $step1 = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(sched_id)) as sched_id, step_num, stat from view_stat_sched where mach_id = '01' and sched_id = '$sched_id_1' 
                group by sched_id, step_num, stat order by step_num"));

        $firstdetail1 = DB::connection("sqlsrv2")
                        ->table('view_stat_sched')
                        ->select('step_num')
                        ->where('mach_id','=', '01')
                        ->where('sched_id', '=', $sched_id_1)
                        ->orderby('step_num', 'asc')
                        ->value('step_num');

        $seqnum1 = DB::connection("sqlsrv2")
                    ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = $firstdetail1"));


        // CGL2
        $sched_id_2 = '';
        $header2 = '';
        $listStep2 = '';
        $detailStep2 = '';
        $listFound2 = '';
        $headerFound2 = '';

        $cgl2 = DB::connection("sqlsrv2")
                    ->select(DB::raw("SELECT mach_type, mach_id, LTRIM(RTRIM(sched_id)) as sched_id, 
                    FORMAT(dt_sched, 'dd MMM yyyy') as dt_sched,
                    FORMAT(dt_awal, 'dd MMM yyyy') as dt_awal,
                    FORMAT(dt_akhir, 'dd MMM yyyy') as dt_akhir, 
                    stat from view_sched where mach_id = '02' and stat = 'P'
                    group by mach_type, mach_id, sched_id, dt_sched, dt_awal, dt_akhir, stat"));

        foreach ($cgl2 as $cgl2) {

            $sched_id_2 = $cgl2->sched_id;

            $header2 .= '
            <div class="col s12 m12 users-view-timeline">
                <h6 class="indigo-text m-0">'.$sched_id_2.'('.$cgl2->dt_sched.')</h6>
                <p>'.$cgl2->dt_awal.' - '.$cgl2->dt_akhir.'</p>
                <div id="headerQuery2"></div>
            </div>';
            
        }


        $step2 = DB::connection("sqlsrv2")
                ->select(DB::raw("select LTRIM(RTRIM(sched_id)) as sched_id, step_num, stat from view_stat_sched where mach_id = '02' and sched_id = '$sched_id_2' 
                group by sched_id, step_num, stat order by step_num"));

        $firstdetail2 = DB::connection("sqlsrv2")
                        ->table('view_stat_sched')
                        ->select('step_num')
                        ->where('mach_id','=', '02')
                        ->where('sched_id', '=', $sched_id_2)
                        ->orderby('step_num', 'asc')
                        ->value('step_num');

        $seqnum2 = DB::connection("sqlsrv2")
                    ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = $firstdetail2"));



        if (!$orderid) { 

            //CGL1
            foreach ($seqnum1 as $seqnum1) {

                $detailStep1 .= '
                <blockquote>STEP '.$firstdetail1.', SEQ '.$seqnum1->seq_num.' ('.number_format($seqnum1->thick,2,",",".").' x '.$seqnum1->width.')</blockquote>
                <table class="responsive-table">
                <thead>
                <tr>
                    <th>ProdCode</th>
                    <th>Descr</th>
                    <th>CustName</th>
                    <th>OrderID</th>
                    <th>WgtOrder</th>
                    <th>WgtPlan</th>
                    <th>WgtProd</th>
                    <th>Dest</th>
                    <th>SCStat</th>
                </tr>
                </thead>
                <tbody>';

                $detail1 = DB::connection("sqlsrv2")
                            ->select(DB::raw("select seq_num, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                            wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                            from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = 10 and seq_num = $seqnum1->seq_num"));


                    foreach ($detail1 as $detail1) { 


                        $detailStep1 .= '
                        <tr>
                            <td>'.$detail1->prod_code.'</td>
                            <td>'.$detail1->descr.'</td>
                            <td>'.$detail1->cust_name.'</td>
                            <td>'.$detail1->order_id.'</td>
                            <td>'.number_format($detail1->wgt_ord/1000,2,",",".").'</td>
                            <td>'.number_format($detail1->wgt_plan/1000,2,",",".").'</td>
                            <td>'.number_format($detail1->wgt_prod/1000,2,",",".").'</td>
                            <td>'.$detail1->dest.'</td>
                            <td>'.$detail1->sc_stat.'</td>
                        </tr>';

                    }

                $detailStep1 .= '
                </tbody></table>';

            }

            $detailStep1 .= '</div>';

        
            foreach ($step1 as $step1) {

                if ($step1->stat == "C") {

                        $listStep1 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="detailStep1 active" href="#step'.$step1->step_num.'" style="color :#ffff;">STEP '.$step1->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';

                }

                else {

                    $listStep1 .= '
                    <li class="tab"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="detailStep1 active" href="#step'.$step1->step_num.'">STEP '.$step1->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';
                    
                }
                
            }

            // CGL2

            foreach ($seqnum2 as $seqnum2) {

                $detailStep2 .= '
                <blockquote>STEP '.$firstdetail2.', SEQ '.$seqnum2->seq_num.' ('.number_format($seqnum2->thick,2,",",".").' x '.$seqnum2->width.')</blockquote>
                <table class="responsive-table">
                <thead>
                <tr>
                    <th>ProdCode</th>
                    <th>Descr</th>
                    <th>CustName</th>
                    <th>OrderID</th>
                    <th>WgtOrder</th>
                    <th>WgtPlan</th>
                    <th>WgtProd</th>
                    <th>Dest</th>
                    <th>SCStat</th>
                </tr>
                </thead>
                <tbody>';

                $detail2 = DB::connection("sqlsrv2")
                            ->select(DB::raw("select seq_num, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                            wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                            from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = 10 and seq_num = $seqnum2->seq_num"));


                    foreach ($detail2 as $detail2) { 


                        $detailStep2 .= '
                        <tr>
                            <td>'.$detail2->prod_code.'</td>
                            <td>'.$detail2->descr.'</td>
                            <td>'.$detail2->cust_name.'</td>
                            <td>'.$detail2->order_id.'</td>
                            <td>'.number_format($detail2->wgt_ord/1000,2,",",".").'</td>
                            <td>'.number_format($detail2->wgt_plan/1000,2,",",".").'</td>
                            <td>'.number_format($detail2->wgt_prod/1000,2,",",".").'</td>
                            <td>'.$detail2->dest.'</td>
                            <td>'.$detail2->sc_stat.'</td>
                        </tr>';

                    }

                $detailStep2 .= '
                </tbody></table>';

            }

            $detailStep2 .= '</div>';

        
            foreach ($step2 as $step2) {

                if ($step2->stat == "C") {

                        $listStep2 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'" style="color :#ffff;">STEP '.$step2->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';

                }

                else {

                    $listStep2 .= '
                    <li class="tab"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'">STEP '.$step2->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';
                    
                }
                
            }
            
        }


        else {

            $check1 = DB::connection("sqlsrv2")
                    ->table('view_sched')
                    ->select('order_id')
                    ->where('mach_id','=', '01')
                    ->where('sched_id', '=', $sched_id_1)
                    ->where('order_id', '=', $orderid)
                    ->count();

            $check2 = DB::connection("sqlsrv2")
                    ->table('view_sched')
                    ->select('order_id')
                    ->where('mach_id','=', '02')
                    ->where('sched_id', '=', $sched_id_2)
                    ->where('order_id', '=', $orderid)
                    ->count();


            if ($check1 > 0 && $check2 > 0) {

                // CGL1

                $foundInfo = "CGL1CGL2";

                $step1 = DB::connection("sqlsrv2")
                    ->select(DB::raw("
                    select a.*,
                    case 
                    when 
                    b.step_num is null then ''
                    else 'match' 
                    end as ket from (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '01' and x.sched_id = '$sched_id_1'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) a
                    left outer join (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '01' and x.sched_id = '$sched_id_1' and x.order_id = '$orderid'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) b 
                    on a.step_num = b.step_num order by a.step_num"));


                $firstdetail1 = DB::connection("sqlsrv2")
                                ->table('view_sched')
                                ->select('step_num')
                                ->where('mach_id','=', '01')
                                ->where('sched_id', '=', $sched_id_1)
                                ->where('order_id', '=', $orderid)
                                ->orderby('step_num', 'asc')
                                ->value('step_num');

                $seqnum1 = DB::connection("sqlsrv2")
                            ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = $firstdetail1"));

                foreach ($seqnum1 as $seqnum1) {

                    $detailStep1 .= '
                    <blockquote>STEP '.$firstdetail1.', SEQ '.$seqnum1->seq_num.' ('.number_format($seqnum1->thick,2,",",".").' x '.$seqnum1->width.')</blockquote>
                    <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>ProdCode</th>
                        <th>Descr</th>
                        <th>CustName</th>
                        <th>OrderID</th>
                        <th>WgtOrder</th>
                        <th>WgtPlan</th>
                        <th>WgtProd</th>
                        <th>Dest</th>
                        <th>SCStat</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $detail1 = DB::connection("sqlsrv2")
                                ->select(DB::raw("select seq_num, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                                wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                                from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = $firstdetail1 and seq_num = $seqnum1->seq_num"));


                        foreach ($detail1 as $detail1) { 


                            $detailStep1 .= '
                            <tr>
                                <td>'.$detail1->prod_code.'</td>
                                <td>'.$detail1->descr.'</td>
                                <td>'.$detail1->cust_name.'</td>
                                <td>'.$detail1->order_id.'</td>
                                <td>'.number_format($detail1->wgt_ord/1000,2,",",".").'</td>
                                <td>'.number_format($detail1->wgt_plan/1000,2,",",".").'</td>
                                <td>'.number_format($detail1->wgt_prod/1000,2,",",".").'</td>
                                <td>'.$detail1->dest.'</td>
                                <td>'.$detail1->sc_stat.'</td>
                            </tr>';

                        }

                    $detailStep1 .= '
                    </tbody></table>';

                }

                $detailStep1 .= '</div>';

            
                foreach ($step1 as $step1) {


                    if ($step1->ket == 'match' && $step1->stat == "C") {

                        $listStep1 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="active detailStep1" href="#step'.$step1->step_num.'" style="color :#ffff;"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step1->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                    
                        $listFound1 .= $step1->step_num." ";

                    }


                    if ($step1->ket == 'match' && $step1->stat != "C") { 


                        $listStep1 .= '
                        <li class="tab"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="active detailStep1" href="#step'.$step1->step_num.'"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step1->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';
                    
                        $listFound1 .= $step1->step_num." ";



                    }

                    if ($step1->ket != 'match' && $step1->stat == "C") { 

                        $listStep1 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="active detailStep1" href="#step'.$step1->step_num.'" style="color :#ffff;">STEP '.$step1->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                

                    }


                    if ($step1->ket != 'match' && $step1->stat != "C") { 


                        $listStep1 .= '
                        <li class="tab"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="active detailStep1" href="#step'.$step1->step_num.'">STEP '.$step1->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';

                    }

                }

                $headerFound1 = '<p>'.$orderid.' found in StepNum: '.$listFound1.'</p>';


                //CGL2

                $step2 = DB::connection("sqlsrv2")
                    ->select(DB::raw("
                    select a.*,
                    case 
                    when 
                    b.step_num is null then ''
                    else 'match' 
                    end as ket from (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '02' and x.sched_id = '$sched_id_2'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) a
                    left outer join (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '02' and x.sched_id = '$sched_id_2' and x.order_id = '$orderid'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) b 
                    on a.step_num = b.step_num order by a.step_num"));

                $firstdetail2 = DB::connection("sqlsrv2")
                                ->table('view_sched')
                                ->select('step_num')
                                ->where('mach_id','=', '02')
                                ->where('sched_id', '=', $sched_id_2)
                                ->where('order_id', '=', $orderid)
                                ->orderby('step_num', 'asc')
                                ->value('step_num');

                $seqnum2 = DB::connection("sqlsrv2")
                            ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = $firstdetail2"));

                foreach ($seqnum2 as $seqnum2) {

                    $detailStep2 .= '
                    <blockquote>STEP '.$firstdetail2.', SEQ '.$seqnum2->seq_num.' ('.number_format($seqnum2->thick,2,",",".").' x '.$seqnum2->width.')</blockquote>
                    <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>ProdCode</th>
                        <th>Descr</th>
                        <th>CustName</th>
                        <th>OrderID</th>
                        <th>WgtOrder</th>
                        <th>WgtPlan</th>
                        <th>WgtProd</th>
                        <th>Dest</th>
                        <th>SCStat</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $detail2 = DB::connection("sqlsrv2")
                                ->select(DB::raw("select seq_num, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                                wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                                from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = $firstdetail2 and seq_num = $seqnum2->seq_num"));


                        foreach ($detail2 as $detail2) { 


                            $detailStep2 .= '
                            <tr>
                                <td>'.$detail2->prod_code.'</td>
                                <td>'.$detail2->descr.'</td>
                                <td>'.$detail2->cust_name.'</td>
                                <td>'.$detail2->order_id.'</td>
                                <td>'.number_format($detail2->wgt_ord/1000,2,",",".").'</td>
                                <td>'.number_format($detail2->wgt_plan/1000,2,",",".").'</td>
                                <td>'.number_format($detail2->wgt_prod/1000,2,",",".").'</td>
                                <td>'.$detail2->dest.'</td>
                                <td>'.$detail2->sc_stat.'</td>
                            </tr>';

                        }

                    $detailStep2 .= '
                    </tbody></table>';

                }

                $detailStep2 .= '</div>';

            
                foreach ($step2 as $step2) {


                    if ($step2->ket == 'match' && $step2->stat == "C") {

                        $listStep2 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'" style="color :#ffff;"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step2->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                    
                        $listFound2 .= $step2->step_num." ";

                    }


                    if ($step2->ket == 'match' && $step2->stat != "C") { 


                        $listStep2 .= '
                        <li class="tab"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step2->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';
                    
                        $listFound2 .= $step2->step_num." ";



                    }

                    if ($step2->ket != 'match' && $step2->stat == "C") { 

                        $listStep2 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'" style="color :#ffff;">STEP '.$step2->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                    


                    }


                    if ($step2->ket != 'match' && $step2->stat != "C") { 


                        $listStep2 .= '
                        <li class="tab"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'">STEP '.$step2->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';

                        
                    }

                    
                }

                $headerFound2 = '<p>'.$orderid.' found in StepNum: '.$listFound2.'</p>';

            }

            if ($check1 < 1 && $check2 > 0) {

                $foundInfo = "CGL2";

                $step2 = DB::connection("sqlsrv2")
                    ->select(DB::raw("
                    select a.*,
                    case 
                    when 
                    b.step_num is null then ''
                    else 'match' 
                    end as ket from (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '02' and x.sched_id = '$sched_id_2'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) a
                    left outer join (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '02' and x.sched_id = '$sched_id_2' and x.order_id = '$orderid'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) b 
                    on a.step_num = b.step_num order by a.step_num"));

                $firstdetail2 = DB::connection("sqlsrv2")
                                ->table('view_sched')
                                ->select('step_num')
                                ->where('mach_id','=', '02')
                                ->where('sched_id', '=', $sched_id_2)
                                ->where('order_id', '=', $orderid)
                                ->orderby('step_num', 'asc')
                                ->value('step_num');

                $seqnum2 = DB::connection("sqlsrv2")
                            ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = $firstdetail2"));

                foreach ($seqnum2 as $seqnum2) {

                    $detailStep2 .= '
                    <blockquote>STEP '.$firstdetail2.', SEQ '.$seqnum2->seq_num.' ('.number_format($seqnum2->thick,2,",",".").' x '.$seqnum2->width.')</blockquote>
                    <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>ProdCode</th>
                        <th>Descr</th>
                        <th>CustName</th>
                        <th>OrderID</th>
                        <th>WgtOrder</th>
                        <th>WgtPlan</th>
                        <th>WgtProd</th>
                        <th>Dest</th>
                        <th>SCStat</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $detail2 = DB::connection("sqlsrv2")
                                ->select(DB::raw("select seq_num, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                                wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                                from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = 10 and seq_num = $seqnum2->seq_num"));


                        foreach ($detail2 as $detail2) { 


                            $detailStep2 .= '
                            <tr>
                                <td>'.$detail2->prod_code.'</td>
                                <td>'.$detail2->descr.'</td>
                                <td>'.$detail2->cust_name.'</td>
                                <td>'.$detail2->order_id.'</td>
                                <td>'.number_format($detail2->wgt_ord/1000,2,",",".").'</td>
                                <td>'.number_format($detail2->wgt_plan/1000,2,",",".").'</td>
                                <td>'.number_format($detail2->wgt_prod/1000,2,",",".").'</td>
                                <td>'.$detail2->dest.'</td>
                                <td>'.$detail2->sc_stat.'</td>
                            </tr>';

                        }

                    $detailStep2 .= '
                    </tbody></table>';

                }

                $detailStep2 .= '</div>';

            
                foreach ($step2 as $step2) {


                    if ($step2->ket == 'match' && $step2->stat == "C") {

                        $listStep2 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'" style="color :#ffff;"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step2->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                    
                        $listFound2 .= $step2->step_num." ";

                    }


                    if ($step2->ket == 'match' && $step2->stat != "C") { 


                        $listStep2 .= '
                        <li class="tab"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step2->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';
                    
                        $listFound2 .= $step2->step_num." ";



                    }

                    if ($step2->ket != 'match' && $step2->stat == "C") { 

                        $listStep2 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'" style="color :#ffff;">STEP '.$step2->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                    


                    }


                    if ($step2->ket != 'match' && $step2->stat != "C") { 


                        $listStep2 .= '
                        <li class="tab"><a data-id1="'.$sched_id_2.'" data-id2="'.$step2->step_num.'" class="detailStep2 active" href="#step'.$step2->step_num.'">STEP '.$step2->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';

                        
                    }

                    
                }

                $headerFound2 = '<p>'.$orderid.' found in StepNum: '.$listFound2.'</p>';


                
            }

            if ($check1 > 0 && $check2 < 1) {

                $foundInfo = "CGL1";

                $step1 = DB::connection("sqlsrv2")
                    ->select(DB::raw("
                    select a.*,
                    case 
                    when 
                    b.step_num is null then ''
                    else 'match' 
                    end as ket from (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '01' and x.sched_id = '$sched_id_1'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) a
                    left outer join (
                    select x.sched_id, y.step_num, y.stat, x.thick, x.width from view_sched x
                    inner join view_stat_sched y on x.sched_id = y.sched_id and x.step_num = y.step_num
                    where x.mach_id = '01' and x.sched_id = '$sched_id_1' and x.order_id = '$orderid'
                    group by x.sched_id, y.step_num, y.stat, x.thick, x.width) b 
                    on a.step_num = b.step_num order by a.step_num"));


                $firstdetail1 = DB::connection("sqlsrv2")
                                ->table('view_sched')
                                ->select('step_num')
                                ->where('mach_id','=', '01')
                                ->where('sched_id', '=', $sched_id_1)
                                ->where('order_id', '=', $orderid)
                                ->orderby('step_num', 'asc')
                                ->value('step_num');

                $seqnum1 = DB::connection("sqlsrv2")
                            ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = $firstdetail1"));

                foreach ($seqnum1 as $seqnum1) {

                    $detailStep1 .= '
                    <blockquote>STEP '.$firstdetail1.', SEQ '.$seqnum1->seq_num.' ('.number_format($seqnum1->thick,2,",",".").' x '.$seqnum1->width.')</blockquote>
                    <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>ProdCode</th>
                        <th>Descr</th>
                        <th>CustName</th>
                        <th>OrderID</th>
                        <th>WgtOrder</th>
                        <th>WgtPlan</th>
                        <th>WgtProd</th>
                        <th>Dest</th>
                        <th>SCStat</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $detail1 = DB::connection("sqlsrv2")
                                ->select(DB::raw("select seq_num, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                                wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                                from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = 10 and seq_num = $seqnum1->seq_num"));


                        foreach ($detail1 as $detail1) { 


                            $detailStep1 .= '
                            <tr>
                                <td>'.$detail1->prod_code.'</td>
                                <td>'.$detail1->descr.'</td>
                                <td>'.$detail1->cust_name.'</td>
                                <td>'.$detail1->order_id.'</td>
                                <td>'.number_format($detail1->wgt_ord/1000,2,",",".").'</td>
                                <td>'.number_format($detail1->wgt_plan/1000,2,",",".").'</td>
                                <td>'.number_format($detail1->wgt_prod/1000,2,",",".").'</td>
                                <td>'.$detail1->dest.'</td>
                                <td>'.$detail1->sc_stat.'</td>
                            </tr>';

                        }

                    $detailStep1 .= '
                    </tbody></table>';

                }

                $detailStep1 .= '</div>';

            
                foreach ($step1 as $step1) {


                    if ($step1->ket == 'match' && $step1->stat == "C") {

                        $listStep1 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="detailStep1 active" href="#step'.$step1->step_num.'" style="color :#ffff;"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step1->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                    
                        $listFound1 .= $step1->step_num." ";

                    }


                    if ($step1->ket == 'match' && $step1->stat != "C") { 


                        $listStep1 .= '
                        <li class="tab"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="detailStep1 active" href="#step'.$step1->step_num.'"><span class="new badge blue" data-badge-caption=""><i class="material-icons">check</i></span> STEP '.$step1->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';
                    
                        $listFound1 .= $step1->step_num." ";



                    }

                    if ($step1->ket != 'match' && $step1->stat == "C") { 

                        $listStep1 .= '
                        <li class="tab teal darken-2"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="detailStep1 active" href="#step'.$step1->step_num.'" style="color :#ffff;">STEP '.$step1->step_num.' <span class="new badge red" data-badge-caption="C"></span></a></li>';
                

                    }


                    if ($step1->ket != 'match' && $step1->stat != "C") { 


                        $listStep1 .= '
                        <li class="tab"><a data-id1="'.$sched_id_1.'" data-id2="'.$step1->step_num.'" class="detailStep1 active" href="#step'.$step1->step_num.'">STEP '.$step1->step_num.' <span class="new badge grey darken-4" data-badge-caption="P"></span></a></li>';

                    }

                }

                $headerFound1 = '<p>'.$orderid.' found in StepNum: '.$listFound1.'</p>';

            }

            if ($check1 < 1 && $check2 < 1) {

                $foundInfo = "N/A";

            }

           

        }


        return response()->json(['header1' => $header1, 'listStep1' => $listStep1, 'detailStep1' => $detailStep1, 'listFound1' => $listFound1, 'headerFound1' => $headerFound1, 'header2' => $header2, 'listStep2' => $listStep2, 'detailStep2' => $detailStep2, 'listFound2' => $listFound2, 'headerFound2' => $headerFound2, 'foundInfo' => $foundInfo]);
       
    }

    public function getBlockScheduleDetail1 (Request $request) {


        $sched_id_1 = $request->sched_id_1;
        $stepnum1 = $request->stepnum1;
        $seqnum1_tmp = '';

        $detailStep1 = '';

     
        $detailStep1 .= '
        <div id="step'.$stepnum1.'" class="col s12">';
        
        $seqnum1 = DB::connection("sqlsrv2")
                    ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = $stepnum1"));
    
            foreach ($seqnum1 as $seqnum1) {

                if ($seqnum1_tmp != $seqnum1->seq_num) {

                    $detailStep1 .= '
                    <blockquote>STEP '.$stepnum1.', SEQ '.$seqnum1->seq_num.' ('.number_format($seqnum1->thick,2,",",".").' x '.$seqnum1->width.')</blockquote>
                    <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>ProdCode</th>
                        <th>Descr</th>
                        <th>CustName</th>
                        <th>OrderID</th>
                        <th>WgtOrder</th>
                        <th>WgtPlan</th>
                        <th>WgtProd</th>
                        <th>Dest</th>
                        <th>SCStat</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $detail1 = DB::connection("sqlsrv2")
                                ->select(DB::raw("select seq_num, thick, width, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                                wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                                from view_sched where mach_id = '01' and sched_id = '$sched_id_1' and step_num = $stepnum1 and seq_num = $seqnum1->seq_num order by seq_num asc"));


                        foreach ($detail1 as $detail1) { 


                            $detailStep1 .= '
                            <tr>
                                <td>'.$detail1->prod_code.'</td>
                                <td>'.$detail1->descr.'</td>
                                <td>'.$detail1->cust_name.'</td>
                                <td>'.$detail1->order_id.'</td>
                                <td>'.number_format($detail1->wgt_ord/1000,2,",",".").'</td>
                                <td>'.number_format($detail1->wgt_plan/1000,2,",",".").'</td>
                                <td>'.number_format($detail1->wgt_prod/1000,2,",",".").'</td>
                                <td>'.$detail1->dest.'</td>
                                <td>'.$detail1->sc_stat.'</td>
                            </tr>';

                        }

                  

                    $seqnum1_tmp = $seqnum1->seq_num;

                }

                $detailStep1 .= '
                </tbody></table>';

            }

            $detailStep1 .= '</div>';
    

                


        return response()->json(['detailStep1' => $detailStep1]);

            
        
    }

    public function getBlockScheduleDetail2 (Request $request) {


        $sched_id_2 = $request->sched_id_2;
        $stepnum2 = $request->stepnum2;
        $seqnum2_tmp = '';

        $detailStep2 = '';

     
        $detailStep2 .= '
        <div id="step'.$stepnum2.'" class="col s12">';
        
        $seqnum2 = DB::connection("sqlsrv2")
                    ->select(DB::raw("select seq_num, thick, width from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = $stepnum2"));
    
            foreach ($seqnum2 as $seqnum2) {

                if ($seqnum2_tmp != $seqnum2->seq_num) {

                    $detailStep2 .= '
                    <blockquote>STEP '.$stepnum2.', SEQ '.$seqnum2->seq_num.' ('.number_format($seqnum2->thick,2,",",".").' x '.$seqnum2->width.')</blockquote>
                    <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>ProdCode</th>
                        <th>Descr</th>
                        <th>CustName</th>
                        <th>OrderID</th>
                        <th>WgtOrder</th>
                        <th>WgtPlan</th>
                        <th>WgtProd</th>
                        <th>Dest</th>
                        <th>SCStat</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $detail2 = DB::connection("sqlsrv2")
                                ->select(DB::raw("select seq_num, thick, width, step_num, LTRIM(RTRIM(prod_code)) as prod_code, LTRIM(RTRIM(descr)) as descr, LTRIM(RTRIM(cust_name)) as cust_name, LTRIM(RTRIM(order_id)) as order_id,
                                wgt_ord, wgt_plan, wgt_prod, LTRIM(RTRIM(dest)) as dest, sc_stat
                                from view_sched where mach_id = '02' and sched_id = '$sched_id_2' and step_num = $stepnum2 and seq_num = $seqnum2->seq_num order by seq_num asc"));


                        foreach ($detail2 as $detail2) { 


                            $detailStep2 .= '
                            <tr>
                                <td>'.$detail2->prod_code.'</td>
                                <td>'.$detail2->descr.'</td>
                                <td>'.$detail2->cust_name.'</td>
                                <td>'.$detail2->order_id.'</td>
                                <td>'.number_format($detail2->wgt_ord/1000,2,",",".").'</td>
                                <td>'.number_format($detail2->wgt_plan/1000,2,",",".").'</td>
                                <td>'.number_format($detail2->wgt_prod/1000,2,",",".").'</td>
                                <td>'.$detail2->dest.'</td>
                                <td>'.$detail2->sc_stat.'</td>
                            </tr>';

                        }

                  

                    $seqnum2_tmp = $seqnum2->seq_num;

                }

                $detailStep2 .= '
                </tbody></table>';

            }

            $detailStep2 .= '</div>';
    

                


        return response()->json(['detailStep2' => $detailStep2]);

            
        
    }


}
