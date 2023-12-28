<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DirekturController extends Controller
{

    private $dashboardRepository;
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    public function index()
    {    try {
        $users = $this->dashboardRepository->index();
        return view('direktur.index', $users);
    }catch(Exception $e)
    {
        throw new Exception($e);
    }
     
    }

    public function viewFilter(Request $request, $type, $status)
    {
        return view('direktur.userFilter', compact('type', 'status'));
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
