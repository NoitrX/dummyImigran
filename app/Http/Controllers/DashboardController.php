<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\DashboardRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $dashboardRepository;

   public function __construct(DashboardRepository $dashboardRepository)
   {
       $this->dashboardRepository = $dashboardRepository;
   }

   public function viewFilter(Request $request, $type, $status)
   {
       return view('dashboard.userFilter', compact('type', 'status'));
   }
   
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
            $page = $request->input('page', 1);
            $perPage = 7;
            $keyword = $request->input('keyword');
            $jabatanFilter = $request->input('jabatan_filter');
            $statusFilter = $request->input('status_filter');
            $users = $this->dashboardRepository->indexApi($request, $page, $perPage, $keyword, $jabatanFilter, $statusFilter, $status, $type);
            $responseData = [
             'data' => $users['data'],
             'total_records' => $users['pagination']['total_records'],
             'total_pages' => $users['pagination']['total_pages'],
             'current_page' => $users['pagination']['current_page']
         ];
         if ($request->expectsJson()) {
            return response()->json($responseData, 200);
        } 
         }catch(Exception $e)
         {
            return response()->json([
                'status' => 'error',
                'message' => $e
            ]);
         }
     
    }
}
