<?php

namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class userRepository {

    public function indexApi(Request $request, $page, $perPage, $keyword, $jabatanFilter, $statusFilter, $provinsiFilter)
    {
        try {
            $query = User::with(['createdByUser', 'updatedByUser', 'regency']) 
            ->where('users.status_akun', '=', 'approved')
            ->where('users.status_akhir', '=', 'belum_selesai')
            ->select('users.name', 'users.tempat_lahir','users.tanggal_lahir', 'users.negara', 'users.no_telp', 'users.jabatan', 'users.status', 'users.created_by', 'users.updated_by',
                'users.created_at','users.updated_at', 'users.id', 'users.pasport', 'users.pk', 'users.visa', 'users.nama_bapak', 'users.status_medical', 'users.domisili_id')
            ->orderBy('name', 'asc');
            
             if ($keyword) {
                $query->where(function($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('tanggal_lahir', 'like', '%' . $keyword . '%')
                    ->orWhere('no_telp', 'like', '%' . $keyword . '%')
                    ->orWhere('status', 'like', '%' . $keyword . '%')
                    ->orWhere('negara', 'like', '%' . $keyword . '%')
                    ->orWhere('jabatan', 'like', '%' . $keyword . '%')
                    ->orWhere('tempat_lahir', 'like', '%' . $keyword . '%');
                });
            }

             if($jabatanFilter != 'hidden') {
                $query->where('jabatan', $jabatanFilter);
             }

             if($statusFilter != 'hidden') {
                $query->where('status', $statusFilter);
             }

             if($provinsiFilter != 'hidden') {
                $query->where('provinsi', $provinsiFilter);
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

    public function storeApi(Request $request, $id)
    {
        try {
            $users = User::where('id', $id)->first();
            if(!$users) {
                return response()->json(['error' => 'User not Found'], 404);
            }
            $input = [
               'tinggi_badan' => $request->tinggi_badan,
               'berat_badan' => $request->berat_badan,
               'negara' => $request->negara,
               'jabatan' => $request->jabatan,
               'pendidikan' => $request->pendidikan,
               'data_medical_id' => $request->data_medical_id,
               'doc_kk' => $request->doc_kk,
               'doc_akta' => $request->doc_akta,
               'ijazah' => $request->ijazah,
               'surat_nikah' => $request->surat_nikah,
               'medical' => $request->medical,
               'bnsp' => $request->bnsp,
               'bpjs' => $request->bpjs,
               'pp' => $request->pp,
               'pasport' => $request->pasport,
               'pk' => $request->pk,
               'visa' => $request->visa,
               'ektkln' => $request->ektkln,
               'status' => $request->status,
               'status_medical' => $request->status_medical,
               'tiket' => $request->tiket,
              
            ];
            if($request->hasFile('medical')) {
                $medical = $request->file('medical');
                $namaMedical = time() . rand(1,16) . 'mdc' . '.' .$medical->getClientOriginalExtension();
                $medical->move('uploads', $namaMedical);
                $input['medical']= $namaMedical;

                if ($users->medical && file_exists(public_path('uploads/' . $users->medical))) {
                    unlink(public_path('uploads/' . $users->medical));
                }
            }else {
                $input['medical'] = $users->medical;
            }

            if($request->hasFile('doc_akta')) {
                $doc_akta = $request->file('doc_akta');
                $namaAkta = time() . rand(1,32) . 'akt' . '.' .$doc_akta->getClientOriginalExtension();
                $doc_akta->move('uploads', $namaAkta);
                $input['doc_akta'] = $namaAkta;
                if ($users->doc_akta && file_exists(public_path('uploads/' . $users->doc_akta))) {
                    unlink(public_path('uploads/' . $users->doc_akta));
                }
                }else {
                    $input['doc_akta'] = $users->doc_akta;
                }

                if($request->hasFile('tiket')) {
                    $tiket = $request->file('tiket');
                    $namaTiket = time() . rand(1,32) . 'tiket' . '.' .$tiket->getClientOriginalExtension();
                    $tiket->move('uploads', $namaTiket);
                    $input['tiket'] = $namaTiket;
                    if ($users->tiket && file_exists(public_path('uploads/' . $users->tiket))) {
                        unlink(public_path('uploads/' . $users->tiket));
                    }
                    }else {
                        $input['tiket'] = $users->tiket;
                    }

            if($request->hasFile('doc_kk')) {
                $doc_kk = $request->file('doc_kk');
                $namaKK = time() . rand(2,24) . 'kk' . '.' .$doc_kk->getClientOriginalExtension();
                $doc_kk->move('uploads', $namaKK);
                $input['doc_kk']= $namaKK;
                if ($users->doc_kk && file_exists(public_path('uploads/' . $users->doc_kk))) {
                    unlink(public_path('uploads/' . $users->doc_kk));
                }
                }else {
                    $input['doc_kk'] = $users->doc_kk;
                }

            if($request->hasFile('ijazah')) {
                $ijazah = $request->file('ijazah');
                $nama_ijazah = time() . rand(1,24) . 'ijz' . '.' .$ijazah->getClientOriginalExtension();
                $ijazah->move('uploads', $nama_ijazah);
                $input['ijazah']= $nama_ijazah;
                if ($users->ijazah && file_exists(public_path('uploads/' . $users->ijazah))) {
                    unlink(public_path('uploads/' . $users->ijazah));
                }
                }else {
                    $input['ijazah'] = $users->ijazah;
                }

            if($request->hasFile('surat_nikah')) {
                $surat_nikah = $request->file('surat_nikah');
                $nama_surat_nikah = time() . rand(1,31) . 'sn' . '.' .$surat_nikah->getClientOriginalExtension();
                $surat_nikah->move('uploads', $nama_surat_nikah);
                $input['surat_nikah']= $nama_surat_nikah;
                if ($users->surat_nikah && file_exists(public_path('uploads/' . $users->surat_nikah))) {
                    unlink(public_path('uploads/' . $users->surat_nikah));
                }
                }else {
                    $input['surat_nikah'] = $users->surat_nikah;
                }
            
          
            if($request->hasFile('bnsp')) {
                $bnsp = $request->file('bnsp');
                $nama_bnsp = time() . rand(1,17) . 'bnsp' . '.' .$bnsp->getClientOriginalExtension();
                $bnsp->move('uploads', $nama_bnsp);
                $input['bnsp']= $nama_bnsp;
                if ($users->bnsp && file_exists(public_path('uploads/' . $users->bnsp))) {
                    unlink(public_path('uploads/' . $users->bnsp));
                }
                }else {
                    $input['bnsp'] = $users->bnsp;
                }

            if($request->hasFile('bpjs')) {
                $bpjs = $request->file('bpjs');
                $nama_bpjs = time() . rand(1,38) . 'bpjs' . '.' .$bpjs->getClientOriginalExtension();
                $bpjs->move('uploads', $nama_bpjs);
                $input['bpjs']= $nama_bpjs;
                if ($users->bpjs && file_exists(public_path('uploads/' . $users->bpjs))) {
                    unlink(public_path('uploads/' . $users->bpjs));
                }
                }else {
                    $input['bpjs'] = $users->bpjs;
                }
            if($request->hasFile('pp')) {
                $pp = $request->file('pp');
                $nama_pp = time() . rand(1,19) . 'pp' . '.' .$pp->getClientOriginalExtension();
                $pp->move('uploads', $nama_pp);
                $input['pp']= $nama_pp;
                if ($users->pp && file_exists(public_path('uploads/' . $users->pp))) {
                    unlink(public_path('uploads/' . $users->pp));
                }
                }else {
                    $input['pp'] = $users->pp;
                }
            if($request->hasFile('pasport')) {
                $pasport = $request->file('pasport');
                $nama_pasport = time() . rand(1,29) . 'pasport' . '.' .$pasport->getClientOriginalExtension();
                $pasport->move('uploads', $nama_pasport);
                $input['pasport']= $nama_pasport;
                if ($users->pasport && file_exists(public_path('uploads/' . $users->pasport))) {
                    unlink(public_path('uploads/' . $users->pasport));
                }
                }else {
                    $input['pasport'] = $users->pasport;
                }
            if($request->hasFile('pk')) {
                $pk = $request->file('pk');
                $nama_pk = time() . rand(1,3) . 'pk' . '.' .$pk->getClientOriginalExtension();
                $pk->move('uploads', $nama_pk);
                $input['pk']= $nama_pk;
                if ($users->pk && file_exists(public_path('uploads/' . $users->pk))) {
                    unlink(public_path('uploads/' . $users->pk));
                }
                }else {
                    $input['pk'] = $users->pk;
                }
            if($request->hasFile('visa')) {
                $visa = $request->file('visa');
                $nama_visa = time() . rand(1,12) . 'visa' . '.' .$visa->getClientOriginalExtension();
                $visa->move('uploads', $nama_visa);
                $input['visa']= $nama_visa;
                if ($users->visa && file_exists(public_path('uploads/' . $users->visa))) {
                    unlink(public_path('uploads/' . $users->visa));
                }
                }else {
                    $input['visa'] = $users->visa;
                }
            if($request->hasFile('ektkln')) {
                $ektkln = $request->file('ektkln');
                $nama_ektkln = time() . rand(1,13) . 'ektl' . '.' .$ektkln->getClientOriginalExtension();
                $ektkln->move('uploads', $nama_ektkln);
                $input['ektkln']= $nama_ektkln;
                if ($users->ektkln && file_exists(public_path('uploads/' . $users->ektkln))) {
                    unlink(public_path('uploads/' . $users->ektkln));
                }
                }else {
                    $input['ektkln'] = $users->ektkln;
                }
            $users->update($input);
            return $users;
        }catch(Exception $e)
        {
            return response()->json([
                'error' => $e
            ]);
        }
    }

   
    public function getId($id)
    {
        
        $user = User::with('saranaKesehatan', 'regency')->findOrFail($id);
        return $user;
       
    }

    public function deleteApi($id)
    {
       $user = User::find($id);
       if($user) {
        $foto = $user->foto;
        $bpjs = $user->bpjs;
        $pp = $user->pp;
        $pasport = $user->pasport;
        $pk = $user->pk;
        $visa = $user->visa;
        $ektkln = $user->ektkln;
        $ijazah = $user->ijazah;
        $doc_ktp = $user->doc_ktp;
        $doc_surat_izin = $user->doc_surat_izin;
        $surat_nikah = $user->surat_nikah;
        $medical = $user->medical;
        $bnsp = $user->bnsp;
        $doc_kk = $user->doc_kk;
        $doc_akta = $user->doc_akta;
        $tiket = $user->tiket;
        if(!empty($foto)) {
            File::delete('uploads/'.$foto);
        }

        if(!empty($tiket)) {
            File::delete('uploads/'.$tiket);
        }

        if(!empty($bpjs)) {
            File::delete('uploads/'.$bpjs);
        }

        if(!empty($pp)) {
            File::delete('uploads/'.$pp);
        }

        if(!empty($pasport)) {
            File::delete('uploads/'.$pasport);
        }

        if(!empty($pk)) {
            File::delete('uploads/'.$pk);
        }

        if(!empty($visa)) {
            File::delete('uploads/'.$visa);
        }

        if(!empty($ektkln)) {
            File::delete('uploads/'.$ektkln);
        }

        if(!empty($ijazah)) {
            File::delete('uploads/'.$ijazah);
        }

        if(!empty($doc_ktp)) {
            File::delete('uploads/'.$doc_ktp);
        }

        if(!empty($doc_surat_izin)) {
            File::delete('uploads/'.$doc_surat_izin);
        }

        if(!empty($surat_nikah)) {
            File::delete('uploads/'.$surat_nikah);
        }

        if(!empty($medical)) {
            File::delete('uploads/'.$medical);
        }
        if(!empty($bnsp)) {
            File::delete('uploads/'.$bnsp);
        }

        if(!empty($doc_akta)) {
            File::delete('uploads/'.$doc_akta);
        }
        if(!empty($doc_kk)) {
            File::delete('uploads/'.$doc_kk);
        }
        $user->delete();
       }
    }
    
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $users = User::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            $foto = $user->foto;
            $foto = $user->foto;
            $bpjs = $user->bpjs;
            $pp = $user->pp;
            $pasport = $user->pasport;
            $pk = $user->pk;
            $visa = $user->visa;
            $ektkln = $user->ektkln;
            $ijazah = $user->ijazah;
            $doc_ktp = $user->doc_ktp;
            $doc_surat_izin = $user->doc_surat_izin;
            $surat_nikah = $user->surat_nikah;
            $medical = $user->medical;
            $bnsp = $user->bnsp;
            $doc_kk = $user->doc_kk;
            $doc_akta = $user->doc_akta;
            if(!empty($foto)) {
                File::delete('uploads/'.$foto);
            }
    
            if(!empty($bpjs)) {
                File::delete('uploads/'.$bpjs);
            }
    
            if(!empty($pp)) {
                File::delete('uploads/'.$pp);
            }
    
            if(!empty($pasport)) {
                File::delete('uploads/'.$pasport);
            }
    
            if(!empty($pk)) {
                File::delete('uploads/'.$pk);
            }
    
            if(!empty($visa)) {
                File::delete('uploads/'.$visa);
            }
    
            if(!empty($ektkln)) {
                File::delete('uploads/'.$ektkln);
            }
    
            if(!empty($ijazah)) {
                File::delete('uploads/'.$ijazah);
            }
    
            if(!empty($doc_ktp)) {
                File::delete('uploads/'.$doc_ktp);
            }
    
            if(!empty($doc_surat_izin)) {
                File::delete('uploads/'.$doc_surat_izin);
            }
    
            if(!empty($surat_nikah)) {
                File::delete('uploads/'.$surat_nikah);
            }
    
            if(!empty($medical)) {
                File::delete('uploads/'.$medical);
            }
            if(!empty($bnsp)) {
                File::delete('uploads/'.$bnsp);
            }

            if(!empty($doc_kk)) {
                File::delete('uploads/'.$doc_kk);
            }

            if(!empty($doc_akta)) {
                File::delete('uploads/'.$doc_akta);
            }
            $user->delete();
        }
    }

    public function addData(Request $request)
    {
        $input = [
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' =>  Hash::make($request->password),
            'tanggal_lahir' =>  $request->tanggal_lahir,
            'tempat_lahir' =>  $request->tempat_lahir,
            'usia' =>  $request->usia,
            'agama' =>  $request->agama,
            'no_telp' =>  $request->no_telp,
            'no_kk' =>  $request->no_kk,
            'status_menikah' =>  $request->status_menikah,
            'doc_ktp' =>  $request->doc_ktp,
            'doc_surat_izin' =>  $request->doc_surat_izin,
            'foto' =>  $request->foto,
            'alamat' =>  $request->alamat,
            'nama_bapak' => $request->nama_bapak, 
            'no_nik' => $request->no_nik,
            'no_surat_izin' => $request->no_surat_izin,
            'doc_kk' => $request->doc_kk,
            'doc_akta' => $request->doc_akta,
            'status_akun' => 'non_approved',
            'negara' => $request->negara,
            'provinsi' => $request->provinsi,
            'domisili_id' => $request->domisili
        ];

        if (!empty($input['tanggal_lahir'])) {
            $birthDate = Carbon::createFromFormat('Y-m-d', $input['tanggal_lahir']);
            $today = Carbon::now();
            $age = $birthDate->diffInYears($today);
            $input['usia'] = $age;
        } else {
            $input['usia'] = 0;
        }

        if($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . rand(1,9) . '.' .$foto->getClientOriginalExtension();
            $foto->move('uploads', $nama_foto);
            $input['foto'] = $nama_foto;
        }
        if($request->hasFile('doc_ktp')) {
            $doc_ktp = $request->file('doc_ktp');
            $nama_ktp = time() . rand(1,2) . '.' .$doc_ktp->getClientOriginalExtension();
            $doc_ktp->move('uploads', $nama_ktp);
            $input['doc_ktp'] = $nama_ktp;
        }
        if($request->hasFile('doc_surat_izin')) {
            $doc_surat_izin = $request->file('doc_surat_izin');
            $nama_surat_izin = time() . rand(1,8) . '.' .$doc_surat_izin->getClientOriginalExtension();
            $doc_surat_izin->move('uploads', $nama_surat_izin);
            $input['doc_surat_izin'] = $nama_surat_izin;
        }

        if($request->hasFile('doc_kk')) {
            $doc_kk = $request->file('doc_kk');
            $namaKK = time() . rand(1,25) . '.' .$doc_kk->getClientOriginalExtension();
            $doc_kk->move('uploads', $namaKK);
            $input['doc_kk'] = $namaKK;
        }
      
        if($request->hasFile('doc_akta')) {
            $doc_akta = $request->file('doc_akta');
            $namaAkta = time() . rand(1,13) . '.' .$doc_akta->getClientOriginalExtension();
            $doc_akta->move('uploads', $namaAkta);
            $input['doc_akta'] = $namaAkta;
        }

        $users = User::create($input);
        return $users;
    }

    
}
