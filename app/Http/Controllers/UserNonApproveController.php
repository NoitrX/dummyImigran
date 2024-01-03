<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\NonApproveRepository;

class UserNonApproveController extends Controller
{

    private $nonApproveRepository;

    public function __construct(NonApproveRepository $nonApproveRepository)
    {
        $this->nonApproveRepository = $nonApproveRepository;
    }
    public function index()
    {
        return view('pmiNonApprove.index');
    }

    public function indexApi(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $perPage = 7;
            $keyword = $request->input('keyword');
            $nonApprove = $this->nonApproveRepository->indexApi($request, $page, $perPage, $keyword);
            $responseData = [
             'data' => $nonApprove['data'],
             'total_records' => $nonApprove['pagination']['total_records'],
             'total_pages' => $nonApprove['pagination']['total_pages'],
             'current_page' => $nonApprove['pagination']['current_page']
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

    public function deleteApi($id)
   {
      try {
         $deleteUser = $this->nonApproveRepository->deleteApi($id);
         return redirect('users-nonapproved')->with('success', 'Data Berhasil Dihapus!!');
      }catch(Exception $e) {
         return $e;
      }
     
   }

   public function deleteAll(Request $request)
{
    try {
        $deleteUser = $this->nonApproveRepository->deleteAll($request);
        return response()->json(["success" => "Data Has Been Deleted"]);
    }catch(Exception $e){
        return $e;
    }
}

    public function setComplete(Request $request, $id)
    {
        try {
            $dataId = $this->nonApproveRepository->setComplete($request, $id);
            return redirect('/users-nonapproved')->with('success', 'Data Berhasil Di Approve!.');
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 500 
            ], 500);
        }
    }

    public function detailId($id)
    {
 
       $userId = $this->nonApproveRepository->getId($id);
 
       return view('direktur.detailPmi', compact('userId'));
    }
}
