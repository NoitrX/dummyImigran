@extends('Layouts.mainD')
@section('title', 'Non Approved User | PMI')

@section('sections')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <div class="d-flex">
          <a href="{{route('user-nonapproved.index')}}" class="me-3"> <i class="fas fa-arrow-left"></i></a>
          <h4 class="mb-sm-0 font-size-18">DETAIL PMI</h4>
        </div>
    
      </div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">DETAIL PMI</h4>
          <div class="d-flex justify-content-between">
            <p class="card-title-desc">Berikut ini adalah Detail dari PMI</p>
            
          </div>
         
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center text-center mt-5">
              <h3 class="fw-bold mb-3 detailed">DATA PMI</h3>
            </div>
            <div class="d-flex justify-content-end">
              <div>
                <h2 class="text-sm" style="font-size: 15px">Pewawancara : {{$userId->wawancara_by}}</h2>
                <h2 class="text-sm" style="font-size: 15px">Tanggal Wawancara : {{$userId->tanggal_wawancara}}</h2>
              </div>
              
            </div>
            <div class="col-lg-6 d-flex justify-content-center mt-4">
                <img width="80%"  src="{{ asset('uploads/'.$userId->foto)}}" alt="">
            </div>
            <div class="col-lg-3 mt-4 detailed ">
              <p><span class="label fw-bold">Nama :</span> <span class="value">{{$userId->name}}</span></p>
              <p><span class="label fw-bold">Email :</span> <span class="value">{{$userId->email}}</span></p>
              <p><span class="label fw-bold">TTL :</span> <span class="value">{{$userId->tempat_lahir}}, {{$userId->tanggal_lahir}}</span></p>
              <p><span class="label fw-bold">Alamat :</span> <span class="value">{{$userId->alamat}}</span></p>
              <p><span class="label fw-bold">Usia :</span> <span class="value">{{$userId->usia}}</span></p>
              <p><span class="label fw-bold">Agama :</span> <span class="value">{{$userId->agama}}</span></p>
              <p><span class="label fw-bold">No KK :</span> <span class="value">{{$userId->no_kk}}</span></p>
              <p><span class="label fw-bold">No NIK :</span> <span class="value">{{$userId->no_nik}}</span></p>
              <p><span class="label fw-bold">Negara :</span> <span class="value">{{$userId->negara}}</span></p>
              <p><span class="label fw-bold">Domisili :</span> <span class="value"> {{ $userId->regency->name }}</span></p>
              <p><span class="label fw-bold">Disnaker :</span> <span class="value"> {{ $userId->provinsi }}</span></p>
              <p><span class="label fw-bold">Status TKI :</span> <span class="value"> {{ $userId->status_tki }}</span></p>
          </div>
          <div class="col-lg-3 mt-4 detailed">
            <p><span class="label fw-bold">No Surat Izin :</span> <span class="value">{{$userId->no_surat_izin}}</span></p>
            <p><span class="label fw-bold">Status Menikah :</span> <span class="value">{{$userId->status_menikah}}</span></p>
            <p><span class="label fw-bold">Tinggi Badan : </span> <span class="value">{{$userId->tinggi_badan}}</span></p>
            <p><span class="label fw-bold">Berat Badan :</span> <span class="value">{{$userId->berat_badan}}</span></p>
            <p><span class="label fw-bold">Pendidikan :</span> <span class="value">{{$userId->pendidikan}}</span></p>
            <p><span class="label fw-bold">No Telp :</span> <span class="value">{{$userId->no_telp}}</span></p>
            <p><span class="label fw-bold">No KK :</span> <span class="value">{{$userId->no_kk}}</span></p>
            <p><span class="label fw-bold">Keterangan :</span> <span class="value"> {{ $userId->keterangan }}</span></p>
          </div>
         
        </div>
        
        </div>
       
      </div>
     
    </div>
  </div>

@endsection