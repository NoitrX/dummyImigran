<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\UserSelesaiRepository;

class UserSelesaiController extends Controller
{
    private $userSelesaiRepository;

    public function __construct(UserSelesaiRepository $userSelesaiRepository)
    {
        $this->userSelesaiRepository = $userSelesaiRepository;
    }
    public function index()
    {
        return view('pmiSelesai.index');
    }

    public function indexApi(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $perPage = 7;
            $keyword = $request->input('keyword');
            $jabatanFilter = $request->input('jabatan_filter');
            $statusFilter = $request->input('status_filter');
            $users = $this->userSelesaiRepository->indexApi($request, $page, $perPage, $keyword, $jabatanFilter, $statusFilter);
            $responseData = [
             'data' => $users['data'],
             'total_records' => $users['pagination']['total_records'],
             'total_pages' => $users['pagination']['total_pages'],
             'current_page' => $users['pagination']['current_page']
         ];
            return response()->json($responseData,200);
         }catch(Exception $e)
         {
            return response()->json([
                'status' => 'error',
                'message' => $e
            ]);
         }

    }
}
