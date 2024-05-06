@extends('layouts/contentLayoutMaster')

@section('title', 'Halaman Ruang')

@section('content')

<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
<div class="card">
<div class="card-header">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">
    Tambah Data
</button>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table id="example" class="table table-hover table-striped table-row-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Tempat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ruangs as $index => $data) 
                <tr>
                    <td>{{ $index + 1 }}</td> 
                    <td>{{ $data->nama }}</td> 
                    <td>
                        @if($data->jenis == 'Indoor')
                        <span class="badge bg-warning bg-glow">Indoor</span>
                         @else
                        <span class="badge bg-success bg-glow">Outdoor</span>
                        @endif
                    </td>
                    <td>{{ $data->tempat }}</td> 
                    <td>        
                        <a class="btn btn-success btn-sm btn-icon editButton" aria-valuetext="{{ $data->id }}">
                            <span class="svg-icon svg-icon-light svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/>
                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/>
                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </a>
                        @if ($data->status == 1)
                        <a href="#" id="pauseButton" class="nonaktif btn btn-primary btn-sm btn-icon" data-id="{{ $data->id }}"  data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Nonaktifkan" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M14 19H18V5H14M6 19H10V5H6V19Z" fill="currentColor"/>
                            </svg>                            
                        </a>
                        @else                   
                        <a href="#" id="unpauseButton" class="aktif btn btn-secondary btn-sm btn-icon"  data-id="{{ $data->id }}"  data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Aktifkan">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="11.5" fill="#ECEFF1"/>
                                <path d="M9 18L15 12L9 6V18Z" fill="#37474F"/>
                            </svg>
                        </a>
                        @endif
                        <button type="button" class="btn btn-sm btn-icon btn-danger btnDelete" data-id="{{ $data->id }}" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Delete">
                            <span class="svg-icon svg-icon-light svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"/>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"/>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   
    
</div>
</div>

<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('ruang.store') }}" class="modal-content" id="formBackdrop" method="POST"> 
            @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Tambah Ruang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="nameBackdrop" class="form-label">Nama</label>
              <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name" name="nama">
              @error('nama')
                  <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-0">
                <label for="jenisSelect" class="form-label">Jenis</label>
                <select id="jenisSelect" class="select2 form-select" aria-label="Default select example" name="jenis">
                    <option selected>Pilih Jenis</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
                @error('jenis')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="col mb-0">
                <label for="tempatSelect" class="form-label">Tempat</label>
                <select id="tempatSelect" class="select2 form-select" aria-label="Default select example" name="tempat">
                    <option selected>Pilih Tempat</option>
                </select>
                @error('tempat')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button> <!-- Ubah type menjadi submit -->
        </div>
      </form>
    </div>
</div>

<div class="modal fade" id="editDropModal" tabindex="-1" aria-labelledby="editDropModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDropModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="response"></div>
 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.js"></script>
<script>
let table = new DataTable('#example', {
    paging: true,
    searching: true,
    ordering: true, 
    lengthMenu: [10, 25, 50, 100],
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('tambah'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('tambah') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif
@if(session('edit'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('edit') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif

@if(session('delete'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('delete') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif

@if(session('eror'))
    <script>
        Swal.fire({
            title: "Failed!",
            text: "{{ session('eror') }}",
            icon: "error",
            button: "OK",
        });
    </script>
@endif

@if(session('on'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('on') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif

@if(session('off'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('off') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif



<script>
    $('.nonaktif').on('click', function () {
        var btnId = $(this).data('id');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menonaktifkan ruang ini",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Iya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= "{{ route('ruang.off', '') }}" + '/' + btnId;
            }
        });
    });
</script>

<script>
    $('.aktif').on('click', function () {
        var btnId = $(this).data('id');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menaktifkan ruang ini",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Iya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= "{{ route('ruang.on', '') }}" + '/' + btnId;
            }
        });
    });
</script>


<script>
    $('.btnDelete').on('click', function () {
        var btnId = $(this).data('id');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus data ini, dan tidak dapat mengembalikanya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Iya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= "{{ route('ruang.destroy', '') }}" + '/' + btnId;
            }
        });
    });
</script>

<script>
$(document).ready(function() {

    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

    $('#jenisSelect').on('change', function() {

        $('#tempatSelect').empty();

        var jenis = $(this).val();

        if (jenis === 'Indoor') {
            $('#tempatSelect').append('<option selected>Pilih Tempat</option>');
            $('#tempatSelect').append('<optgroup label="Indoor">' +
                                          '<option value="Gedung A1">Gedung A1</option>' +
                                          '<option value="Gedung A2">Gedung A2</option>' +
                                          '<option value="Gedung B1">Gedung B1</option>' +
                                          '<option value="Gedung B2">Gedung B2</option>' +
                                          '<option value="Gedung C1">Gedung C1</option>' +
                                          '<option value="Gedung C2">Gedung C2</option>' +
                                          '<option value="Gedung D1">Gedung D1</option>' +
                                          '<option value="Gedung D2">Gedung D2</option>' +
                                      '</optgroup>');
        } else if (jenis === 'Outdoor') {
            $('#tempatSelect').append('<option selected>Pilih Tempat</option>');
            $('#tempatSelect').append('<optgroup label="Outdoor">' +
                                          '<option value="Belakang A1">Belakang A1</option>' +
                                          '<option value="Belakang B1">Belakang B1</option>' +
                                          '<option value="Belakang C1">Belakang C1</option>' +
                                          '<option value="Belakang D1">Belakang D1</option>' +
                                      '</optgroup>');
        } else {
            $('#tempatSelect').append('<option selected>Pilih Tempat</option>');
        }

        $('#tempatSelect').trigger('change.select2');
    });
});

</script>

<script>
        $('.editButton').on('click', function () {
            var btnId = $(this).attr('aria-valuetext');
            $.ajax({
                type: "GET",
                url: "{{ route('ruang.edit', '') }}" + '/' + btnId,
                success: function (response) {
                    $('.response').html(response);
                    $('#editDropModal').modal('show');
                }
            });
        });
</script>


@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection

@endsection