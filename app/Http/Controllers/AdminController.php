<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

   public function index() 
   {
    return view('Admin.index');
   }

   public function indexApi(Request $request)
   {
      try {
         $page = $request->input('page', 1);
         $perPage = 7;
         $keyword = $request->input('keyword');
         $saranaKesehatan = $this->adminRepository->indexApi($request, $page, $perPage, $keyword);
         $responseData = [
          'data' => $saranaKesehatan['data'],
          'total_records' => $saranaKesehatan['pagination']['total_records'],
          'total_pages' => $saranaKesehatan['pagination']['total_pages'],
          'current_page' => $saranaKesehatan['pagination']['current_page']
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


   public function storeApi(Request $request)
   {
      $storeApi = $this->adminRepository->storeApi($request);
   }

   public function editApi($id)
   {
       $editApi = $this->adminRepository->editApi($id);
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
           $updateApi = $this->adminRepository->updateApi($request, $id);
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

   public function deleteApi($id)
   {
      try {
         $deleteUser = $this->adminRepository->deleteApi($id);
         return redirect('admin')->with('success', 'Data Berhasil Dihapus!!');
      }catch(Exception $e) {
         return $e;
      }
     
   }

   public function deleteAll(Request $request)
   {
      try {
         $deleteSarana = $this->adminRepository->deleteAll($request);
         return response()->json(["success" => "Data Has Been Deleted"]);
      }catch(Exception $e){
         return $e;
      }
   }
}
