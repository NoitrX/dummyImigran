<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR | PMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR | PMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('auth/style.css')}}">
    <link href="{{ asset('assets/css/me.css')}}" rel="stylesheet" type="text/css" />
   <style>
        .image {
            text-align: center;
        }
    </style>
</head>
<body>
    @include('sweetalert::alert')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container border mt-3 bg-white">
        <div class="image my-3">
            <img class="" style="height: 80px" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="header">DAFTAR SEBAGAI PMI</h2>
            <p class="text-sm" style="font-size: 10px">Setelah Berhasil Mendaftar Harap Tunggu Admin Menghubungi</p>
            <a href="{{ route('login')}}" class="text-sm fw-bold" style="font-size: 13px ; text-decoration:none">LOGIN</a>
        </div>
        <form action="{{ route('register.store')}}" method="POST" enctype="multipart/form-data">
        <div class="row p-3">
                @csrf
            <div class="col-md-4 mb-2">
                <label for="namaLengkap" class="form-label" >Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-0 @error('name') is-invalid @enderror" id="namaLengkap" placeholder="Isi Nama Lengkap" autocomplete="off">
                @error('name')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>

            <div class="col-md-4 mb-2">
                <label for="namaLengkap" class="form-label" >Nama Bapak</label>
                <input type="text" name="nama_bapak" value="{{ old('nama_bapak') }}" class="form-control rounded-0 @error('nama_bapak') is-invalid @enderror" id="namaBapak" placeholder="Isi Nama Bapak" autocomplete="off">
                @error('nama_bapak')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control rounded-0 @error('email') is-invalid @enderror"  placeholder="Isi Alamat Email" autocomplete="off">
                @error('email')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control rounded-0 @error('password') is-invalid @enderror"  placeholder="Isi Password">
                @error('password')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control rounded-0 @error('tanggal_lahir') is-invalid @enderror"  placeholder="Isi Alamat Email">
                @error('tanggal_lahir')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-control rounded-0 @error('tempat_lahir') is-invalid @enderror"  placeholder="Tempat Lahir">
                @error('tempat_lahir')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Agama</label>
                <input type="text" name="agama" value="{{ old('agama') }}" class="form-control rounded-0 @error('agama') is-invalid @enderror"   placeholder="Isi Agama" autocomplete="off">
                @error('agama')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">No Telp</label>
                <input type="number" name="no_telp" value="{{ old('no_telp') }}" class="form-control rounded-0 @error('no_telp') is-invalid @enderror"  placeholder="Isi Nomor Telepon" autocomplete="off">
                @error('no_telp')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">No KK</label>
                <input type="number" name="no_kk" value="{{ old('no_kk') }}" class="form-control rounded-0 @error('no_kk') is-invalid @enderror"  placeholder="Isi Nomor KK">
                @error('no_kk')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label"> No NIK(NO KTP)</label>
                <input type="number" name="no_nik" value="{{ old('no_nik') }}" placeholder="Isi Nomor KTP " class="form-control rounded-0 @error('no_nik') is-invalid @enderror" >
                @error('no_nik')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label"> No Surat Izin</label>
                <input type="text" name="no_surat_izin" value="{{ old('no_surat_izin') }}"  placeholder="Isi Nomor SURAT IZIN" class="form-control rounded-0 @error('no_surat_izin') is-invalid @enderror" autocomplete="off">
                @error('no_surat_izin')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Pendidikan</label>
                <select name="pendidikan" class="form-control rounded-0 @error('pendidikan') is-invalid @enderror" >
                    <option value="hidden">------ Pilih Opsi -----</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA/SMK">SMA/SMK</option>
                    <option value="TIDAK_SEKOLAH">TIDAK BERSEKOLAH</option>
                </select>
                @error('pendidikan')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Status Menikah</label>
                <select name="status_menikah" class="form-control rounded-0 @error('status_menikah') is-invalid @enderror"  >
                    <option value="hidden">------ Pilih Opsi -----</option>
                    <option value="menikah">Menikah</option>
                    <option value="belom_menikah">Belum Menikah</option>
                    <option value="janda">Janda</option>
                </select>
                @error('status_menikah')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="" class="form-label">Upload SCAN KTP</label>
                <input type="file" name="doc_ktp" class="form-control rounded-0 @error('doc_ktp') is-invalid @enderror" >
                @error('doc_ktp')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="" class="form-label">Upload Surat Izin</label>
                <input type="file" name="doc_surat_izin" class="form-control rounded-0 @error('doc_surat_izin') is-invalid @enderror" >
                @error('doc_surat_izin')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
           
            <div class="col-md-4 mb-2">
                <label for="" class="form-label">Upload Foto</label>
                <input type="file" name="foto" class="form-control rounded-0 @error('foto') is-invalid @enderror" >
                @error('foto')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>


            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Upload KK</label>
                <input type="file" name="doc_kk" class="form-control rounded-0 @error('doc_kk') is-invalid @enderror" >
                @error('doc_kk')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Upload Akta Kelahiran</label>
                <input type="file" name="doc_akta" class="form-control rounded-0 @error('doc_akta') is-invalid @enderror" >
                @error('doc_akta')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="" cols="30" rows="5"></textarea>
                @error('alamat')
                <div class="text-danger detailed_text">{{ $message }}</div>
            @enderror
            </div>
           
            <div class="d-flex justify-content-center mt-2">
                <button class="btn btn-primary rounded-0 register" style="width: 100%" type="submit"> DAFTAR </button>
            </div>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>