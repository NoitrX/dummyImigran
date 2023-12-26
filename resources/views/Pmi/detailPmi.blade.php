@extends('Layouts.main')
@section('title', 'Detail PMI | PAGE')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">DETAIL PMI</h4>
        <a href="" class="btn btn-primary  rounded-0"> <i class="fas fa-plus"></i> Lengkapi Data</a>
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
            <p class="text-danger fw-bold" style="font-size: 11px">Klik Text Dokumen untuk Melihat Dokumen!</p>
            
          </div>
         
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 text-center mt-5">
              <h3 class="fw-bold mb-3 detailed">DATA PMI</h3>
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
          </div>

          <div class="col-lg-3 mt-4 detailed">
            <p><span class="label fw-bold">Jabatan :</span> <span class="value">{{$userId->jabatan}}</span></p>
            <p><span class="label fw-bold">No Surat Izin :</span> <span class="value">{{$userId->no_surat_izin}}</span></p>
            <p><span class="label fw-bold">Status :</span> <span class="value">{{$userId->status}}</span></p>
            <p><span class="label fw-bold">Status Menikah :</span> <span class="value">{{$userId->status_menikah}}</span></p>
            <p><span class="label fw-bold">Tinggi Badan : </span> <span class="value">{{$userId->tinggi_badan}}</span></p>
            <p><span class="label fw-bold">Berat Badan :</span> <span class="value">{{$userId->berat_badan}}</span></p>
            <p><span class="label fw-bold">Pendidikan :</span> <span class="value">{{$userId->pendidikan}}</span></p>
            <p><span class="label fw-bold">No Telp :</span> <span class="value">{{$userId->no_telp}}</span></p>
            <p><span class="label fw-bold">No KK :</span> <span class="value">{{$userId->no_kk}}</span></p>
            <p><span class="label fw-bold">Medical :</span> <span class="value"> {{ $userId->saranaKesehatan->nama_sarana ?? 'Data Kosong' }}</span></p>
        </div>
            <div class="col-lg-12 text-center mt-5">
              <h3 class="fw-bold detailed">DOKUMEN PENDUKUNG</h3>
            </div>

          @csrf
          <div class="col-lg-4 mt-3">
              <label for="">BPJS</label>
              <div class="d-flex">
                  <input type="text" class="form-control" value="{{ $userId->bpjs }}" readonly>
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'bpjs']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                      <i class="fas fa-download"></i>
                  </a>
              </div>
          </div>

            <div class="col-lg-4 ">
              <label for="">PP</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->pp}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'pp']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 ">
              <label for="">Passport</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->pasport}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'pasport']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3">
              <label for="">PK</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->pk}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'pk']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3 ">
              <label for="">VISA</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->visa}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'visa']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4  mt-3">
              <label for="">EKTKLN</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->ektkln}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'ektkln']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4  mt-3">
              <label for="">IJAZAH</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->ijazah}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'ijazah']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3">
              <label for="">KTP</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->doc_ktp}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'doc_ktp']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3">
              <label for="">SURAT IZIN</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->doc_surat_izin}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'doc_surat_izin']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3">
              <label for="">SURAT NIKAH (JIKA ADA)</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->surat_nikah}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'surat_nikah']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3">
              <label for="">MEDICAL</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->medical}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'medical']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-4 mt-3 ">
              <label for="">BNSP</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->bnsp}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'bnsp']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            <div class="col-lg-6 mt-3  mb-5">
              <label for="">KK</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->doc_kk}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'doc_kk']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>

            
            <div class="col-lg-6 mt-3 mb-5">
              <label for="">AKTA</label>
                <div class="d-flex">
                  <input type="text" class="form-control" value="{{$userId->doc_akta}}">
                  <a href="{{ route('download.bpjs', ['id' => $userId->id, 'document'=> 'doc_akta']) }}" id="downloadBpjsBtn" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
            </div>
            <p class="text-center text-danger">Sebelum Menyatukan Document Harap lengkapi Data terlebih Dahulu!</p>
            <a href="{{ route('download.merged.pdf', ['id' => $userId->id]) }}" class="btn btn-primary btn-sm">
              <i class="fas fa-download"></i> DOWNLOAD DOCUMENT
          </a>
          </div>
         
        </div>
        
        </div>
       
      </div>
     
    </div>
  </div>
  <script>
    document.getElementById('downloadBpjsBtn').addEventListener('click', function(event) {
        event.preventDefault();

        var username = "{{$userId->name}}";
        window.location.href = this.href + '?filename=' + username + '.pdf';

    });
</script>
@endsection

