<?php

namespace App\Repositories;

use Exception;
use Illuminate\Http\Request;
use App\Models\SaranaKesehatan;

class SaranaKesehatanRepository {

    public function indexApi(Request $request,  $page, $perPage, $keyword)
    {
          try {
            $query = SaranaKesehatan::with(['createdByUser', 'updatedByUser'])
            ->select('sarana_kesehatan.nama_sarana', 'sarana_kesehatan.id', 'sarana_kesehatan.created_by', 'sarana_kesehatan.updated_by',
             'sarana_kesehatan.created_at', 'sarana_kesehatan.updated_at');
            
             if ($keyword) {
                $query->where(function($query) use ($keyword) {
                    $query->where('nama_sarana', 'like', '%' . $keyword . '%');
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
        try {
            $input = [
                'nama_sarana' => $request->nama_sarana
            ];

            $saranaKesehatan = SaranaKesehatan::create($input);
            return $saranaKesehatan;
        }catch(Exception $e)
        {
            return response()->json([
                'error' => $e
            ]);
        }
    }

    public function deleteApi($id)
    {
       $saranaKesehatan = SaranaKesehatan::find($id);
       if($saranaKesehatan) {
        $saranaKesehatan->delete();
       }
    }

    public function deleteAll(Request $request){
        $ids = $request->ids;
        $saranaKesehatan = SaranaKesehatan::whereIn('id', $ids)->delete();
    }

    public function editApi($id)
    {
        $editId = SaranaKesehatan::find($id);
        return $editId;
    }

    public function updateApi(Request $request, $id)
    {
        $saranaKes = SaranaKesehatan::where('id', $id)->first();
        $input = [
            'nama_sarana' => $request->nama_sarana,
        ];

        $saranaKes->update($input);
        return $saranaKes;
    }
}
?>
