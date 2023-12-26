<?php

namespace App\Repositories;

use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRepository {
    
    public function indexApi(Request $request,  $page, $perPage, $keyword)
    {
          try {
            $query = DB::table('admin')->select('admin.id', 'admin.email', 'admin.created_at', 'admin.updated_at');
            
             if ($keyword) {
                $query->where(function($query) use ($keyword) {
                    $query->where('email', 'like', '%' . $keyword . '%');
                });
            }

          
            $totalRecords = $query->count();
            $totalPages = ceil($totalRecords / $perPage);
            $results = $query->skip(($page - 1) * $perPage)->take($perPage)->get();

            return [
                'data' => $results,
                'pagination' => [
                    'total_records' => $totalRecords,
                    'total_pages' => $totalPages,
                    'current_page' => $page
                ],
            ];
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

   public function storeApi(Request $request)
   {
        $input = [
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $admin = Admin::create($input);
        return $admin;
   }
   public function editApi($id)
   {
       $editId = Admin::find($id);
       return $editId;
   }

   public function updateApi(Request $request, $id)
    {
        $saranaKes = Admin::where('id', $id)->first();
        $input = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $saranaKes->update($input);
        return $saranaKes;
    }
    public function deleteApi($id)
    {
       $admin = Admin::find($id);
       if($admin) {
        $admin->delete();
       }
    }

    public function deleteAll(Request $request){
        $ids = $request->ids;
        $saranaKesehatan = Admin::whereIn('id', $ids)->delete();
    }
}