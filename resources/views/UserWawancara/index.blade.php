@extends('Layouts.mainD')
@section('title', 'Admin Wawancara | AMS')

@section('sections')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">DAFTAR PMI BELUM WAWANCARA</h4>
      </div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">DAFTAR PMI BELUM WAWANCARA</h4>
          <div class="d-flex justify-content-between">
            <p class="card-title-desc">Berikut ini adalah Daftar Para PMI dengan Proses BELUM WAWANCARA</p>
            <div>
              <a href="#" class="btn btn-danger btn-sm rounded-0"  id="deleteAllSelectedRecord" style="display: none;"><i class="fas fa-trash mx-1"></i> Delete All</a>
              {{-- <a href="" class="btn btn-success btn-sm rounded-0"> <i class="fa-solid fa-file-excel"></i> Export </a> --}}
            </div>
           
          </div>
         
        </div>
        <div class="card-body">
          <form class="form-inline d-flex mb-2" method="" action="">
            <input class="form-control mr-sm-2" id="search" type="search" placeholder="Cari Data..." aria-label="Search">
            <button class="btn btn-primary mx-1"><i class="fas fa-search"></i></button>
          </form>
          <div class="row mb-4 mt-1 filter">
            <div class="col-lg-12 filter">
              <div class="row">
               
              </div>
          </div>
        </div>
          <table id="datatables" class="table  dt-responsive nowrap w-100">
            <thead class="detailed">
              <tr>
                <th>
                  <label class="checkboxs">
                    <input type="checkbox" id="select_all_ids">
                    <span class="checkmarks"></span>
                  </label>
                </th>
                <th class="text-center">#</th>
                <th class="text-center">NAMA</th>
                <th class="text-center">KANDEPNAKER</th>
                <th class="text-center">TTL</th>
                <th class="text-center">NO KK</th>
                <th class="text-center">NO NIK</th>
                <th class="text-center">NO S.I</th>
                <th class="text-center">KTP</th>
                <th class="text-center">SURAT IZIN</th>
                <th class="text-center">KK</th>
                <th class="text-center">AKTA</th>
                <th class="text-center">FOTO</th>
                <th class="text-center">NO TELP</th>
                <th class="text-center">STATUS</th>
                <th class="text-center">LOG</th>
              </tr>
            </thead>
          </table>
          <div class="d-flex justify-content-center mt-3">
          <div id="paginationInfo"></div>
          <div class="paginationControls ">
              <button class="btn btn-primary" id="prevPage">Previous</button>
              <button class="btn btn-primary" id="nextPage">Next</button>
          </div>
        </div>
        </div>
       
      </div>
     
    </div>
  </div>

  <div class="modal fade " id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> LengkapI Data PMI WAWANCARA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" id="editDataForm" method="POST">
                @csrf
                <input type="hidden" name="id" id="userId" value="">
                <div class="row">

             
                <div class="col-md-4 mb-2">
                  <label for="namaLengkap" class="form-label" >Nama Lengkap</label>
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-0 @error('name') is-invalid @enderror" id="namaLengkap" placeholder="Isi Nama Lengkap" autocomplete="off">
                  @error('name')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
  
              <div class="col-md-4 mb-2">
                  <label for="namaLengkap" class="form-label" >Nama Ayah</label>
                  <input type="text" name="nama_bapak" value="{{ old('nama_bapak') }}" class="form-control rounded-0 @error('nama_bapak') is-invalid @enderror" id="namaBapak" placeholder="Isi Nama Bapak" autocomplete="off">
                  @error('nama_bapak')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>

              <div class="col-md-4 mb-2">
                <label for="namaLengkap" class="form-label" >Tinggi Badan</label>
                <input type="text" name="tinggi_badan" value="{{ old('tinggi_badan') }}" id="tinggi_badan" class="form-control rounded-0 @error('tinggi_badan') is-invalid @enderror" placeholder="Isi Tinggi badan" autocomplete="off">
                @error('tinggi_badan')
                <div class=" detailed_text">{{ $message }}</div>
            @enderror
            </div>

            <div class="col-md-4 mb-2">
              <label for="namaLengkap" class="form-label" >Berat Badan</label>
              <input type="text" name="berat_badan" value="{{ old('berat_badan') }}" id="berat_badan" class="form-control rounded-0 @error('berat_badan') is-invalid @enderror" placeholder="Isi Berat Badan" autocomplete="off">
              @error('berat_badan')
              <div class=" detailed_text">{{ $message }}</div>
          @enderror
          </div>
              <div class="col-md-4 mb-2">
                  <label for="" class="form-label">Email</label>
                  <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control rounded-0 @error('email') is-invalid @enderror"  placeholder="Isi Alamat Email" autocomplete="off">
                  @error('email')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
              <div class="col-md-4 mb-2">
                  <label for="" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" id="tanggal_lahir" class="form-control rounded-0 @error('tanggal_lahir') is-invalid @enderror"  placeholder="Isi Alamat Email">
                  @error('tanggal_lahir')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
              <div class="col-md-6 mb-2">
                  <label for="" class="form-label">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control" id="tempats_lahir">
                  @error('tempat_lahir')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
  
              <div class="col-md-6 mb-2">
                  <label for="" class="form-label">Domisili</label>
                  <select name="domisili_id" class="form-control domisili " id="domisili">
                      @foreach ($regency as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </select>
                  @error('domisili')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
  
            
              <div class="col-md-6 mb-2">
                  <label for="" class="form-label">Provinsi</label>
                 <input type="text" class="form-control" id="provinsi" name="provinsi"  >
                  @error('provinsi')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
              <div class="col-md-6 mb-2">
                  <label for="" class="form-label">Agama</label>
                  <select name="agama" class="form-select rounded-0 " id="agama">
                      <option value="ISLAM">ISLAM</option>
                      <option value="KRISTEN">KRISTEN</option>
                      <option value="KATOLIK">KATOLIK</option>
                      <option value="BUDDHA">BUDDHA</option>
                      <option value="HINDU">HINDU</option>
                      <option value="KONGHUCHU">KONGHUCHU</option>
                  </select>
                  @error('agama')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>
              <div class="col-md-6 mb-2">
                  <label for="" class="form-label">No Telp</label>
                  <input type="number" name="no_telp" value="{{ old('no_telp') }}" id="no_telp" class="form-control rounded-0 @error('no_telp') is-invalid @enderror"  placeholder="Isi Nomor Telepon" autocomplete="off">
                  @error('no_telp')
                  <div class=" detailed_text">{{ $message }}</div>
              @enderror
              </div>

            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                  <label>Negara <span style="color: red">*</span> </label>
                  <select name="negara" class="form-control" id="negara">
                      <option >---- Pilih Negara -------</option>
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


        

            <div class="col-lg-12 col-sm-6 col-12 mt-1">
              <div class="form-group">
              <label>Pendidikan <span style="color: red">*</span> </label>
              <select name="pendidikan" class="form-select" id="pendidikan"> 
                  <option >----PILIH PENDIDIKAN -------</option>
                  <option value="SD">SD</option>
                  <option value="SMP">SMP</option>
                  <option value="SMA">SMA</option>
                  <option value="PERGURUAN_TINGGI">PERGURUAN_TINGGI</option>
                  <option value="TIDAK_SEKOLAH">TIDAK_SEKOLAH</option>
              </select>
              </div>
              </div>
          
          <div class="col-lg-12 col-sm-6 col-12">
            <div class="form-group">
                  <label>STATUS TKI <span style="color: red">*</span> </label>
                  <select name="status_tki" class="form-control" id="status_tki">
                      <option >---- Pilih Status TKI -------</option>
                      <option value="EX">EX</option>
                      <option value="NON">NON</option>
                  </select>
              </div>
          </div>

          <div class="col-lg-12 col-sm-6 col-12">
            <div class="form-group">
                  <label>Keterangan <span style="color: red">*</span> </label>
                 <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="5"></textarea>
              </div>
          </div>
          </div>
            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  var downloadKtp = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'doc_ktp']) }}";
  var downloadSuratIzin = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'doc_surat_izin']) }}";
  var downloadKK = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'doc_kk']) }}";
  var downloadAkta = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'doc_akta']) }}";

  $(document).ready(function() {
     var dataTable;
     var currentPage = 1;
 
   function loadTableData(page) {
     if (dataTable) {
       dataTable.destroy();
     }
     dataTable = $('#datatables').DataTable({
       searching: false,
       paging: false,
       ordering: false,
       responsive: true,
       serverSide: true,
       info: false,
       ajax: {
         url: '/api/users-wawancara',
         type: 'GET',
         data: function (d) {
           d.keyword = $('#search').val();
           d.page = page;
           d.perPage = 7;
         },
         dataSrc: function (response) {
          updatePaginationInfo(response.pagination);
          return response.data;
         },
         initComplete: function(settings, json) {
     console.log('DataTables initialization complete. JSON response:', json);
 }
        
       },
 
       
       columns: [
         {
           data: null,
           render: function (data, type, row) {
             return `<input type="checkbox" id="checkBoxUsers" name="ids" class="checkbox_ids" value="${data.id}">`;
           },
         },
         {
           data: null,
           render: function (data, type, row) {
             console.log('ini row',row)
             var deleteUrl = "{{ url('/api/users-nonapproved/delete')}}"
             var approveUrl = "{{ url('/api/users-wawancara/setComplete')}}"
             var btn = `<div class="d-flex">
                           <button type="button" data-id="${row.id}" class="btn btn-info btn-sm rounded-0 edit-button" data-bs-toggle="modal"  data-bs-target="#modalEdit">
                              <i class="fas fa-edit"></i>
                          </button>

                            <form action="${approveUrl}/${row.id}" id="complete-form" class="mx-1 complete-form" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-0 btn-sm" id="btn-completed">
                                  <i class="fa-solid fa-check"></i>
                                </button>
                             </form>
                           
                           <form action="${deleteUrl}/${row.id}" class="mx-1 delete-form" method="POST">
                             @method('delete')
                             @csrf
                             <button type="submit" class="btn btn-danger rounded-0 btn-sm delete-btn">
                               <i class="fas fa-trash"></i>
                             </button>
                           </form>
                         </div>`;
             return btn;
           },
         },
         { data: 'name', render:function(data,type,row) {
          var combinedInfo = row.name + ' BINTI ' + row.nama_bapak;
          return combinedInfo
         } },
         { data: 'regency.name' },
         {
           data: 'tanggal_lahir', render: function(data,type,row) {
            var combinedInfo = row.tempat_lahir + ' | ' + row.tanggal_lahir;
            return combinedInfo;
           },
         },

         { data: 'no_kk' },
         { data: 'no_nik' },
         { data: 'no_surat_izin' },
     
       
         {
           data: 'doc_ktp',
            render: function(data, type, row) {
              var btn = `<a href="${downloadKtp.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
          },

         {
           data: 'doc_surat_izin',
           render: function(data,type,row) {
            var btn = `<a href="${downloadSuratIzin.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
         },

         {
           data: 'doc_kk',
           render: function(data,type,row) {
            var btn = `<a href="${downloadKK.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
         },

         {
           data: 'doc_akta',
           render: function(data,type,row) {
            var btn = `<a href="${downloadAkta.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
         },

         { data: 'foto' , render:function(data,type,row) {
            var gambar = data;
            return `<div>
              <img width="40" src="{{ asset('uploads/${gambar}')}}" alt="img" id="blah" class="image-click" data-image-url="{{ asset('uploads/${gambar}') }}">
              </div>`
          }},
          { data: 'no_telp' },
          { data: 'status_akun' },
         {
          data: 'created_by_user.email',
          render: function (data, type, row) {
            var createAt = row['created_at'];
            var date = new Date(createAt).toLocaleString('en-us', {
              weekday: 'long',
              month: 'short',
              day: 'numeric',
              year: 'numeric',
              hour: 'numeric',
              minute: 'numeric',
            });
            var updateAt = row['updated_at'];
            var dateUpdated = new Date(updateAt).toLocaleString('en-us', {
              weekday: 'long',
              month: 'short',
              day: 'numeric',
              year: 'numeric',
              hour: 'numeric',
              minute: 'numeric',
            });
            if (row['updated_by_user'] != null) {
              return (
                `<div style="display:flex"><div class="created">C</div>${data}</div>` +
                `<div class="log">${date}</div>` +
                `<br>` +
                `<div style="display:flex"> <div class="updated">U</div> ${row.updated_by_user['email']} </div>` +
                `<div class="log">${dateUpdated}</div>`
              );
            } else {
              return (
                `<div style="display:flex"><div class="created">C</div>${data}</div>` +
                `<div class="log">${date}</div>`
              );
            }
          },
        },
        
        
         
       ],
       drawCallback: function () {
         var pageInfo = dataTable.page.info();
         console.log('page',pageInfo)
         // $('#prevPage').prop('disabled', pageInfo.page <= 0);
         // $('#nextPage').prop('disabled', pageInfo.page >= pageInfo.pages - 1);
       },
     });
   }
   
   
  $('#prevPage').on('click', function () {
    if (currentPage > 1) {
      currentPage--;
      loadTableData(currentPage);
    }
  });

  $('#nextPage').on('click', function () {
    currentPage++;
    loadTableData(currentPage);
  });



  function updatePaginationInfo(pagination) {
    if (pagination) {
      var totalRecords = pagination.total_records;
      var totalPages = pagination.total_pages;
      var currentPage = pagination.current_page;

      var paginationInfo = `Showing ${currentPage} of ${totalPages} pages (${totalRecords} records)`;
      $('#paginationInfo').text(paginationInfo);
    }
  }

  $('#search').on('keyup', function() {
        dataTable.search(this.value).draw();
    });
 
   loadTableData();
 


   $(function() {
        $('#select_all_ids').click(function() {
            var btnDeleteAll = document.getElementById('deleteAllSelectedRecord');
            btnDeleteAll.style.display = this.checked ? 'inline' : 'none';
            $('.checkbox_ids').prop('checked', $(this).prop('checked'))
        });

        $(document).on('change', '#checkBoxUsers', function() {
        var selectedCount = $('input:checkbox[name=ids]:checked').length;
        var btnDeleteAll = $('#deleteAllSelectedRecord');


        if (selectedCount > 0) {
            btnDeleteAll.show(); 
        } else {
            btnDeleteAll.hide(); 
        }
    });

        $('#deleteAllSelectedRecord').click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });
            
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Kamu Tidak Akan Bisa Mengembalikan Data Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yakin!'
            }).then((result)=> {
                if(result.isConfirmed) {
                    $.ajax({
                url: "{{ route('user-nonapproved.deleteAll')}}",
                type: 'DELETE',
                data: {
                    ids:all_ids,
                            _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $.each(all_ids, function(key,val) {
                        window.location.href = '/users';
                    })
                   
                        
                }
            })
                }
            })

           
        })
    })
  

    $(document).ready(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#domisili').change(function (e) {
                console.log(e.target.value);
                var selectedRegencyId = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: '/getProvince/' + selectedRegencyId,
                    success: function (data) {
                        console.log(data.province)
                        $('#provinsi').val(data.province);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });


    $(document).on('click', '.edit-button', function(e) {
        var userId = $(this).data("id");
        var formEdit = $('#editDataForm');
        var myUrl =  `/api/users-wawancara/update/${userId}`;
        $.ajax({
          url: `/api/users-wawancara/edit/${userId}`,
          method: "GET",
          dataType: "json",
          success: function(response) {
            console.log('inires', response)
            var saranaData = response.data

            $('#userId').val(saranaData.id)

            $('#namaLengkap').val(saranaData.name)
            $('#namaBapak').val(saranaData.nama_bapak)
            $('#tinggi_badan').val(saranaData.tinggi_badan)
            $('#berat_badan').val(saranaData.berat_badan)
            $('#email').val(saranaData.email)
            $('#tanggal_lahir').val(saranaData.tanggal_lahir)
            $('#tempats_lahir').val(saranaData.tempat_lahir)
            $('#domisili').val(saranaData.domisili_id);
            $('#provinsi').val(saranaData.provinsi)
            $('#no_telp').val(saranaData.no_telp)
            $('#negara').val(saranaData.negara)
            $('#pendidikan').val(saranaData.pendidikan)
            $('#status_tki').val(saranaData.status_tki)
            $('#keterangan').val(saranaData.keterangan)
            formEdit.attr('action', myUrl )
            $("#modalEdit").modal("show");
          },
          error: function(xhr,status,error) {
            console.error(xhr)
          }
        })
    })

    $(document).ready(function() {
          $('#complete-form').submit(function(e) {
            e.preventDefault();
            var dataForm = new FormData(this);

            $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: dataForm,
              processData: false,
              contentType: false,
              success: function(response) {

                loadDataTable()
              },
              error: function(xhr,status,error) {
                console.error(xhr)
              }
            })
          })
        })
       

        $(document).ready(function() {
      $('#editDataForm').submit(function(e) {
        e.preventDefault();
        var newFormEdit = new FormData(this);

        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: newFormEdit,
          processData: false,
          contentType: false,
          success: function(response) {
            $('#modalEdit').modal('hide');
            $('#editDataForm')[0].reset();
            iziToast.success({
                  title: 'Sukses',
                        message: 'Data Updated Successfully!!.',
                        position: 'topRight',
                });
          loadTableData()
          },
          error: function(xhr,status,error) {
            console.error(xhr);
                    var errorMessage = 'Error:';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += '\n- ' + value;
                    });

                    iziToast.error({
                        title: 'Error',
                        message: 'Form wajib Diisi!',
                        position: 'topRight',
                    });
          }
        })
      })
    })
      
   $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var form = $(this).closest('.delete-form');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Kamu Tidak Akan Bisa Mengembalikan Data Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
              
              }
            
           });
        });
        
        $(document).on('click', '.image-click', function() {
          var imageUrl = $(this).data('image-url');
          $('#largeImage').attr('src', imageUrl);
          $('#imageModal').modal('show');
        });

    @if(session('success'))
        iziToast.success({
            title: 'Success',
            message: '{{ session('success') }}',
            position: 'topRight',
        });
        @elseif(session('oke'))
        iziToast.success({
            title: 'Success',
            message: '{{ session('oke') }}',
            position: 'topRight',
        });
    @endif
   
 });
 
 
 
 </script>
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img src="" alt="Larger Image" id="largeImage" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
@endsection