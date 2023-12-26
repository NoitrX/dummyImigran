<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class NonApproveRepository {

    public function indexApi(Request $request, $page, $perPage, $keyword)
    {
          try {
            $query = User::with(['createdByUser', 'updatedByUser'])->where('users.status_akun', '=', 'non_approved')
            ->select('users.name', 'users.tempat_lahir','users.tanggal_lahir', 'users.no_telp', 'users.status_akun', 'users.created_by', 'users.updated_by',
            'users.created_at','users.updated_at', 'users.id', 'users.doc_ktp', 'users.doc_surat_izin', 'users.foto', 'users.no_kk', 'users.no_nik', 'users.no_surat_izin',
             'users.doc_kk', 'users.doc_akta', 'users.nama_bapak'
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

    public function deleteApi($id)
    {
       $user = User::find($id);
       if($user) {
        $foto = $user->foto;
        $doc_ktp = $user->doc_ktp;
        $doc_surat_izin = $user->doc_surat_izin;

        if(!empty($foto)) {
            File::delete('uploads/'.$foto);
        }

        if(!empty($doc_ktp)) {
            File::delete('uploads/'.$doc_ktp);
        }

        if(!empty($doc_surat_izin)) {
            File::delete('uploads/'.$doc_surat_izin);
        }
        $user->delete();
       }
    }

    public function deleteAll(Request $request){
        $ids = $request->ids;
        $users = User::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            $foto = $user->foto;
            $doc_ktp = $user->doc_ktp;
            $doc_surat_izin = $user->doc_surat_izin;
            if(!empty($foto)) {
                File::delete('uploads/'.$foto);
            }

            if(!empty($doc_ktp)) {
                File::delete('uploads/'.$doc_ktp);
            }
    
            if(!empty($doc_surat_izin)) {
                File::delete('uploads/'.$doc_surat_izin);
            }

            $user->delete();
        }
    }

    public function setComplete(Request $request, $id)
    {
        $users = User::find($id);
        $users->update(['status_akun' => 'approved']);

        return $users;
    }
}