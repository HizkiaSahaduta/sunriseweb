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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        
        return view('layouts.home');
    }

    public function getDashboard() {

        $dashboardHeader = '';
        $dashboardContent = '';

        $data = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT 'CGL2' AS line, * FROM OPENQUERY([192.168.1.142], 'WITH x ( shift, crew, shift_time, crc_id) AS
                (SELECT TOP 1 SHIFT, CREW, REVISION, (SELECT TOP 1 ENCOILID FROM CGL_REPORT_DATA ORDER BY  WELDED_TIME DESC) AS NOCRC FROM CFG_CURRENT ORDER BY REVISION DESC)
                SELECT x.shift, x.crew, CONVERT(varchar, x.shift_time, 100) as shift_time, x.crc_id,
                CONVERT(varchar, a.welded_time, 100) as welded_time, a.ENTHICK, a.ENWIDTH, a.ENWEIGHT, a.LINE_SPEED_CEN as ENLINE_SPEED, PORPOS as ENPORPOS,
                b.GRADE, b.AZ, b.LINE_SPEED_CEN as CENLINE_SPEED,
                (select top 1 EXCOILID from CGL_PDO order by END_DATE desc) as Coil_id,
                (select top 1 EXCUTLENGHT from CGL_PDO order by END_DATE desc) as EX_TENSION_LOOP,
                (select top 1 EXCUTWEIGHT from CGL_PDO order by END_DATE desc) as EX_TENSION_REAL,
                (select top 1 ENDTIME from CGL_PDO order by END_DATE desc) as EX_QUALITY,
                (select top 1 EXWEIT from CGL_PDO order by END_DATE desc) as EX_WEIGHT,
                (select top 1 EXLEN from CGL_PDO order by END_DATE desc) as EX_LEN,
                CONVERT(varchar,(select top 1 END_DATE from CGL_PDO order by END_DATE desc), 100) as END_DATE,
                (select top 1 VAL13AVG from CGL_SEG_DATA order by REVISION desc) as ENSpeed_sec,
                (select top 1 VAL14AVG from CGL_SEG_DATA order by REVISION desc) as CENSpeed_sec
                FROM x 
                join CGL_REPORT_DATA a on x.crc_id = a.encoilid
                join CGL_REPORT_CEN b on x.crc_id = b.ENCOILID')"));

        foreach ($data as $data) {

            $dashboardContent .= '
            
            <h5 style="font-weight: 900;">Last Production Summary :</h5>
            <div class="row indigo lighten-5">
            <div class="col s12 m12 users-view-timeline">
                <h6 class="indigo-text m-0">Last Update @'.$data->END_DATE.' (updated every 1 mins)</h6>
            </div>
            </div>
            <div class="col s12 m4 l4 xl4">
                <div class="card animate fadeLeft">
                    <div class="card-content">
                        <div class="row blue lighten-5">
                            <div class="col s12 m12 users-view-timeline">
                                <h6 style="font-weight: 600;" class="blue-text text-darken-3 m-0"><i class="material-icons">link</i> Entry</h6>
                            </div>
                        </div>
                        <table>
                        <tbody>
                            <tr>
                            <td style="font-weight: 600;">CRCID:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.$data->crc_id.'</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Welded Time:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.$data->welded_time.'</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Thickness:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.number_format($data->ENTHICK,2,",",".").' mm</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Width:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.number_format($data->ENWIDTH,2,",",".").' mm</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Weight:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.number_format($data->ENWEIGHT,2,",",".").' KG</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Porpos:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.$data->ENPORPOS.'</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">AVG Speed:</td>
                            <td class="blue-text text-darken-3" style="font-weight: 600;">'.number_format($data->ENLINE_SPEED,2,",",".").' mpm</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4 xl4">
                <div class="card animate fadeLeft">
                    <div class="card-content">
                        <div class="row orange lighten-5">
                            <div class="col s12 m12 users-view-timeline">
                                <h6 style="font-weight: 600;" class="orange-text text-darken-3 m-0"><i class="material-icons">center_focus_strong</i> Center</h6>
                            </div>
                        </div>
                        <table>
                        <tbody>
                            <tr>
                            <td style="font-weight: 600;">Grade:</td>
                            <td class="orange-text text-darken-3" style="font-weight: 600;">'.$data->GRADE.'</td> 
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">AZ:</td>
                            <td class="orange-text text-darken-3" style="font-weight: 600;">'.$data->AZ.'</td> 
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">AVG Speed:</td>
                            <td class="orange-text text-darken-3" style="font-weight: 600;">'.number_format($data->CENLINE_SPEED,2,",",".").' mpm</td> 
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4 xl4">
                <div class="card animate fadeLeft">
                    <div class="card-content">
                        <div class="row green lighten-5">
                            <div class="col s12 m12 users-view-timeline">
                                <h6 style="font-weight: 600;" class="green-text text-darken-3 m-0"><i class="material-icons">cancel</i> Exit</h6>
                            </div>
                        </div>
                        <table>
                        <tbody>
                            <tr>
                            <td style="font-weight: 600;">CoilID:</td>
                            <td style="font-weight: 600;" class="green-text text-darken-3">'.$data->Coil_id.'</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Weight:</td>
                            <td style="font-weight: 600;" class="green-text text-darken-3">'.number_format($data->EX_WEIGHT,2,",",".").' KG</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Length:</td>
                            <td style="font-weight: 600;" class="green-text text-darken-3">'.number_format($data->EX_LEN,2,",",".").' Meters</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">Quality:</td>
                            <td style="font-weight: 600;" class="green-text text-darken-3">'.$data->EX_QUALITY.'</td>
                            </tr>
                            <tr>
                            <td style="font-weight: 600;">CuttingTime:</td>
                            <td style="font-weight: 600;" class="green-text text-darken-3">'.$data->END_DATE.'</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>';

            return response()->json(['dashboardHeader' => $dashboardHeader, 'dashboardContent' => $dashboardContent]);





        }


    }

    public function updateSpeed() {

        $dashboardHeader = "";
        $realtimedata = "";
        $az = "-";
        $consume = 0;
        $lenprod = 0;

        $updateSpeed = DB::connection("sqlsrv2")
                        ->select(DB::raw("SELECT * FROM OPENQUERY([192.168.1.142], 'select * from (select top 5 datediff(mi, REVISION, getDate()) as sub_min, CONVERT(varchar, revision, 8) as date, CAST(CONVERT(CHAR(20), revision,113) AS varchar(20)) as date2, convert(decimal(16,2), VAL13AVG) as ENSpeed_sec, convert(decimal(16,2), VAL14AVG) as CENSpeed_sec from CGL_SEG_DATA order by REVISION desc ) as x order by date')"));

        
        $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("SELECT * FROM OPENQUERY([192.168.1.142], 'select top 1 CAST(CONVERT(CHAR(20), revision,113) AS varchar(20)) as date, (select top 1 crew from CFG_CURRENT ORDER BY revision desc) as crew
                    from CGL_SEG_DATA ORDER BY REVISION desc') a"));

        $data2 = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT * FROM OPENQUERY([192.168.1.142], 'select top 1 ENCOILID, ENDPOS from CGL_SEG_DATA ORDER BY REVISION desc')"));
    
        foreach ($data2 as $data2) {

            $encoilid = $data2->ENCOILID;
            $consume = number_format($data2->ENDPOS, 2, '.', '');
        }

        $data3 = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT * FROM OPENQUERY([192.168.1.142], 'select  ENCOILID, GRADE, ENTRY_THICK, ENTRY_WIDTH, ENTRY_LENGTH from CGL_PDI_PLAN') where ENCOILID = '$encoilid'"));

        foreach ($data3 as $data3) {

            $grade = $data3->GRADE;
            $thick = number_format($data3->ENTRY_THICK, 2, '.', '');
            $width = number_format($data3->ENTRY_WIDTH, 2, '.', '');
            $length = number_format($data3->ENTRY_LENGTH, 2, '.', '');
        }


        $data4 = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT * FROM OPENQUERY([192.168.1.142], 'select Top 1 ENCOILID, AZ from CGL_REPORT_CEN order by TIMESTAMP desc') where ENCOILID = '$encoilid' "));

        foreach ($data4 as $data4) {


            $az = $data4->AZ;

        }

        // $value = $length -  $endpos;


        $data5 = DB::connection("sqlsrv2")
                ->select(DB::raw("SELECT * FROM OPENQUERY([192.168.1.142], 'SELECT (select TOP 1 ENDPOS from CGL_SEG_DATA where EXCOILID is null AND ENCOILID = ''$encoilid'' ORDER BY REVISION desc) - (select TOP 1 ENDPOS from CGL_SEG_DATA where EXCOILID is null AND ENCOILID = ''$encoilid'' ORDER BY REVISION ASC) AS LENPROD')"));

        foreach ($data5 as $data5) {


            $lenprod = number_format($data5->LENPROD, 2, '.', '');

        }

        
        foreach ($data as $data) {

            $dashboardHeader .= '
            <h5 style="font-weight: 900;"> CGL2, Crew '.$data->crew.'</h5>
            <div class="row indigo lighten-5">
            <div class="col s12 m12 users-view-timeline">
                <h6 class="indigo-text m-0">Real Time Data, Last Update @'.$data->date.'</h6>
            </div>
            </div>
            
            <div class="row">
                <div class="col s12 m4 l4 card-width">
                    <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">album</i>
                        <h5 class="m-0"><b>'.$length.'</b></h5>
                        <p>'.$encoilid.'</p>
                    </div>
                    </div>
                </div>
                <div class="col s12 m4 l4 card-width">
                    <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">donut_small</i>
                        <h5 class="m-0"><b>'.$consume.'</b></h5>
                        <p>Consume</p>
                    </div>
                    </div>
                </div>
                <div class="col s12 m4 l4 card-width">
                    <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">fiber_smart_record</i>
                        <h5 class="m-0"><b>'.$lenprod.'</b></h5>
                        <p>CoilProd</p>
                    </div>
                    </div>
                </div>
            </div>';
        }

        $realtimedata .= '
        <div class="col s12 m4 l4 xl4">
            <div class="card">
                <div class="card-content">
                    <div class="row cyan lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 style="font-weight: 600;" class="cyan-text text-darken-3 m-0"><i class="material-icons">timer</i> Real Time Data</h6>
                        </div>
                    </div>
                    <table>
                    <tbody>
                        <tr>
                        <tr>
                        <td style="font-weight: 600;">Entry Thickness:</td>
                        <td class="cyan-text text-darken-3">'.$thick.'</td>
                        </tr>
                        <tr>
                        <td style="font-weight: 600;">Entry Width:</td>
                        <td class="cyan-text text-darken-3">'.$width.'</td>
                        </tr>
                        <tr>
                        <td style="font-weight: 600;">Grade:</td>
                        <td class="cyan-text text-darken-3">'.$grade.'</td>
                        </tr>
                        <tr>
                        <td style="font-weight: 600;">AZ:</td>
                        <td class="cyan-text text-darken-3">'.$az.'</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>';
        
        return response()->json(['updateSpeed' => $updateSpeed, 'dashboardHeader' => $dashboardHeader, 'realtimedata' => $realtimedata, 'az' => $az]);

        // dd($result);

        


    }



    // public function index()
    // {

    //     $userid = Session::get('USERNAME');
    //     $groupid = Session::get('GROUPID');
    //     $salesid  = Session::get('SALESID');

    //     $curr = Carbon::now('Asia/Jakarta');
    //     //$curr->setTimezone('UTC +7');
    //     //$curr = Carbon::parse('2020-12-31');

    //     if ($curr->isFuture()){

    //         $curr_month =  $curr->month;
    //         $prev_month = $curr->subMonth()->month;
    //         $year = $curr->subYear()->year;
    //     }
    //     else {

    //         $curr_month =  $curr->month;
    //         $prev_month = $curr->subMonth()->month;
    //         $year =  $curr->year;
    //     }


    //     if ($groupid == "DEVELOPMENT" || $groupid == "KOORDINATOR" || $groupid == "PRU")

    //         {

    //             // Dashboard Order
    //             $order_sum_prev = DB::connection("sqlsrv2")
    //                             ->table('dashboard_order')
    //                             ->selectRaw('cast(sum(total_order) as float) as prev_total')
    //                             ->where('month', '=', $prev_month)
    //                             ->where('year', '=', $year)
    //                             ->first();

    //             $order_sum_curr = DB::connection("sqlsrv2")
    //                             ->table('dashboard_order')
    //                             ->selectRaw('cast(sum(total_order) as float) as curr_total')
    //                             ->where('month', '=', $curr_month)
    //                             ->where('year', '=', $year)
    //                             ->first();

    //             $order_list_sales = DB::connection("sqlsrv2")
    //                             ->select(DB::raw("SELECT a.salesman_id, a.salesman_name, a.month, a.year, b.total_order as prev_order, a.total_order as curr_order,
    //                             (( cast(a.total_order as float) / cast(b.total_order as float)) * 100) - 100 as prosentase
    //                             FROM dashboard_order a
    //                             LEFT OUTER JOIN dashboard_order b
    //                             ON a.salesman_id = b.salesman_id
    //                             where a.month = $curr_month and a.year = $year and b.month = $prev_month and b.year = $year"));

    //             $order_graph = DB::connection("sqlsrv2")
    //                             ->select(DB::raw("SELECT a.salesman_id, a.salesman_name, a.month, a.year, cast(b.total_order as float) as prev_order,
    //                             cast(a.total_order as float) as curr_order
    //                             FROM dashboard_order a
    //                             LEFT OUTER JOIN dashboard_order b
    //                             ON a.salesman_id = b.salesman_id
    //                             where a.month = $curr_month and a.year = $year and b.month = $prev_month and b.year = $year"));


    //             $order_prev_total = $order_sum_prev->prev_total;
    //             $order_curr_total = $order_sum_curr->curr_total;
    //             $order_hitung = (($order_curr_total / $order_prev_total) * 100) - 100;

    //             if ($order_hitung >= 0) {

    //                     $order_cek = "up";

    //             }
    //             else {

    //                     $order_cek = "down";

    //             }

    //             $order_kategori = array();
    //             $order_prev = array();
    //             $order_curr = array();

    //             foreach ($order_graph as $order_graph) {

    //                 $order_kategori[] = LTRIM(RTRIM($order_graph->salesman_name));
    //                 $order_prev[] = $order_graph->prev_order;
    //                 $order_curr[] = $order_graph->curr_order;

    //             }

    //             $order_kategori = join("','",$order_kategori);
    //             $order_prev = join(",",$order_prev);
    //             $order_curr = join(",",$order_curr);
    //             //echo $order_kategori."<br>".$order_prev."<br>".$order_curr;


    //             return view('layouts.home',['year' => $year, 'curr_month' => $curr_month, 'prev_month' => $prev_month,
    //             'order_prev_total' => $order_prev_total, 'order_curr_total' => $order_curr_total, 'order_hitung' => $order_hitung,
    //             'cek' => $order_cek, 'order_list_sales' => $order_list_sales, 'order_kategori' => $order_kategori,
    //             'order_prev' => $order_prev, 'order_curr' => $order_curr]);

    //             //echo number_format($prev_total, 2,',' , '.')."<br>".number_format($curr_total, 2,',' , '.')."<br>".round($hitung, 2)."<br>".$cek;


    //         }


    //     else if ($groupid == "SALES")

    //         {

    //             $order_sum_prev = DB::connection("sqlsrv2")
    //                             ->table('dashboard_order')
    //                             ->selectRaw('cast(sum(total_order) as float) as prev_total')
    //                             ->where('month', '=', $prev_month)
    //                             ->where('year', '=', $year)
    //                             ->where('salesman_id', '=', $salesid)
    //                             ->first();

    //             $order_sum_curr = DB::connection("sqlsrv2")
    //                             ->table('dashboard_order')
    //                             ->selectRaw('cast(sum(total_order) as float) as curr_total')
    //                             ->where('month', '=', $curr_month)
    //                             ->where('year', '=', $year)
    //                             ->where('salesman_id', '=', $salesid)
    //                             ->first();


    //             $order_list_sales = DB::connection("sqlsrv2")
    //                             ->select(DB::raw("SELECT a.salesman_id, a.salesman_name, a.month, a.year, b.total_order as prev_order, a.total_order as curr_order,
    //                             (( cast(a.total_order as float) / cast(b.total_order as float)) * 100) - 100 as prosentase
    //                             FROM dashboard_order a
    //                             LEFT OUTER JOIN dashboard_order b
    //                             ON a.salesman_id = b.salesman_id
    //                             where a.month = $curr_month and a.year = $year and b.month = $prev_month and b.year = $year
    //                             and a.salesman_id='$salesid'"));


    //             $order_graph = DB::connection("sqlsrv2")
    //                             ->select(DB::raw("SELECT distinct a.salesman_id, a.salesman_name,
    //                             a.month as m1, cast(a.total_order as float) as t1,
    //                             b.month as m2, cast(b.total_order as float) as t2,
    //                             c.month as m3, cast(c.total_order as float) as t3
    //                             FROM dashboard_order a
    //                             LEFT OUTER JOIN dashboard_order b
    //                             ON a.salesman_id = b.salesman_id
    //                             LEFT OUTER JOIN dashboard_order c
    //                             ON b.salesman_id = c.salesman_id
    //                             LEFT OUTER JOIN dashboard_order d
    //                             ON c.salesman_id = d.salesman_id
    //                             where a.month = $curr_month and a.year = $year and
    //                             b.month = (a.month)-1 and b.year = $year and
    //                             c.month = (a.month)-2 and c.year = $year and a.salesman_id = '$salesid'"));


    //             $order_prev_total = $order_sum_prev->prev_total;
    //             $order_curr_total = $order_sum_curr->curr_total;
    //             $order_hitung = (($order_curr_total / $order_prev_total) * 100) - 100;

    //             if ($order_hitung >= 0) {

    //                     $order_cek = "up";

    //             }
    //             else {

    //                     $order_cek = "down";

    //             }

    //             $order_kategori = array();
    //             $order_series = array();

    //             foreach ($order_graph as $order_graph) {

    //                 $order_kategori[] = date("F", mktime(0, 0, 0, $order_graph->m3, 1));
    //                 $order_kategori[] = date("F", mktime(0, 0, 0, $order_graph->m2, 1));
    //                 $order_kategori[] = date("F", mktime(0, 0, 0, $order_graph->m1, 1));
    //                 $order_series[] = $order_graph->t3;
    //                 $order_series[] = $order_graph->t2;
    //                 $order_series[] = $order_graph->t1;

    //             }

    //             $order_kategori = join("','",$order_kategori);
    //             $order_series = join(",",$order_series);



    //             //dd($order_list_sales);

    //             return view('layouts.home',['year' => $year, 'curr_month' => $curr_month, 'prev_month' => $prev_month,
    //             'order_prev_total' => $order_prev_total, 'order_curr_total' => $order_curr_total, 'order_hitung' => $order_hitung,
    //             'cek' => $order_cek, 'order_list_sales' => $order_list_sales, 'order_kategori' => $order_kategori,
    //             'order_series' => $order_series ]);

    //         }

    //     else
    //     {
    //         return redirect('home')->with("alert", "You are not allowed to view this page");
    //     }

    //     //echo $groupid;

    // }

    // public function ChangeDefaultPassword(Request $request)
    // {

    //     $newPass = $request->password;

    //     if($newPass != 'kencana123')
    //     {
    //         DB::connection("sqlsrv")
    //             ->table('users')
    //             ->where('username', '=', Auth::User()->username)
    //             ->update(['password' => Hash::make($newPass), 'plain_password' => $newPass]);
    //     }
    //     else
    //     {
    //         return view('layouts.ChangeDefaultPassword')->with('alert','Cannot use default password as new password.');
    //     }

    // }

    // public function ChangeAll()
    // {
    //     $user = DB::table('sec_user_sunrise')
    //     ->select('user_id2')
    //     ->pluck('user_id2');

    //     foreach($user as $user) {
    //         $password = DB::table('sec_user_sunrise')
    //                         ->select('user_pass')
    //                         ->where('user_id2', '=', $user)
    //                         ->value('user_pass');

    //         $update = DB::table('sec_user_sunrise')
    //         ->where('user_id2', '=', $user)
    //         ->update(['username' => $user, 'password' => Hash::make($password)]);
    //     }

    //     return view('layouts.home');
    // }

    // public static function getMonthName($monthNumber)
    // {

    //     return date("F", mktime(0, 0, 0, $monthNumber, 1));

    // }

}
