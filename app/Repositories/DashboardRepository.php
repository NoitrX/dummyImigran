<?php

namespace App\Repositories;

use Exception;
use App\Models\User;

class dashboardRepository {
    public function indexApi($request, $page, $perPage, $keyword, $jabatanFilter, $statusFilter, $status, $type)
    {
        try {
            $query = User::with(['createdByUser', 'updatedByUser'])->where($status, '=', $type)
            ->select('users.name', 'users.tempat_lahir','users.tanggal_lahir', 'users.negara', 'users.jabatan', 'users.status', 'users.created_by', 'users.updated_by',
            'users.created_at','users.updated_at', 'users.id', 'users.pasport', 'users.pk', 'users.visa', 'users.nama_bapak', 'users.status_medical', 'users.status_penerbangan');
            
             if ($keyword) {
                $query->where(function($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('tanggal_lahir', 'like', '%' . $keyword . '%')
                    ->orWhere('status', 'like', '%' . $keyword . '%')
                    ->orWhere('negara', 'like', '%' . $keyword . '%')
                    ->orWhere('jabatan', 'like', '%' . $keyword . '%')
                    ->orWhere('tempat_lahir', 'like', '%' . $keyword . '%')
                    ->orWhere('status_medical', 'like', '%' . $keyword . '%')
                    ->orWhere('nama_bapak', 'like', '%' . $keyword . '%')
                    ->orWhere('status_penerbangan', 'like', '%' . $keyword . '%');
                });
            }

             if($jabatanFilter != 'hidden') {
                $query->where('jabatan', $jabatanFilter);
             }

             if($statusFilter != 'hidden') {
                $query->where('status', $statusFilter);
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

    public function index()
    {
        $medicalUsers = User::where('status', '=', 'medical')->count();
        $blkln = User::where('status', '=', 'blkln')->count();
        $rekompassport  = User::where('status', '=', 'rekompassport')->count();
        $sudahTerbang = User::where('status_penerbangan', '=', 'terbang')->count();
        $belumTerbang = User::where('status_penerbangan', '=', 'belum_terbang')->where('status_akhir', '=', 'selesai')->count();
        $pmiFit = User::where('status_medical', '=', 'fit')->count();
        $nonFit = User::where('status_medical', '=', 'non_fit')->count();
        $nonApproved = User::where('status_akun', '=', 'non_approved')->where('status_wawancara', '=', 'SUDAH WAWANCARA')->count();

        return [
            'medicalUsers' => $medicalUsers,
            'blkln' => $blkln,
            'rekompassport' => $rekompassport,
            'sudahTerbang' => $sudahTerbang,
            'belumTerbang' => $belumTerbang,
            'pmiFit' => $pmiFit,
            'nonFit' => $nonFit,
            'nonApproved' => $nonApproved,
        ];
    }
}
