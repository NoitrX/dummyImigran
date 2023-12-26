@extends('Layouts.main')
@section('title', 'LENGKAPI | PMI')

@section('content')
<h4>ISI DATA PMI</h4>
<h6>LENGKAPI DATA PMI</h6>
<p class="text-danger"> * Untuk Size Maximum dari File adalah 3MB , Kolom Bertanda * Artinya wajib Diisi</p>
{{-- <p>{{ auth()->user()}} </p> --}}
<p class="test text-danger"></p>
<form action="/api/users/store/{{$users->id}}" method="POST" id="addDataForm" enctype="multipart/form-data">
    @csrf
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
    <label>Tinggi Badan <span style="color: red">*</span> </label>
    <input type="text" name="tinggi_badan" class="form-control" value="{{$users->tinggi_badan}}" placeholder="Masukan Tinggi Badan" value="{{ old('tinggi_badan')}}" autocomplete="off">
    </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
    <label>Berat Badan <span style="color: red">*</span> </label>
    <input type="text" class="form-control" value="{{$users->berat_badan}}" placeholder="Masukan Berat Badan" name="berat_badan">
    </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Negara <span style="color: red">*</span> </label>
            <select name="negara" class="form-control" id="">
                <option value="{{$users->negara}}">{{$users->negara}}</option>
                <option value="ARAB SAUDI">ARAB SAUDI</option>
                <option value="TAIWAN">TAIWAN</option>
                <option value="JEPANG">JEPANG</option>
                <option value="KUWAIT">KUWAIT</option>
                <option value="MALAYSIA">MALAYSIA</option>
                <option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>
                <option value="SINGAPURA">SINGAPURA</option>
                <option value="BAHREN">BAHREN</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
        <label>Jabatan <span style="color: red">*</span> </label>
        <select name="jabatan" class="form-control" id="">
            <option value="{{$users->jabatan}}">{{$users->jabatan}}</option>
            <option value="HOUSE MAID">HOUSE MAID</option>
            <option value="NANNY">NANNY</option>
            <option value="HOUSE KEEPER AND FAMILY COOK">HOUSE KEEPER AND FAMILY COOK</option>
            <option value="NURSE">NURSE</option>
        </select>
        </div>
        </div>

    
    <div class="col-lg-3 col-sm-6 col-12 mt-1">
    <div class="form-group">
    <label>Pendidikan <span style="color: red">*</span> </label>
    <select name="pendidikan" class="form-control" id="">
        <option value="{{$users->pendidikan}}">{{$users->pendidikan}}</option>
        <option value="SD">SD</option>
        <option value="SMP">SMP</option>
        <option value="SMA">SMA</option>
        <option value="PERGURUAN_TINGGI">PERGURUAN_TINGGI</option>
        <option value="TIDAK_SEKOLAH">TIDAK_SEKOLAH</option>
    </select>
    </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 mt-1">
        <div class="form-group">
        <label>Data Medical <span style="color: red">*</span> </label>
        <select name="data_medical_id" class="form-control" id="">
            @foreach ($saranaKesehatan as $item)
            <option value="{{$item->id}}">{{$item->nama_sarana}}</option>
            @endforeach
           
        </select>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 mt-1">
            <div class="form-group">
                <label>KK <span style="color: red">*</span></label>
                <input type="file" class="form-control" name="doc_kk" id="ijazahInput">
            </div>
            <div>
                <label>File Yang Sudah Ada:</label>
                <span id="selectedFileName">{{$users->doc_kk}}</span>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 mt-1">
            <div class="form-group">
                <label>AKTA <span style="color: red">*</span></label>
                <input type="file" class="form-control" name="doc_akta" id="ijazahInput">
            </div>
            <div>
                <label>File Yang Sudah Ada:</label>
                <span id="selectedFileName">{{$users->doc_akta}}</span>
            </div>
        </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Ijazah <span style="color: red">*</span></label>
            <input type="file" class="form-control" name="ijazah" id="ijazahInput">
        </div>
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedFileName">{{$users->ijazah}}</span>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>Surat Nikah (Jika Ada) <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->surat_nikah}}" class="form-control" name="surat_nikah" id="suratNikahInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedSuratNikah">{{$users->surat_nikah}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>Medical <span style="color: red">*</span> </label>
        <input type="file"  class="form-control" name="medical" id="medicalInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedMedical">{{$users->medical}}</span>
        </div>
    </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>BNSP <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->bnsp}}" class="form-control" name="bnsp" id="bnspInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedBnsp">{{$users->bnsp}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>BPJS <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->bpjs}}" class="form-control" name="bpjs" id="bpjsInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedBpjs">{{$users->bpjs}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>PP <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->pp}}" class="form-control" name="pp" id="ppInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedPp">{{$users->pp}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>Pasport <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->pasport}}" class="form-control" name="pasport" id="pasportInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedPasport">{{$users->pasport}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>PK <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->pk}}" class="form-control" name="pk" id="pkInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedPk">{{$users->pk}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>VISA <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->visa}}" class="form-control" name="visa" id="visaInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedVisa">{{$users->visa}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12 mt-2">
        <div class="form-group">
        <label>EKTKLN <span style="color: red">*</span> </label>
        <input type="file" value="{{$users->ektkln}}" class="form-control" name="ektkln" id="ektklnInput">
        
        <div>
            <label>File Yang Sudah Ada:</label>
            <span id="selectedEktkln">{{$users->visa}}</span>
        </div>
    </div>
    </div>
    <div class="col-lg-12 col-sm-6 col-12 mt-2">
    <div class="form-group">
    <label> Status <span style="color: red">*</span> </label>
    <select class="form-control" name="status">
    <option value="{{$users->status}}">{{$users->status}}</option>
    <option value="medical">Medical</option>
    <option value="blkln">blkln</option>
    <option value="rekompassport">rekompassport</option>
    <option value="basmah">basmah</option>
    <option value="kbsa">kbsa</option>
    <option value="visa">VISA</option>
    <option value="opp">OPP</option>
   
    </select>
    @error('senpai_id')
    <div class="text-danger"></div>
    @enderror
    </div>
    </div>
    
    <div class="col-lg-12 mt-4 d-flex justify-content-center">
    <button type="submit" class="btn btn-primary rounded-0 me-2">Submit</button>
    <a href="{{route('user.index')}}" class="btn btn-danger rounded-0">Cancel</a>
    </div>
    </div>
    </div>
    </div>
    
    </div>
    </div>
    </div>
</form>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addDataForm').submit(function(e) {
            e.preventDefault(); 

      
            var formData = new FormData(this);

            // Send the AJAX request
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.text-danger').empty();
                    console.log('testing',response)
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data PMI berhasil Dilengkapi!.',
                        position: 'topRight',
                    });             
                    setTimeout(function() {
                        window.location.href = '/users';
                    }, 1000);
                },
                error: function(xhr, status, error) {

                    console.error(xhr);
                    var errorMessage = 'Error:';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += '\n- ' + value;
                    });

                    iziToast.error({
                        title: 'Error',
                        message: 'Terdapat Kesalahan saat Pengisian',
                        position: 'topRight',
                    });
                   
                }
            });
        });
    });

    // $(document).ready(function () {
    //     var selectedFileName = "{{$users->ijazah}}";
    //     $('#selectedFileName').text(selectedFileName);
    //     $('#ijazahInput').on('change', function () {
    //         var fileName = $(this).val().split('\\').pop();
    //         $('#selectedFileName').text(fileName);
    //     });
        

    //     var selectedSuratNikah = "{{$users->surat_nikah}}"
    //     $('#selectedSuratNikah').text(selectedSuratNikah);
    //     $('#suratNikahInput').on('change', function () {
    //         var fileNameSuratNikah = $(this).val().split('\\').pop();
    //         $('#selectedSuratNikah').text(fileNameSuratNikah);
    //     })

    //     var selectedMedical = "{{$users->medical}}"
    //     $('#selectedMedical').text(selectedMedical);
    //     $('#medicalInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedMedical').text(fileMedical);
    //     })

    //     var selectedBnsp = "{{$users->bnsp}}"
    //     $('#selectedBnsp').text(selectedBnsp);
    //     $('#bnspInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedBnsp').text(selectedBnsp);
    //     })

    //     var selectedBpjs = "{{$users->bpjs}}"
    //     $('#selectedBpjs').text(selectedBpjs);
    //     $('#bpjsInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedBpjs').text(selectedBpjs);
    //     })

    //     var selectedPp = "{{$users->pp}}"
    //     $('#selectedPp').text(selectedPp);
    //     $('#ppInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedPp').text(selectedPp);
    //     })

    //     var selectedPk = "{{$users->pk}}"
    //     $('#selectedPk').text(selectedPk);
    //     $('#pkInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedPk').text(selectedPk);
    //     })

    //     var selectedVisa = "{{$users->visa}}"
    //     $('#selectedVisa').text(selectedVisa);
    //     $('#visaInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedVisa').text(selectedVisa);
    //     })

    //     var selectedEktkln = "{{$users->visa}}"
    //     $('#selectedEktkln').text(selectedEktkln);
    //     $('#ektklnInput').on('change', function () {
    //         var fileMedical = $(this).val().split('\\').pop();
    //         $('#selectedEktkln').text(selectedEktkln);
    //     })

        
        
    // });
</script>