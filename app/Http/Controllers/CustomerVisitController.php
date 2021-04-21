<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Session;
use DB;
use Carbon\Carbon;

class CustomerVisitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.CustomerVisit');

    }

    public function autocompletecustomer(Request $request)
    {
        $search = $request->get('term');

        $result = DB::connection("sqlsrv2")
            ->table('customer')
            ->where('cust_name', 'LIKE', '%'. $search. '%')
            ->orWhere('cust_id', '=',  $search )
            ->take(50)
            ->get();

        return response()->json($result);
    }

    public function getCustDetails($id)
    {

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
                    ->where('cust_id', '=', $id)
                    ->get()
                    ->first();

        return json_encode($result);
    }

    function getUsrEnVar($val)
    {
        $EnValue = DB::connection("sqlsrv2")
                    ->table('sec_env_conf')
                    ->select('var_value')
                    ->where('appl_id','=', 'SUNRISEWEB')
                    ->where('var_id', '=', $val)
                    ->where('user_id2', '=', Session::get('USERNAME'))
                    ->first();


        if($EnValue == null)
        {
            return "";
        }
        else
        {
            return $EnValue->var_value;
        }
    }

    public function storeActivity(Request $request)
    {
        $txtusr = Session::get('USERNAME');
        $customername = $request->input('customername');
        $customeraddress = $request->input('customeraddress');
        $customercity = $request->input('customercity');
        $latitude = $request->input('Latitude');
        $longitude = $request->input('Longitude');
        $address = $request->input('Address');
        $remark = $request->input('remark');

        $salesid = DB::connection("sqlsrv2")
                    ->table('sec_env_conf')
                    ->select('var_value')
                    ->where('appl_id','=', 'SUNRISEWEB')
                    ->where('var_id', '=', 'SALESID')
                    ->where('user_id2', '=', $txtusr)
                    ->Value('var_value');

        $dtime = Carbon::now('Asia/Jakarta')->format('dmYGi');
        $trid = self::getUsrEnVar('SALESID') . $dtime . $request->customerid;
        $txtsalesid = $salesid;
        $txtCustId = $request->input('customerid');

        if(empty($request->salesid))
        {
            $trid;
        }

        if(empty($request->input('customerid'))){
            $trid = self::getUsrEnVar('SALESID') . $dtime . "NEW";
            $txtCustId = 'NEW';
        }

        if(empty($request->input('salesid'))){
            $txtsalesid = $salesid;
        }

        // if (empty($customername) || empty($customeraddress) || empty($customercity) || empty($latitude) || empty($longitude) || empty($address)){

        //     echo $customername." ".$customeraddress." ".$customercity." ".$latitude." ".$longitude." ".$address." ".$address;
        //     //return redirect('CustomerVisit')->with("alert", "Pastikan field sudah terisi semua termasuk lokasi GPS sebelum mengirim data");
        // }

            $save = DB::connection("sqlsrv2")
                ->table('web_SalesActivity')
                ->insert([
                'mill_id' => 'SR',
                'tr_id' => $trid,
                'salesid' => $txtsalesid,
                'customerid' => $txtCustId,
                'namacustomer' => $customername,
                'alamat' => $customeraddress,
                'city' => $customercity,
                'sales_latitude' => $latitude,
                'sales_longitude' => $longitude,
                'lt_location' => $address,
                'remark' => $remark,
                'user_id' => $txtusr
                ]);

        // if ($save) {

        //     return redirect('TodayVisit');
        // }

        // else {

        //     return redirect('CustomerVisit')->with("alert", "Pastikan field sudah terisi semua termasuk lokasi GPS sebelum mengirim data");
        // }

    }

}
