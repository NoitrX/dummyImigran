<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        try {
            $medicalUsers = User::where('status', '=', 'medical')->count();
            $blkln = User::where('status', '=', 'blkln')->count();
            $rekompassport  = User::where('status', '=', 'rekompassport')->count();
            $sudahTerbang = User::where('status_penerbangan', '=', 'terbang')->count();
            $belumTerbang = User::where('status_penerbangan', '=', 'belum_terbang')->count();
            $pmiFit = User::where('status_medical', '=', 'fit')->count();
            $nonFit = User::where('status_medical', '=', 'non_fit')->count();
            $nonApproved = User::where('status_akun', '=', 'non_approved')->count();
            return view('dashboard.index', compact('medicalUsers', 'blkln', 'rekompassport', 'sudahTerbang', 'belumTerbang', 'pmiFit', 'nonFit', 'nonApproved'));
        }catch(Exception $e)
        {
            throw new Exception($e);
        }
       
    }

    public function indexGet(Request $request, $type, $status)
    {
        try {
            $users =  DB::table('users')->where($status, '=', $type)->get();
            return view('dashboard.userFilter', compact('type', 'status'));
        }catch(Exception $e)
        {
            throw new Exception($e);
        }
     
    }
}
