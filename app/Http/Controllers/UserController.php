<?php

namespace App\Http\Controllers;

use TCPDF;
use Exception;
use App\Models\User;
use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\SaranaKesehatan;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Clegginabox\PDFMerger\PDFMerger;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   private $userRepository;

   public function __construct(UserRepository $userRepository)
   {
       $this->userRepository = $userRepository;
   }
   public function index()
   {
    $province = Province::all();
    $regency = Regency::all();
    return view('Pmi.index', compact('province', 'regency'));
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
        $users = $this->userRepository->indexApi($request, $page, $perPage, $keyword, $jabatanFilter, $statusFilter, $provinsiFilter);
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

   public function storeApi(Request $request, $id)
   {

      $validator = Validator::make($request->all(), [
         'ijazah' => 'mimes:pdf|max:3072',
         'surat_nikah' => 'mimes:pdf|max:3072',
         'medical' => 'mimes:pdf|max:3072',
         'bnsp' => 'mimes:pdf|max:3072',
         'bpjs' =>'mimes:pdf|max:3072',
         'pp' => 'mimes:pdf|max:3072',
         'pasport' => 'mimes:pdf|max:3072',
         'pk'  => 'mimes:pdf|max:3072',
         'visa' => 'mimes:pdf|max:3072',
         'ektkln'=> 'mimes:pdf|max:3072',
         'tiket'=> 'mimes:pdf|max:3072',
         'status' => 'required'
      ]);

      if($validator->fails()) {
         return response()->json([
            'errors' =>  $validator->errors()->all(),
            'status' => 422,
         ], 422);
      }
      try {
         $storeApi = $this->userRepository->storeApi($request, $id);
      }catch(Exception $e)
      {
         return response()->json([
            'status'=> 'error',
            'message' => $e,
         ],500);
      }
   }

   public function getId($id)
   {
      try {
         $users = $this->userRepository->getId($id);
         $saranaKesehatan = DB::table('sarana_kesehatan')->select('sarana_kesehatan.id', 'sarana_kesehatan.nama_sarana')->get();
         return view('Pmi.storeEdit', compact('users', 'saranaKesehatan'));
      }catch(Exception $e)
      {
         return response()->json([
            'status' => 'error',
            'message' => $e
         ]);
      }
   }

   public function detail($id)
   {
      try {
         $users = $this->userRepository->getId($id);
         return response()->json([
            'data' => $users
         ],200);
      }catch(Exception $e)
      {
         return response()->json([
            'status' => 'error',
            'message' => $e
         ]);
      }
   }

   public function detailId($id)
   {

      $userId = $this->userRepository->getId($id);

      return view('Pmi.detailPmi', compact('userId'));
   }

   public function deleteApi($id)
   {
      try {
         $deleteUser = $this->userRepository->deleteApi($id);
         return back()->with('success', 'Data Berhasil Dihapus!!');
      }catch(Exception $e) {
         return $e;
      }
     
   }

   public function downloadBpjs($id, $document)
   {
       try {
           $user = User::find($id);
   
           if (!$user) {
               abort(404, 'User Not Found');
           }
   
           $filename = $user->name . '-' . $document . '.pdf';
           $filePath = public_path("uploads/{$user->{$document}}");
   
           if (file_exists($filePath)) {
               return response()->download($filePath, $filename);
           } else {
               abort(404, 'File not found');
           }
       } catch (Exception $e) {
           throw new Exception($e);
       }
   }

   // MERGE PDF
   public function downloadMergedPDF($id)
{
    try {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'User Not Found');
        }

        $pdfMerger = new PDFMerger();

  
        $filesToMerge = ['bpjs', 'pp', 'pasport', 'tiket', 'pk', 'visa', 'ektkln', 'ijazah', 'doc_ktp', 'doc_surat_izin', 'surat_nikah', 'medical', 'bnsp', 'doc_akta', 'doc_kk', 'buku_nikah'];

        foreach ($filesToMerge as $document) {
            $documentPath = public_path("uploads/{$user->{$document}}");

        
            if ($user->{$document} && file_exists($documentPath)) {
                $pdfMerger->addPDF($documentPath, 'all');
            }
        }

        $mergedPdfPath = public_path("uploads/merged/{$user->name}_merged.pdf");

        $pdfMerger->merge('file', $mergedPdfPath);

        return response()->download($mergedPdfPath, "{$user->name}_merged.pdf");

    } catch (Exception $e) {
        throw new Exception($e);
    }
}

public function deleteAll(Request $request)
{
    try {
        $deleteUser = $this->userRepository->deleteAll($request);
        return response()->json(["success" => "Data Has Been Deleted"]);
    }catch(Exception $e){
        return $e;
    }
}
   

public function addData(Request $request)
{
    try {
        $storeData = $this->userRepository->addData($request);
    }catch(Exception $e){
        throw new Exception($e);
    }

}

public function setComplete(Request $request, $id)
    {
        $user = User::find($id);

    
        if ($this->isUserDataComplete($user)) {
            $user->update(['status_akhir' => 'selesai']);
            return redirect('/users-selesai')->with('success', 'Data Sudah Selesai Silahkan Lihat ke Menu PMI Selesai!.');
        } else {
            return redirect()->back()->with('error', 'Harap lengkapi semua data pengguna terlebih dahulu.');
        }
    }
    private function isUserDataComplete(User $user)
    {

        return !empty($user->name) && !empty($user->nama_bapak) && !empty($user->email) && !empty($user->password) && !empty($user->tanggal_lahir)
        && !empty($user->tempat_lahir) && !empty($user->alamat) && !empty($user->usia) && !empty($user->agama) && !empty($user->no_telp) && !empty($user->no_kk)
        && !empty($user->no_nik) && !empty($user->no_surat_izin) && !empty($user->doc_ktp) && !empty($user->doc_kk) && !empty($user->doc_akta) && !empty($user->doc_surat_izin)
        && !empty($user->status_menikah) && !empty($user->status_akun) && !empty($user->tinggi_badan) && !empty($user->berat_badan) && !empty($user->pendidikan) && !empty($user->foto)
        && !empty($user->ijazah) && !empty($user->surat_nikah) && !empty($user->medical) && !empty($user->data_medical_id) && !empty($user->bnsp) && !empty($user->bpjs)
        && !empty($user->pp) && !empty($user->pasport) && !empty($user->pk) && !empty($user->visa) && !empty($user->ektkln) && !empty($user->negara) && !empty($user->jabatan)
        && !empty($user->status) && !empty($user->status_akhir) 
        ;
    }
}
