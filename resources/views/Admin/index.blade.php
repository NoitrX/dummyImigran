@extends('Layouts.main')
@section('title', 'Sarana Kesehatan | PMI')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">DAFTAR ADMIN</h4>
        <button  class="btn btn-primary rounded-0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" > <i class="fas fa-plus"></i> Tambah Data</button>
      </div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">DAFTAR ADMIN</h4>
          <div class="d-flex justify-content-between">
            <p class="card-title-desc">Berikut ini adalah Daftar ADMIN</p>
            <div>
              <a href="#" class="btn btn-danger btn-sm"  id="deleteAllSelectedRecord" style="display: none;"><i class="fas fa-trash mx-1"></i> Delete All</a>
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
                <th class="text-center">EMAIL</th>
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

  <!-- Modal -->
<div class="modal fade rounded-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-0">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH DATA ADMIN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.storeApi')}}" method="POST" id="addDataForm">
          @csrf
          <div class="col-lg-12 col-sm-12 col-12">
            <div class="form-group">
                <label>Email <span style="color: red">*</span> </label>
                <input type="text" class="form-control" placeholder="Email" name="email">
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-12">
          <div class="form-group">
              <label>Password <span style="color: red">*</span> </label>
              <input type="text" class="form-control" placeholder="Password" name="password">
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-plus"></i> Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>


<div class="modal fade " id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT DATA ADMIN</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="" id="editDataForm" method="POST">
              @csrf
              <input type="hidden" name="id" id="saranaId" value="">
              <div class="col-lg-12 col-sm-12 col-12">
                <div class="form-group">
                    <label>Email <span style="color: red">*</span> </label>
                    <input type="text" value="" class="form-control" id="email" placeholder="Email" name="email">
                </div>
            </div>
    
            <div class="col-lg-12 col-sm-12 col-12">
              <div class="form-group">
                  <label>Password <span style="color: red">*</span> </label>
                  <input type="text" value="" class="form-control" id="password" placeholder="Password" name="password">
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


<script>
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
         url: '/api/admin',
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
             var getUrlStore = "{{ url('users/store') }}";
             var deleteUrl = "{{ url('api/admin/delete')}}"
             var btn = `<div class="d-flex">
                          <button type="button" data-id="${row.id}" class="btn btn-warning btn-sm rounded-0 edit-button" data-bs-toggle="modal"  data-bs-target="#modalEdit">
                              <i class="fas fa-edit"></i>
                          </button>
                           
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
         { data: 'email' },
         { data: 'created_at' },
       
        
        
         
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
                url: "{{ route('admin.deleteAll')}}",
                type: 'DELETE',
                data: {
                    ids:all_ids,
                            _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $.each(all_ids, function(key,val) {
                        window.location.href = '/sarana-kesehatan';
                    })
                   
                        
                }
            })
                }
            })

           
        })
    })

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
                $('#exampleModal').modal('hide');
                $('#addDataForm')[0].reset();
                iziToast.success({
                  title: 'Sukses',
                        message: 'Data Added Successfully!!.',
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

        $(document).on('click', '.edit-button', function(e) {
        var saranaId = $(this).data("id");
        var formEdit = $('#editDataForm');
        var myUrl =  `/api/admin/update/${saranaId}`;
        $.ajax({
          url: `/api/admin/edit/${saranaId}`,
          method: "GET",
          dataType: "json",
          success: function(response) {
            console.log('inires', response)
            var saranaData = response.data

            $('#saranaId').val(saranaData.id)
            $('#email').val(saranaData.email)
            $('#password').val(saranaData.password)
            formEdit.attr('action', myUrl )
            $("#modalEdit").modal("show");
          },
          error: function(xhr,status,error) {
            console.error(xhr)
          }
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
@endsection