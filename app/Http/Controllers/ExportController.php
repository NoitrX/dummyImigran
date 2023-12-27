<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ExportController extends Controller
{
    public function exportNew($status)
    {
        $datas = DB::table('users')->where('status_akhir', $status)->where('status_akun', 'approved')
            ->select('name', 'nama_bapak', 'email', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'usia', 'agama', 'no_telp',
                'no_kk', 'no_nik', 'no_surat_izin', 'status_menikah', 'tinggi_badan', 'berat_badan', 'pendidikan', 'negara', 'jabatan',
                'status', 'status_akhir', 'status_penerbangan', 'status_medical'
            )->get();
    
        $data_array = [
            [
                'NAMA PMI',
                'NAMA BAPAK',
                'EMAIL',
                'TANGGAL LAHIR',
                'TEMPAT LAHIR',
                'ALAMAT',
                'USIA',
                'AGAMA',
                'NO TELP',
                'NO KK',
                'NO NIK',
                'NO SURAT IZIN',
                'STATUS MENIKAH',
                'TINGGI BADAN',
                'BERAT BADAN',
                'PENDIDIKAN',
                'NEGARA',
                'JABATAN',
                'STATUS',
                'STATUS AKHIR',
                'STATUS PENERBANGAN',
                'STATUS MEDICAL'
            ],
        ];
    
        foreach ($datas as $data) {
            $data_array[] = [
                $data->name,
                $data->nama_bapak,
                $data->email,
                $data->tanggal_lahir,
                $data->tempat_lahir,
                $data->alamat,
                $data->usia,
                $data->agama,
                $data->no_telp,
                $data->no_kk,
                $data->no_nik,
                $data->no_surat_izin,
                $data->status_menikah,
                $data->tinggi_badan,
                $data->berat_badan,
                $data->pendidikan,
                $data->negara,
                $data->jabatan,
                "'" . $data->status . "'",
                $data->status_akhir,
                $data->status_penerbangan,
                "'" . $data->status_medical . "'"
            ];
        }
    
        $this->exportExcel($data_array);
    }
    
    public function exportExcel($data_array)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
    
        try {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
    
            $spreadsheet->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true);
    
            $spreadsheet->getActiveSheet()->fromArray($data_array, NULL, 'A1');
    
            $spreadsheet->getActiveSheet()->getStyle('A1:V' . (count($data_array) + 1))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ]);
    
            $spreadsheet->getActiveSheet()->getStyle('A1:V' . (count($data_array) + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $Excel_writer = new Xls($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="PMIDATA.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
    
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}
