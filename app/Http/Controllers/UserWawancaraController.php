<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\UserWawancaraRepository;
use Illuminate\Support\Facades\Validator;
class UserWawancaraController extends Controller
{
    private $userWawancaraRepository;

   public function __construct(UserWawancaraRepository $userWawancaraRepository)
   {
       $this->userWawancaraRepository = $userWawancaraRepository;
   }
    public function index()
    {
        return view('UserWawancara.index');
    }

    public function indexApi(Request $request)
    {
      try {
         $page = $request->input('page', 1);
         $perPage = 7;
         $keyword = $request->input('keyword');
         $jabatanFilter = $request->input('jabatan_filter');
         $statusFilter = $request->input('status_filter');
         $provinsiFilter = $request->input('provinsi_filter');
         $users = $this->userWawancaraRepository->indexApi($request, $page, $perPage, $keyword, $jabatanFilter, $statusFilter, $provinsiFilter);
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

    public function editApi($id)
    {
        $editApi = $this->userWawancaraRepository->editApi($id);
        return response()->json([
            'data' => $editApi,
            'code' => 200,
        ]);
    }

    public function updateApi(Request $request, $id)
    {   
        $validatedData = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if($validatedData->fails()) {
            return response()->json([
                'errors' => $validatedData->errors()->all(),
                'status' => 422,
            ],422);
        }
        try {
            $updateApi = $this->userWawancaraRepository->updateApi($request, $id);
            return response()->json([
             'data'=> $updateApi,
             'code' => 201,
             'message' => 'success',
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 500 
            ], 500);
        }
    }
}
