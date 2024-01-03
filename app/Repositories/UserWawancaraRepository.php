<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class UserWawancaraRepository
{
    public function indexApi(Request $request, $page, $perPage, $keyword)
    {
          try {
            $query = User::with(['createdByUser', 'updatedByUser', 'regency'])->where('users.status_wawancara', '=', 'BELUM WAWANCARA')
            ->select('users.name', 'users.tempat_lahir','users.tanggal_lahir', 'users.no_telp', 'users.status_akun', 'users.created_by', 'users.updated_by',
            'users.created_at','users.updated_at', 'users.id', 'users.doc_ktp', 'users.doc_surat_izin', 'users.foto', 'users.no_kk', 'users.no_nik', 'users.no_surat_izin',
             'users.doc_kk', 'users.doc_akta', 'users.nama_bapak', 'users.status_medical', 'users.domisili_id'
        );
            if ($keyword) {
                $query->where(function($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('tanggal_lahir', 'like', '%' . $keyword . '%')
                        ->orWhere('tempat_lahir', 'like', '%' . $keyword . '%')
                        ->orWhere('no_kk', 'like', '%' . $keyword . '%')
                        ->orWhere('no_nik', 'like', '%' . $keyword . '%')
                        ->orWhere('no_surat_izin', 'like', '%' . $keyword . '%')
                        ->orWhere('no_telp', 'like', '%' . $keyword . '%')
                        ->orWhere('status', 'like', '%' . $keyword . '%');
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

    public function editApi($id)
    {
        $editId = User::find($id);
        return $editId;
    }

    public function updateApi(Request $request, $id)
    {
        $usersWawancara = User::where('id', $id)->first();
        $input = [
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'negara' => $request->negara,
            'jabatan' => $request->jabatan,
            'pendidikan' => $request->pendidikan,
        ];

        $usersWawancara->update($input);
        return $usersWawancara;
    }
}