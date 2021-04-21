<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;

class PruAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.PruApp');

    }

    public function search_pic(Request $request)
    {
        $search = $request->input('term');
        $mill_id = $request->input('mill');


        if ($mill_id == "SR") {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select a.mill_id, a.pic_id, a.dept_id, b.dept_id, b.descr, a.pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id
                    where a.active_flag = 'Y' and a.pic_name like '%$search%'"));

            return response()->json($result);

        }

        else if ($mill_id == "SM")
        {

            $result = DB::connection("sqlsrv3")
                    ->select(DB::raw("select a.mill_id, a.pic_id, a.dept_id, b.dept_id, b.descr, a.pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id
                    where a.active_flag = 'Y' and a.pic_name like '%$search%'"));

            return response()->json($result);


        }
    }

    public function getPicDetail($id, $mill)
    {

        if ($mill == "SR") {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select a.mill_id, a.pic_id, a.dept_id, b.dept_id, b.descr, a.pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id
                    where a.active_flag = 'Y' and a.pic_id = '$id'"))[0];

            return response()->json($result);

        }

        else if ($mill == "SM")
        {

            $result = DB::connection("sqlsrv3")
                    ->select(DB::raw("select a.mill_id, a.pic_id, a.dept_id, b.dept_id, b.descr, a.pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id
                    where a.active_flag = 'Y' and a.pic_id = '$id'"))[0];

            return response()->json($result);


        }

    }

    public function getPruHdr(Request $request)
    {

        $username = $request->username;
        $mill = $request->mill;
        $dt_start = $request->dt_start;
        $dt_end = $request->dt_end;
        $where = "";

        // a.dt_pru between '$dt_start' and '$dt_end'

        if ($username == 'rafaela'){

            $where.= "where a.finish_flag = 'Y' and c.descr in ('SALES AND MARKETING','HUMAN RESOURCE & DEVELOPMENT')";
        }
        else if ($username == 'arief' || $username == 'dedi'){

            $where.= "where a.finish_flag = 'Y' and c.descr not in ('SALES AND MARKETING','HUMAN RESOURCE & DEVELOPMENT')";
        }

        else {

            $where.= "where a.finish_flag = 'Y'";

        }

        switch ($mill) {

            case "SR":

                    if (isset($request->aprv)) {

                        $where.= " and a.aprv_flag = '$request->aprv'";
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

                        $where.= " and a.dt_pru = '$dt_start'";
                    }

                    if (!$dt_start && $dt_end) {

                        $where.= " and a.dt_pru = '$dt_end'";
                    }

                    if ($dt_start && $dt_end) {

                        $where.= " and a.dt_pru between '$dt_start' and '$dt_end'";
                    }

                    $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select a.pru_id, a.mill_id,
                        FORMAT(a.dt_pru, 'dd MMM yyyy') as dt_pru,
                        a.dept_id, c.descr as department, a.pic_id, b.pic_name,
                        a.finish_flag, a.aprv_flag, a.reject_flag, a.aprv_by, a.raw_flag, a.stat, a.memo_txt,
                        FORMAT(a.dt_aprv, 'dd MMM yyyy') as dt_aprv
                        from pru_hdr a
                        inner join pic_dept b on a.mill_id = b.mill_id and a.pic_id = b.pic_id
                        inner join depart c on a.mill_id = c.mill_id and a.dept_id = c.dept_id"." ".$where.
                        "order by a.dt_pru desc"));

                    return \DataTables::of($data)
                    ->addColumn('Detail', function($data) {
                        return '<a href="#DetailPruModal" id="getDetailPru" class="tooltipped modal-trigger"
                        data-position="top" data-tooltip="View Detail" data-id1="'.LTRIM(RTRIM($data->mill_id)).'"
                        data-id2="'.LTRIM(RTRIM($data->pru_id)).'" data-id3="'.LTRIM(RTRIM($data->raw_flag)).'"
                        data-id4="'.LTRIM(RTRIM($data->aprv_flag)).'" data-id5="'.LTRIM(RTRIM($data->reject_flag)).'">
                        <i class="material-icons">remove_red_eye</i></a>';
                    })
                    ->rawColumns(['Detail'])
                    ->make(true);
                    // // dd($data);
                    // echo $where;

            break;


            case "SM":

                    if (isset($request->aprv)) {

                        $where.= " and a.aprv_flag = '$request->aprv'";
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

                        $where.= " and a.dt_pru between '$dt_start' and CAST('$dt_start' AS DATETIME) + 1";
                    }

                    if (!$dt_start && $dt_end) {

                        $where.= " and a.dt_pru between '$dt_end' and CAST('$dt_end' AS DATETIME) + 1";
                    }

                    if ($dt_start && $dt_end) {

                        $where.= " and a.dt_pru between '$dt_start' and '$dt_end'";
                    }

                    $data = DB::connection("sqlsrv3")
                            ->select(DB::raw("select a.pru_id, a.mill_id,
                            FORMAT(a.dt_pru, 'dd MMM yyyy') as dt_pru,
                            a.dept_id, c.descr as department, a.pic_id, b.pic_name,
                            a.finish_flag, a.aprv_flag, a.reject_flag, a.aprv_by, a.raw_flag, a.stat, a.memo_txt,
                            FORMAT(a.dt_aprv, 'dd MMM yyyy') as dt_aprv
                            from pru_hdr a
                            inner join pic_dept b on a.mill_id = b.mill_id and a.pic_id = b.pic_id
                            inner join depart c on a.mill_id = c.mill_id and a.dept_id = c.dept_id"." ".$where.
                            "order by a.dt_pru desc"));

                            return \DataTables::of($data)
                            ->addColumn('Detail', function($data) {
                                return '<a href="#DetailPruModal" id="getDetailPru" class="tooltipped modal-trigger"
                                data-position="top" data-tooltip="View Detail" data-id1="'.LTRIM(RTRIM($data->mill_id)).'"
                                data-id2="'.LTRIM(RTRIM($data->pru_id)).'" data-id3="'.LTRIM(RTRIM($data->raw_flag)).'"
                                data-id4="'.LTRIM(RTRIM($data->aprv_flag)).'" data-id5="'.LTRIM(RTRIM($data->reject_flag)).'">
                                <i class="material-icons">remove_red_eye</i></a>';
                            })
                            ->rawColumns(['Detail'])
                            ->make(true);

                break;

            default:

            return redirect('layouts.PruApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function getDetailRawNo(Request $request)
    {
        $mill = $request->id1;
        $pru_id = urldecode($request->id2);
        $raw_flag = $request->id3;


        switch ($mill) {

            case "SR":

                $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select a.mill_id, a.pru_id, a.pru_item, a.prod_code, b.descr as prod_name,
                        cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                        isnull(c.item_desc1,' ') as descr, isnull(c.item_desc2, ' ') as descr2, a.remark
                        from pru_item a
                        inner join prod_spec b on a.mill_id = b.mill_id and a.prod_code = b.prod_code
                        left outer join pru_item_desc c on a.mill_id = c.mill_id and a.pru_id = c.pru_id and a.pru_item = c.pru_item
                        where a.pru_id = '$pru_id'"));

                return \DataTables::of($data)
                ->make(true);


            break;

            case "SM":

                $data = DB::connection("sqlsrv3")
                        ->select(DB::raw("select a.mill_id, a.pru_id, a.pru_item, a.prod_code, b.descr as prod_name,
                        cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                        isnull(c.item_desc1,' ') as descr, isnull(c.item_desc2, ' ') as descr2, a.remark
                        from pru_item a
                        inner join prod_spec b on a.mill_id = b.mill_id and a.prod_code = b.prod_code
                        left outer join pru_item_desc c on a.mill_id = c.mill_id and a.pru_id = c.pru_id and a.pru_item = c.pru_item
                        where a.pru_id = '$pru_id'"));

                return \DataTables::of($data)
                ->make(true);


            break;

            default:

            return redirect('layouts.PruApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function getDetailRawYes(Request $request)
    {
        $mill = $request->id1;
        $pru_id = urldecode($request->id2);
        $raw_flag = $request->id3;


        switch ($mill) {

            case "SR":

                $data = DB::connection("sqlsrv2")
                        ->select(DB::raw("select top 100 a.mill_id, a.pru_id, a.pru_item, a.grade_spec, b.descr as prod_name,
                        cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                        isnull(c.item_desc1,' ') as descr1, isnull(c.item_desc2,' ') as descr2, a.remark
                        from pru_item a
                        inner join grade_spec b on a.mill_id = b.mill_id and a.grade_spec = b.grade_spec
                        left outer join pru_item_desc c on a.mill_id = c.mill_id and a.pru_id = c.pru_id and a.pru_item = c.pru_item
                        where a.pru_id = '$pru_id' order by a.pru_item asc"));

                return \DataTables::of($data)
                ->make(true);


            break;

            case "SM":

                $data = DB::connection("sqlsrv3")
                        ->select(DB::raw("select top 100 a.mill_id, a.pru_id, a.pru_item, a.grade_spec, b.descr as prod_name,
                        cast(a.qty as float) as qty, cast(a.wgt as float) as wgt, a.unit_meas,
                        isnull(c.item_desc1,' ') as descr1, isnull(c.item_desc2,' ') as descr2, a.remark
                        from pru_item a
                        inner join grade_spec b on a.mill_id = b.mill_id and a.grade_spec = b.grade_spec
                        left outer join pru_item_desc c on a.mill_id = c.mill_id and a.pru_id = c.pru_id and a.pru_item = c.pru_item
                        where a.pru_id = '$pru_id' order by a.pru_item asc"));

                return \DataTables::of($data)
                ->make(true);


            break;

            default:

            return redirect('layouts.PruApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function setApprove(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pru_id = $request->pru;



        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pru_hdr')
                            ->where('pru_id', '=',$pru_id)
                            ->update(['aprv_flag' => 'Y', 'aprv_by' => $userid, 'dt_aprv' => $dt]);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                try
                {
                    $data = DB::connection("sqlsrv3")
                            ->table('pru_hdr')
                            ->where('pru_id', '=',$pru_id)
                            ->update(['aprv_flag' => 'Y', 'aprv_by' => $userid, 'dt_aprv' => $dt]);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            default:

            return redirect('layouts.PruApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function setReject(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pru_id = $request->pru;



        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pru_hdr')
                            ->where('pru_id', '=',$pru_id)
                            ->update(['reject_flag' => 'N', 'aprv_by' => $userid, 'dt_aprv' => $dt]);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                try
                {
                    $data = DB::connection("sqlsrv3")
                            ->table('pru_hdr')
                            ->where('pru_id', '=',$pru_id)
                            ->update(['reject_flag' => 'N', 'aprv_by' => $userid, 'dt_aprv' => $dt]);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            default:

            return redirect('layouts.PruApp')->with("alert", "Wrong Mill ID!");

        }

    }

    public function setReset(Request $request)
    {

        $userid = Session::get('USERNAME');
        $dt = Carbon::now('Asia/Jakarta');
        $mill = $request->mill;
        $pru_id = $request->pru;


        switch ($mill) {

            case "SR":

                try
                {
                    $data = DB::connection("sqlsrv2")
                            ->table('pru_hdr')
                            ->where('pru_id', '=',$pru_id)
                            ->update(['reject_flag' => '', 'aprv_flag' => '', 'aprv_by' => '', 'dt_aprv' => '1900-01-01 00:00:00.000']);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            case "SM":

                try
                {
                    $data = DB::connection("sqlsrv3")
                            ->table('pru_hdr')
                            ->where('pru_id', '=',$pru_id)
                            ->update(['reject_flag' => '', 'aprv_flag' => '', 'aprv_by' => '', 'dt_aprv' => '1900-01-01 00:00:00.000']);
                }
                catch(Exception $e)
                {
                     return response()->json(array('message' =>$e->getMessage()));
                }

            break;

            default:

            return redirect('layouts.PruApp')->with("alert", "Wrong Mill ID!");

        }

    }


}
