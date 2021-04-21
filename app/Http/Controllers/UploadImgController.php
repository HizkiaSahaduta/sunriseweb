<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class UploadImgController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $salesid  = Session::get('SALESID');

        if ($groupid == 'SALES' || $groupid == 'KOORDINATOR' || $groupid == 'PRIV' || $groupid == 'DEVELOPMENT') {


            $checkCreatedBy = DB::connection('sqlsrv2')
                                ->table('order_book_hdr')
                                ->where('book_id','=', $id)
                                ->first();
            if ($userid != $checkCreatedBy->user_id) {
                return redirect('ListPreOrder')->with("alert", "You cant upload image to this order, this is not an order you made");
            }
            else {
                Session::put('book_id_temp', $id);
                return view('layouts.UploadImg');
            }


        }
        else {
            return redirect('ListPreOrder')->with("alert", "You are not allowed to view this page");
        }

    }

    public function upload(Request $request){

        $book_id = trim(Session::get('book_id_temp'));


        if($book_id){

            $image = $request->file('file');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('img/upload/'), $imageName);

            $checkExistImage = DB::connection('sqlsrv2')
                                ->table('image_path')
                                ->where('tr_id','=', $book_id)
                                ->where('user_id','=', Session::get('USERNAME'))
                                ->first();


            if($checkExistImage)
            {


                $seqNum = DB::connection("sqlsrv2")
                        ->table('image_path')
                        ->select('tr_seq')
                        ->where('user_id', '=', Session::get('USERNAME'))
                        ->where('tr_id', '=', $book_id)
                        ->max('tr_seq');

                DB::connection('sqlsrv2')
                    ->table('image_path')
                    ->insert([
                    'mill_id' => 'SR',
                    'tr_id' => $book_id,
                    'appl_id' => 'SUNRISEWEB',
                    'tr_seq' => $seqNum + 1,
                    'origin_name' => $imageName,
                    'img_path' => 'img/upload/'.$imageName,
                    'user_id' => Session::get('USERNAME')
                    ]);
            }
            else
            {
               DB::connection('sqlsrv2')
                    ->table('image_path')
                    ->insert([
                    'mill_id' => 'SR',
                    'tr_id' => $book_id,
                    'appl_id' => 'SUNRISEWEB',
                    'tr_seq' => 1,
                    'origin_name' => $imageName,
                    'img_path' => 'img/upload/'.$imageName,
                    'user_id' => Session::get('USERNAME')
                    ]);
            }

            $saveImageHdr = DB::connection('sqlsrv2')
                                ->table('order_book_hdr')
                                ->where('user_id','=', Session::get('USERNAME'))
                                ->where('book_id','=', $book_id)
                                ->update(['image' => 'Y']);


            return response()->json(['response' => "Sucess ".$image]);
        }
        else{

            return response()->json(['response' => "Error ".$image]);
        }

    }

    public function fetch(){

        $book_id = trim(Session::get('book_id_temp'));

        $checkExistImages = DB::connection('sqlsrv2')
                            ->table('image_path')
                            ->where('tr_id','=', $book_id)
                            ->where('user_id','=', Session::get('USERNAME'))
                            ->get();

        $output = '';

        foreach($checkExistImages as $checkExistImage){

            $output .= '
            <div class="col s12 m6 l4 xl2">
             <div class="card">
              <div class="card-image">
               <a href="'.asset('img/upload/' . $checkExistImage->origin_name).'" title="Image of '.$book_id.'-'.$checkExistImage->tr_seq.'">
               <img src="'.asset('img/upload/' . $checkExistImage->origin_name).'" alt="" width="120" height="120">
               </a>
              </div>
              <button class="waves-effect btn-flat remove_image" id="'.$checkExistImage->origin_name.'">
              <i class="material-icons left">clear</i>Remove
              </button>

             </div>
            </div>
            ';
        }

        echo $output;
    }

    public function delete(Request $request){


        $book_id = trim(Session::get('book_id_temp'));
        $img = $request->get('name');

        if($img){

            \File::delete(public_path('img/upload/' .$img));

            $delete = DB::connection('sqlsrv2')
                        ->table('image_path')
                        ->where('tr_id','=', $book_id)
                        ->where('user_id','=', Session::get('USERNAME'))
                        ->where('origin_name',$img)
                        ->delete();

            $checkExistImage = DB::connection('sqlsrv2')
                            ->table('image_path')
                            ->where('tr_id','=', $book_id)
                            ->where('user_id','=', Session::get('USERNAME'))
                            ->first();

            if(!$checkExistImage){

                $saveImageHdr = DB::connection('sqlsrv2')
                                    ->table('order_book_hdr')
                                    ->where('user_id','=', Session::get('USERNAME'))
                                    ->where('book_id','=', $book_id)
                                    ->update(['image' => 'N']);

                return response()->json(['response' => "Image deleted"]);
            }
            else{

                return response()->json(['response' => "Image deleted"]);
            }
        }
    }
}
