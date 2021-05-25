<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class JSONController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function getVendor(Request $request){

        $search = $request->input('term');
        $mill_id = $request->input('mill');

        if ($mill_id == "SR") {

            $result = DB::connection("sqlsrv2")
                        ->table('vendor')
                        ->Where('vendor_name', 'LIKE', '%'. $search. '%')
                        ->orWhere("vendor_id", "=",  $search  )
                        ->take(5)
                        ->get();

            return response()->json($result);
        }

        else {

            $result = DB::connection("sqlsrv3")
                        ->table('vendor')
                        ->Where('vendor_name', 'LIKE', '%'. $search. '%')
                        ->orWhere("vendor_id", "=",  $search  )
                        ->take(5)
                        ->get();

            return response()->json($result);

        }
    }

    public function getCustomer(Request $request){

        $search = $request->input('term');
        $mill_id = $request->input('mill');

        if ($mill_id == "SR") {

            $result = DB::connection("sqlsrv2")
                        ->table('customer')
                        ->Where('cust_name', 'LIKE', '%'. $search. '%')
                        ->orWhere("cust_id", "=",  $search  )
                        ->take(5)
                        ->get();

            return response()->json($result);
        }

        else {

            $result = DB::connection("sqlsrv2")
                        ->table('customer')
                        ->Where('cust_name', 'LIKE', '%'. $search. '%')
                        ->orWhere("cust_id", "=",  $search  )
                        ->take(5)
                        ->get();

            return response()->json($result);

        }
    }

    public function listPay(){

        $result = DB::connection("sqlsrv2")
                ->table('pay_term')
                ->selectRaw('LTRIM(RTRIM(pay_term_id)) as pay_term_id, LTRIM(RTRIM(pay_term_desc)) as pay_term_desc')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function listCommodity(){

        $result = DB::connection("sqlsrv2")
                    ->table('commodity')
                    ->selectRaw('LTRIM(RTRIM(commodity_id)) as commodity_id, LTRIM(RTRIM(descr)) as descr')
                    ->where('category_id', '=', '01')
                    ->where('active_flag', '=', 'Y')
                    ->get();

        return response()->json($result);
    }

    public function listBrand(){

        $result = DB::connection("sqlsrv2")
                ->table('prod_brand')
                ->selectRaw('LTRIM(RTRIM(brand_id)) as brand_id, LTRIM(RTRIM(descr)) as descr')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function listCoat(){

        $result = DB::connection("sqlsrv2")
                ->table('brand_coat')
                ->selectRaw('LTRIM(RTRIM(coat_mass)) as coat_mass, LTRIM(RTRIM(brand_name)) as brand_name')
                ->where('coat_mass', '<>', '50')
                ->get();

        return response()->json($result);
    }

    public function listGrade(){

        $result =DB::connection("sqlsrv2")
                ->table('prod_grade')
                ->selectRaw('LTRIM(RTRIM(grade_id)) as grade_id')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function listAppl(){

        $result =DB::connection("sqlsrv2")
                ->table('appl_name')
                ->selectRaw('LTRIM(RTRIM(appl_name)) as appl_name')
                ->where('mill_id', '=', 'SR')
                ->get();

        return response()->json($result);
    }

    public function allThickness(){

        $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function commodityThickness($id){

        if ($id == "All") {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                // ->where('commodity_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

            return response()->json($result);

        }

        else {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

            return response()->json($result);

        }

    }

    public function brandThickness($id){

        $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('brand_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function getThickness($a, $b){


        if ($a == "All") {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                // ->where('commodity_id', '=', $a)
                ->where('brand_id', '=', $b)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

            return response()->json($result);

        }

        else {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $a)
                ->where('brand_id', '=', $b)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

            return response()->json($result);

        }

        


    }

    public function allWidth(){

        $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);


    }

    public function commodityWidth($id){


        if ($id == 'All') {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                // ->where('commodity_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

            return response()->json($result);

        }

        else {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

            return response()->json($result);


        }


    }

    public function brandWidth($id){

        $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('brand_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);


    }

    public function getWidth($a, $b){

        if ($a == "All") {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                // ->where('commodity_id', '=', $a)
                ->where('brand_id', '=', $b)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

            return response()->json($result);

        }

        else {

            $result = DB::connection("sqlsrv2")
                ->table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $a)
                ->where('brand_id', '=', $b)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

            return response()->json($result);
        } 


    }

    public function allColour(){

        $result = DB::connection("sqlsrv2")
                ->table('prod_color')
                ->selectRaw('LTRIM(RTRIM(color_id)) as color_id, LTRIM(RTRIM(descr)) as descr')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function getColour($id){

        if ($id == 'ZN') {

            $result = DB::connection("sqlsrv2")
                    ->table('prod_color')
                    ->selectRaw('LTRIM(RTRIM(color_id)) as color_id, LTRIM(RTRIM(descr)) as descr')
                    ->whereIn('brand_id', ['ZN', 'JWZN'])
                    ->where('active_flag', '=', 'Y')
                    ->get();

            return response()->json($result);
        }

        else {

            $result = DB::connection("sqlsrv2")
                    ->table('prod_color')
                    ->selectRaw('LTRIM(RTRIM(color_id)) as color_id, LTRIM(RTRIM(descr)) as descr')
                    ->whereIn('brand_id', ['JW', 'JWZN'])
                    ->where('active_flag', '=', 'Y')
                    ->get();

            return response()->json($result);
        }


    }

    public function allQuality(){

        $result = DB::connection("sqlsrv2")
                ->table('prod_quality')
                ->selectRaw('LTRIM(RTRIM(quality_id)) as quality_id')
                ->orderBy('quality_id', 'ASC')
                ->get();

        return response()->json($result);


    }

    public function getQuality(Request $request){

        $where = 'where 1=1';
        $commodity = $request->commodity;
        if ($commodity && $commodity != "All") {
            $where .= " and commodity_id = '$commodity'";
        }
        $brand = $request->brand;
        if ($brand) {
            $where .= " and brand_id = '$brand'";
        }
        $coat = $request->coat;
        if ($coat) {
            $where .= " and coat_mass = '$coat'";
        }
        $grade = $request->grade;
        if ($grade) {
            $where .= "  and grade_id = '$grade'";
        }
        $thick = $request->thick;
        if ($thick) {
            $where .= " and thick = '$thick'";
        }
        $width = $request->width;
        if ($width) {
            $where .= " and width = '$width'";
        }
        $color = $request->colour;
        if ($color) {
            $where .= " and color_id = '$color'";
        }


        $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(quality_id)) as quality_id from prod_spec $where group by quality_id order by quality_id asc"));

        return response()->json($result);



    }

    public function getProduct(Request $request){

        $descr = $request->descr;
        $where = "";
        $where.= "where a.quality_id = 'A' and a.pattern_id = '' and a.descr like '%$descr%' and b.category_id = '01'";

        if (isset($request->commodity)) {

            $where.= " and a.commodity_id = '$request->commodity'";

        }

        if (isset($request->brand)) {

            $where.= " and a.brand_id = '$request->brand'";

        }

        if (isset($request->coat)) {

            $where.= " and a.coat_mass = '$request->coat'";

        }

        if (isset($request->thick)) {

            $where.= " and a.thick = '$request->thick'";

        }

        if (isset($request->width)) {

            $where.= " and a.width = '$request->width'";

        }

        if (isset($request->grade)) {

            $where.= " and a.grade_id = '$request->grade'";

        }

        if (isset($request->colour)) {

            $where.= " and a.color_id = '$request->colour'";

        }

        $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select a.prod_code, a.descr, a.commodity_id, LTRIM(RTRIM(b.descr)) as commodity_descr,
                    a.brand_id, LTRIM(RTRIM(c.descr)) as brand_descr, a.coat_mass, LTRIM(RTRIM(d.brand_name)) as brand_coat,
                    a.thick, a.width, a.grade_id,
                    a.color_id, LTRIM(RTRIM(e.descr)) as color_descr from prod_spec a
                    JOIN commodity b on a.commodity_id = b.commodity_id
                    JOIN prod_brand c on a.brand_id = c.brand_id
                    JOIN brand_coat d on a.coat_mass = d.coat_mass
                    JOIN prod_color e on a.color_id = e.color_id"." ".$where));

        return response()->json($data);

                // return \DataTables::of($data)
                // ->addIndexColumn()
                // ->addColumn('Action', function($data) {
                //     return '<button id="saveOrderItem" class="btn-floating
                //     waves-effect" data-id="'.LTRIM(RTRIM($data->prod_code)).'">
                //     <i class="material-icons left">add</i></button>';
                //  })
                // ->rawColumns(['Action'])
                // ->make(true);
                // dd($data);
                // echo $where;

    }

    public function listCoilOrigin(){

        $result = DB::connection("sqlsrv2")
                    ->table('prod_origin')
                    ->selectRaw('LTRIM(RTRIM(origin_id)) as origin_id, LTRIM(RTRIM(descr)) as descr')
                    ->where('active_flag', '=', 'Y')
                    ->get();

        return response()->json($result);
    }

    public function listCrcCommodity(){

        $result = DB::connection("sqlsrv2")
                    ->table('commodity')
                    ->selectRaw('LTRIM(RTRIM(commodity_id)) as commodity_id, LTRIM(RTRIM(descr)) as descr')
                    ->where('category_id', '=', '02')
                    ->where('active_flag', '=', 'Y')
                    ->get();

        return response()->json($result);
    }

    public function listCrcThickness(){

        $result = DB::connection("sqlsrv2")
                ->table('view_stock_crc')
                ->selectRaw('distinct(thick)')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function listCrcWidth(){

        $result = DB::connection("sqlsrv2")
                ->table('view_stock_crc')
                ->selectRaw('distinct(width)')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);


    }

    public function listPIC($id){

        if ($id == "SR") {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(a.pic_id)) as pic_id, LTRIM(RTRIM(b.dept_id)) as dept_id, LTRIM(RTRIM(b.descr)) as descr, 
                    LTRIM(RTRIM(a.pic_name)) as pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id"));

            return response()->json($result);

        }

        else 
        {

            $result = DB::connection("sqlsrv3")
                    ->select(DB::raw("select LTRIM(RTRIM(a.pic_id)) as pic_id, LTRIM(RTRIM(b.dept_id)) as dept_id, LTRIM(RTRIM(b.descr)) as descr, 
                    LTRIM(RTRIM(a.pic_name)) as pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id"));

            return response()->json($result);


        }


    }

    public function listDept($id){

        if ($id == "SR") {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(dept_id)) as dept_id, LTRIM(RTRIM(descr)) as descr from depart"));

            return response()->json($result);

        }

        else 
        {

            $result = DB::connection("sqlsrv3")
                    ->select(DB::raw("select LTRIM(RTRIM(dept_id)) as dept_id, LTRIM(RTRIM(descr)) as descr from depart"));

            return response()->json($result);


        }


    }

    public function listPICDept($id, $pic){

        if ($id == "SR") {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(a.dept_id)) as dept_id, LTRIM(RTRIM(a.descr)) as descr
                    from depart a
                    inner join pic_dept b on a.dept_id = b.dept_id
                    where b.pic_id = '$pic'"));

            return response()->json($result);

        }

        else 
        {

            $result = DB::connection("sqlsrv3")
                    ->select(DB::raw("select LTRIM(RTRIM(a.dept_id)) as dept_id, LTRIM(RTRIM(a.descr)) as descr
                    from depart a
                    inner join pic_dept b on a.dept_id = b.dept_id
                    where b.pic_id = '$pic'"));

            return response()->json($result);


        }


    }

    public function listDeptPIC($id, $pic){

        if ($id == "SR") {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(a.pic_id)) as pic_id, LTRIM(RTRIM(a.pic_name)) as pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id
                    where b.dept_id = '$pic'"));

            return response()->json($result);

        }

        else 
        {

            $result = DB::connection("sqlsrv2")
                    ->select(DB::raw("select LTRIM(RTRIM(a.pic_id)) as pic_id, LTRIM(RTRIM(a.pic_name)) as pic_name
                    from pic_dept a
                    inner join depart b on a.dept_id = b.dept_id
                    where b.dept_id = '$pic'"));

            return response()->json($result);


        }


    }
}
