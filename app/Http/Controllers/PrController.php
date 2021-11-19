<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB, Auth;
use Carbon\Carbon;

class PrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.PrApp');

    }

    public function getPrHdr(Request $request)
    {
        $username = $request->username;
        $mill = $request->mill;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $where = "";

        switch ($mill) {
            case 'SR':
                    if (isset($request->aprv)) {
                        if ($request->aprv == 'Y') {
                            $where.= " and a.dt_aprv1 != '1900-01-01 00:00:00.000'";

                        } else {
                            $where.= " and a.dt_aprv1 = '1900-01-01 00:00:00.000'";

                        }
                    } 
                    if (isset($request->status)) {

                        $where.= " and a.stat = '$request->status'";
                    }

                    if (isset($request->raw)) {

                        $where.= " and a.raw_flag = '$request->raw'";
                    }

                    if (isset($request->pic_id) && isset($request->dept_id)) {

                        $where.= " and a.dept_id = '$request->dept_id' and a.pic_id = '$request->pic_id'";
                    }

                    if ($dt_start && !$dt_end) {

                        $where.= " and a.dt_pr = '$dt_start'";
                    }

                    if (!$dt_start && $dt_end) {

                        $where.= " and a.dt_pr = '$dt_end'";
                    }

                    if ($dt_start && $dt_end) {

                        $where.= " and a.dt_pr between '$dt_start' and '$dt_end'";
                    }

                    $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select a.pr_id, a.mill_id,
                        FORMAT(a.dt_pr, 'dd/MMM/yyyy') as dt_pr,
                        a.dept_id, a.pic_id, c.descr as department, b.pic_name, a.aprv1_flag, a.aprv2_flag, a.raw_flag, a.stat, a.memo_txt, FORMAT(a.dt_aprv1, 'dd MMM yyyy') as dt_aprv1, FORMAT(a.dt_aprv2, 'dd MMM yyyy') as dt_aprv2
                        from pr_hdr a
                        inner join pic_dept b on a.mill_id = b.mill_id and a.pic_id = b.pic_id
                        inner join depart c on a.mill_id = c.mill_id and a.dept_id = c.dept_id 
                        "." ".$where."
                        order by a.dt_pr desc"));                    
                    
                    return \DataTables::of($data)
                        ->addColumn('APRV1', function ($data) {
                            if ($data->dt_aprv1 == '01 Jan 1900' && $data->dt_aprv2 == '01 Jan 1900') {
                                $check = $this->checkApprove(LTRIM(RTRIM($data->dept_id)), 1);
                                if ($check == true) {
                                    $update = '<button type="button" class="btn btn-primary" id="moveApprove1"
                                    data-mill="'.LTRIM(RTRIM($data->mill_id)).'" data-pr="'.LTRIM(RTRIM($data->pr_id)).'" style="font-size: 12px;background-color: #1e88e5!important;">APPROVE</button>';
                                } else {
                                    $update = '<span class="btn btn-danger btn-sm">Not Approved</span>';
                                }

                            }
                            elseif ($data->dt_aprv1 != '01 Jan 1900' && $data->dt_aprv2 == '01 Jan 1900') {
                                $check = $this->checkApprove(LTRIM(RTRIM($data->dept_id)), 1);
                                if ($check == true) {
                                    $update = '<button type="button" class="btn btn-primary" id="moveUnApprove1"
                                    data-mill="'.LTRIM(RTRIM($data->mill_id)).'" data-pr="'.LTRIM(RTRIM($data->pr_id)).'" style="font-size: 12px;background-color:#f57f17!important;">UNAPPROVE</button>';
                                } else {
                                    $update = '<span class="btn btn-primary btn-sm" style="background-color: #43a047;">' . $data->dt_aprv1 . '</span>';
                                }
                            } 
                            elseif ($data->dt_aprv1 != '01 Jan 1900' && $data->dt_aprv2 != '01 Jan 1900') {
                                $update = '<span class="btn btn-primary btn-sm" style="background-color: #43a047;">' . $data->dt_aprv1 . '</span>';
                            }
                            return $update;
                        })
                        ->addColumn('APRV2', function ($data) {
                            if ($data->dt_aprv1 != '01 Jan 1900' && $data->dt_aprv2 == '01 Jan 1900') {
                                $check = $this->checkApprove(LTRIM(RTRIM($data->dept_id)), 2);
                                if ($check == true) {
                                    $update = '<button type="button" class="btn btn-primary" id="moveApprove2"
                                    data-mill="'.LTRIM(RTRIM($data->mill_id)).'" data-pr="'.LTRIM(RTRIM($data->pr_id)).'" style="font-size: 12px;background-color: #1e88e5!important;">APPROVE</button>';
                                } else {
                                    $update = '<span class="btn btn-danger btn-sm">Not Approved</span>';
                                }
                            } 
                            elseif ($data->dt_aprv1 != '01 Jan 1900' && $data->dt_aprv2 != '01 Jan 1900') {
                                $check = $this->checkApprove(LTRIM(RTRIM($data->dept_id)), 2);
                                if ($check == true) {
                                    $update = '<button type="button" class="btn btn-primary" id="moveUnApprove2"
                                    data-mill="'.LTRIM(RTRIM($data->mill_id)).'" data-pr="'.LTRIM(RTRIM($data->pr_id)).'" style="font-size: 12px;background-color:#f57f17!important;">UNAPPROVE</button>';
                                } else {
                                    $update = '<span class="btn btn-primary btn-sm" style="background-color: #43a047;">' . $data->dt_aprv2 . '</span>';
                                }
                            }  
                            elseif ($data->dt_aprv1 == '01 Jan 1900' && $data->dt_aprv2 == '01 Jan 1900') {
                                $update = '<span class="btn btn-danger btn-sm">Not Approved</span>';
                            }
                            return $update;
                        })
                        ->addColumn('Detail', function($data) {
                            return '<a href="#DetailPrModal" id="getDetailPr" class="tooltipped modal-trigger"
                            data-position="top" data-tooltip="View Detail" data-id1="'.LTRIM(RTRIM($data->mill_id)).'"
                            data-id2="'.LTRIM(RTRIM($data->pr_id)).'" data-id3="'.LTRIM(RTRIM($data->raw_flag)).'" data-id4="'.LTRIM(RTRIM($data->aprv1_flag)).'">
                            <i class="material-icons">remove_red_eye</i></a>';
                        })
                        ->rawColumns(['APRV1', 'APRV2', 'Detail'])
                        ->make(true);

                break;
            
            case 'SM':

                break;
            
            default:
            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");
        }
    }

    public function getDetailRawNo(Request $request)
    {
        $mill = $request->id1;
        $pr_id = urldecode($request->id2);
        $raw_flag = $request->id3;


        switch ($mill) {

            case "SR":

                $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select a.mill_id, a.pr_id,a.pr_item, a.prod_code, b.descr as prod_name,
                        cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                        isnull(c.item_desc1,' ') as descr, isnull(c.item_desc2, ' ') as descr2, a.remark
                        from pr_item a
                        inner join prod_spec b on a.mill_id = b.mill_id and a.prod_code = b.prod_code
                        left outer join pr_item_desc c on a.mill_id = c.mill_id and a.pr_id = c.pr_id and a.pr_item = c.pr_item
                        where a.pr_id = '$pr_id' order by a.pr_item asc"));

                return \DataTables::of($data)
                ->make(true);


            break;

            case "SM":

                // $data = DB::connection("sqlsrv3")
                //         ->select(DB::raw("select a.mill_id, a.pr_id, a.pru_item, a.prod_code, b.descr as prod_name,
                //         cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                //         isnull(c.item_desc1,' ') as descr, isnull(c.item_desc2, ' ') as descr2, a.remark
                //         from pru_item a
                //         inner join prod_spec b on a.mill_id = b.mill_id and a.prod_code = b.prod_code
                //         left outer join pru_item_desc c on a.mill_id = c.mill_id and a.pr_id = c.pr_id and a.pru_item = c.pru_item
                //         where a.pr_id = '$pr_id'"));

                // return \DataTables::of($data)
                // ->make(true);


            break;

            default:

            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");

        }
    }

    public function getDetailRawYes(Request $request)
    {
        $mill = $request->id1;
        $pr_id = urldecode($request->id2);
        $raw_flag = $request->id3;


        switch ($mill) {

            case "SR":

                $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select a.mill_id, a.pr_id, a.pr_item, a.grade_spec, b.descr as prod_name,
                        cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                        isnull(c.item_desc1,' ') as descr1, isnull(c.item_desc2,' ') as descr2, a.remark
                        from pr_item a
                        inner join grade_spec b on a.mill_id = b.mill_id and a.grade_spec = b.grade_spec
                        left outer join pr_item_desc c on a.mill_id = c.mill_id and a.pr_id = c.pr_id and a.pr_item = c.pr_item
                        where a.pr_id = '$pr_id' order by a.pr_item asc"));

                return \DataTables::of($data)
                ->make(true);


            break;

            case "SM":

                // $data = DB::connection("sqlsrv3")
                //         ->select(DB::raw("select top 100 a.mill_id, a.pr_id, a.pru_item, a.grade_spec, b.descr as prod_name,
                //         cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                //         isnull(c.item_desc1,' ') as descr1, isnull(c.item_desc2,' ') as descr2, a.remark
                //         from pru_item a
                //         inner join grade_spec b on a.mill_id = b.mill_id and a.grade_spec = b.grade_spec
                //         left outer join pru_item_desc c on a.mill_id = c.mill_id and a.pr_id = c.pr_id and a.pru_item = c.pru_item
                //         where a.pr_id = '$pr_id' order by a.pru_item asc"));

                // return \DataTables::of($data)
                // ->make(true);


            break;

            default:

            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");

        }
    }

    public function setApprove(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pr_id = $request->pr;



        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pr_hdr')
                            ->where('pr_id', '=', $pr_id)
                            ->where('mill_id', '=', $mill)
                            ->update(['aprv1_flag' => 'Y', 'dt_aprv1' => $dt]);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                // try
                // {
                //     $data = DB::connection("sqlsrv3")
                //             ->table('pr_hdr')
                //             ->where('pr_id', '=',$pr_id)
                //             ->update(['aprv_flag' => 'Y', 'aprv_by' => $userid, 'dt_aprv' => $dt]);
                // }
                // catch(Exception $e)
                // {
                //      return response()->json(array('message' =>$e->getMessage()));
                // }

            break;

            default:

            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function setReset(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pr_id = $request->pr;


        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pr_hdr')
                            ->where('pr_id', '=',$pr_id)
                            ->update(['aprv1_flag' => '', 'dt_aprv1' => '1900-01-01 00:00:00.000']);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                // try
                // {
                //     $data = DB::connection("sqlsrv3")
                //             ->table('pr_hdr')
                //             ->where('pr_id', '=',$pr_id)
                //             ->update(['reject_flag' => '', 'aprv_flag' => '', 'aprv_by' => '', 'dt_aprv' => '1900-01-01 00:00:00.000']);
                // }
                // catch(Exception $e)
                // {
                //      return response()->json(array('message' =>$e->getMessage()));
                // }

            break;

            default:

            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function setApprove2(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pr_id = $request->pr;

        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pr_hdr')
                            ->where('pr_id', '=', $pr_id)
                            ->where('mill_id', '=', $mill)
                            ->update(['aprv2_flag' => 'Y', 'dt_aprv2' => $dt]);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                // try
                // {
                //     $data = DB::connection("sqlsrv3")
                //             ->table('pr_hdr')
                //             ->where('pr_id', '=',$pr_id)
                //             ->update(['aprv_flag' => 'Y', 'aprv_by' => $userid, 'dt_aprv' => $dt]);
                // }
                // catch(Exception $e)
                // {
                //      return response()->json(array('message' =>$e->getMessage()));
                // }

            break;

            default:

            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function setReset2(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pr_id = $request->pr;


        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pr_hdr')
                            ->where('pr_id', '=',$pr_id)
                            ->update(['aprv2_flag' => '', 'dt_aprv2' => '1900-01-01 00:00:00.000']);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                // try
                // {
                //     $data = DB::connection("sqlsrv3")
                //             ->table('pr_hdr')
                //             ->where('pr_id', '=',$pr_id)
                //             ->update(['reject_flag' => '', 'aprv_flag' => '', 'aprv_by' => '', 'dt_aprv' => '1900-01-01 00:00:00.000']);
                // }
                // catch(Exception $e)
                // {
                //      return response()->json(array('message' =>$e->getMessage()));
                // }

            break;

            default:

            return redirect('layouts.PrApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function checkApprove($deptId, $approve)
    {
        $user = Auth::user()->username;

        if ($approve == 1) {
            $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("
                        SELECT mill_id, dept_id, loginusername 
                        from department
                        where active_flag = 'Y' and dept_id = '$deptId' and loginusername = '$user'
                        "));

            if (count($data) > 0) {
                return true;
            } else {
                return false;
            }
        }

        if ($approve == 2) {
            $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("
                        SELECT appl_id, user_id2, var_id 
                        from sec_env_conf
                        where active_flag = 'Y' and var_id = 'APRVPR2' and user_id2 = '$user'
                        "));

            if (count($data) > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

}
