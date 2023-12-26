<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\SaranaKesehatan;
use Illuminate\Support\Facades\Validator;
use App\Repositories\SaranaKesehatanRepository;

class SaranaKesehatanController extends Controller
{
    private $saranaKesehatanRepository;

    public function __construct(SaranaKesehatanRepository $saranaKesehatanRepository)
    {
        $this->saranaKesehatanRepository = $saranaKesehatanRepository;
    }

    public function index()
    {
        return view('SaranaKesehatan.index');
    }

    public function indexApi(Request $request)
    {
       
    
        try {
            $page = $request->input('page', 1);
            $perPage = 7;
            $keyword = $request->input('keyword');
            $saranaKesehatan = $this->saranaKesehatanRepository->indexApi($request, $page, $perPage, $keyword);
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
        $validator = Validator::make($request->all(), [
            'nama_sarana' => 'required',
         ]);
   
         if($validator->fails()) {
            return response()->json([
               'errors' =>  $validator->errors()->all(),
               'status' => 422,
            ], 422);
         }
         try {
            $storeApi = $this->saranaKesehatanRepository->storeApi($request);
         }catch(Exception $e)
         {
            return response()->json([
               'status'=> 'error',
               'message' => $e,
            ],500);
         }
    }

    public function deleteApi($id)
    {
       try {
          $deleteUser = $this->saranaKesehatanRepository->deleteApi($id);
          return redirect('sarana-kesehatan')->with('success', 'Data Berhasil Dihapus!!');
       }catch(Exception $e) {
          return $e;
       }
      
    }

    public function deleteAll(Request $request)
      {
         try {
            $deleteSarana = $this->saranaKesehatanRepository->deleteAll($request);
            return response()->json(["success" => "Data Has Been Deleted"]);
         }catch(Exception $e){
            return $e;
         }
      }

      public function editApi($id)
      {
          $editApi = $this->saranaKesehatanRepository->editApi($id);
          return response()->json([
              'data' => $editApi,
              'code' => 200,
          ]);
      }

      public function updateApi(Request $request, $id)
      {   
          $validatedData = Validator::make($request->all(), [
              'nama_sarana' => 'required',
          ]);
          if($validatedData->fails()) {
              return response()->json([
                  'errors' => $validatedData->errors()->all(),
                  'status' => 422,
              ],422);
          }
          try {
              $updateApi = $this->saranaKesehatanRepository->updateApi($request, $id);
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
