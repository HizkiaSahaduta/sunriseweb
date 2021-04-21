<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;

class ChangeDefaultPasswordController extends Controller
{
    public function index()
    {
        return view('layouts.ChangeDefaultPassword');
    }

    public function ChangePass(Request $request)
    {

        $newPass = $request->password;

        if($newPass != 'kencana123')
        {
            DB::connection("sqlsrv")
                ->table('users')
                ->where('username', '=', Auth::User()->username)
                ->update(['password' => Hash::make($newPass), 'plain_password' => $newPass]);

            return redirect(url('home'));
        }
        else
        {
            return redirect(url('ChangeDefaultPassword'))->with('alert','Cannot use default password as new password.');
        }
                    
    }

}
