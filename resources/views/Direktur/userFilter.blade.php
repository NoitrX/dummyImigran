@extends('Layouts.mainD')
@section('title', 'LIST | PMI')

@section('sections')
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">DAFTAR PMI</h4>
      <button class="btn btn-primary " id="filter-active"> <i class="fas fa-filter"></i> FILTER DATA</button>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">DAFTAR PMI</h4>
        <div class="d-flex justify-content-between">
          <p class="card-title-desc">Berikut ini adalah Daftar Para PMI dengan beberapa Proses yang sudah dijalani</p>
          <div>

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
                <div class="col-lg-6">
                    <select name="" id="status-filter" class="form-control filterPMI">
                        <option value="hidden">------ PILIH STATUS ------</option>==||==
                        <option value="==||==">==||==</option>
                        <option value="medical">Medical</option>
                        <option value="blkln">BLKLN</option>
                        <option value="rekompassport">Rekomspassport</option>
                        <option value="basmah">basmah</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <select name="" id="jabatan-filter" class="form-control filterPMI">
                        <option value="hidden">------ PILIH JABATAN ------</option>
                        <option value="HOUSE MAID">HOUSE MAID</option>
                        <option value="NANNY">NANNY</option>
                        <option value="HOUSE KEEPER AND FAMILY COOK">HOUSE KEEPER AND FAMILY COOK</option>
                        <option value="NURSE">NURSE</option>
                    </select>
                </div>
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
              <th class="text-center">NEGARA</th>
              <th class="text-center">JABATAN</th>
              <th class="text-center">TTL</th>
              <th class="text-center">STATUS</th>
              <th class="text-center">STATUS MEDICAL</th>
              <th class="text-center">STATUS PENERBANGAN</th>
              <th class="text-center">KANDEPNAKER</th>
              <th class="text-center">PK</th>
              <th class="text-center">PASPOR</th>
              <th class="text-center">VISA</th>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

<script>
  var type = '{{ $type }}';
  var status = '{{ $status }}';
  var downloadPkRoute = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'pk']) }}";
  var downloadPasportRoute = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'pasport']) }}";
  var downloadVisaRoute = "{{ route('download.bpjs', ['id' => ':id', 'document' => 'visa']) }}";
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
        url: '{{ route("direktur.indexGet", ["type" => ":type", "status" => ":status"]) }}'
                .replace(':type', type)
                .replace(':status', status),
         type: 'GET',
         data: function (d) {
           d.keyword = $('#search').val();
           d.jabatan_filter = $('#jabatan-filter').val();
           d.status_filter = $('#status-filter').val();
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
             var getUrlStore = "{{ url('users/store') }}";
             var getUrlDetail = "{{ url('users-nonapproved/') }}";
             var deleteUrl = "{{ url('api/users/delete')}}"
             var approveUrl = "{{ url('/api/users/setComplete')}}"
             var btn = `<div class="d-flex">
                    
                       <a class="btn btn-primary btn-sm text-white rounded-0 mx-1" href="${getUrlDetail}/${row.id}">
                             <i class="fas fa-eye"></i>
                           </a>
                         </div>`;
             return btn;
           },
         },
         {
            data: 'name',
            render: function (data, type, row) {
            var combinedInfo = row.name + ' Binti ' + row.nama_bapak;
             var textColor = row.status_medical === 'non_fit' ? 'red' : (row.status_medical === 'fit' ? 'green' : ''); 
             return '<span style="color:' + textColor + '">' + combinedInfo + '</span>';
          }
        },
         { data: 'negara' },
         { data: 'jabatan' },
         {
           data: 'tanggal_lahir', render: function(data,type,row) {
            var combinedInfo = row.tempat_lahir + ' | ' + row.tanggal_lahir;
            return combinedInfo;
           },
         },
         { data: 'status' },
         { data: 'status_medical' },
         { data: 'status_penerbangan' },
         { data: 'tempat_lahir' },
  
         {
           data: 'pk',
            render: function(data, type, row) {
              var btn = `<a href="${downloadPkRoute.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
          },

         {
           data: 'pasport',
           render: function(data,type,row) {
            var btn = `<a href="${downloadPasportRoute.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
         },

         {
           data: 'visa',
           render: function(data,type,row) {
            var btn = `<a href="${downloadVisaRoute.replace(':id', row.id)}" class="btn btn-primary btn-sm rounded-0"><i class="fas fa-address-card"></i></a>`;
             if (data == null || data === undefined) {
                 btn = `<button class="btn btn-primary btn-sm rounded-0"disabled> <i class="fa-solid fa-address-card"></i></button>`;
                 }
                 return btn;
                }
         },

         
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

  $('#jabatan-filter').on('change', function() {
        var selectedValue = $(this).val();
        if(selectedValue === 'hidden') {
            dataTable.columns(6).search('').draw();
        }
        dataTable.columns(6).search(selectedValue).draw();
    })

    $('#status-filter').on('change', function() {
        var selectedValue = $(this).val();
        if(selectedValue === 'hidden') {
            dataTable.columns(6).search('').draw();
        }
        dataTable.columns(6).search(selectedValue).draw();
    })

  function updatePaginationInfo(pagination) {
    if (pagination) {
      var totalRecords = pagination.total_records;
      var totalPages = pagination.total_pages;
      var currentPage = pagination.current_page;

      var paginationInfo = `Showing ${currentPage} of ${totalPages} pages (${totalRecords} records)`;
      $('#paginationInfo').text(paginationInfo);
    }
  }

  $(document).ready(function() {
          $('#addDataForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              success:function(response) {
                $('#modalTambah').modal('hide');
                $('#addDataForm')[0].reset();
                iziToast.success({
                  title: 'Sukses',
                        message: 'Data Berhasil Ditambahkan!!.',
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
        loadTableData()

  $('#search').on('keyup', function() {
        dataTable.search(this.value).draw();
    });
 
   loadTableData();
 
 
   $('#filter-active').click(function() {
    $('.filter').fadeToggle('fast')
   })

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
                url: "{{ route('user.deleteAll')}}",
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
        @elseif(session('error'))
        iziToast.error({
            title: 'Success',
            message: '{{ session('error') }}',
            position: 'topRight',
        });
    @endif
   
 });
 
 
 
 </script>
@endsection
