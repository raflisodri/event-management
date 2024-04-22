@extends('layouts/contentLayoutMaster')

@section('title', 'Halaman Karyawan')

@section('content')

<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-qozQg2XN/MWcofY26I/ugiIOg0BU9a5AdbW07O+d+J1V90Fs0AIJ0Ex/+jBxLImCJfjz8Xv7KGEfpfWfRlcEig==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="card">

<div class="card-header">

<a href="{{route('karyawan.tambah')}}">
<button class="btn btn-primary" >Tambah Data</button>
</a>
</div>
<div class="card-body">
    <div class="table-responsive">
        <div class="container">
            <table id="example" class="table table-hover table-striped table-row-bordered text-center" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nik</th>
                        <th>Gender</th>
                        <th>Mulai kontrak</th>
                        <th>Selesai kontrak</th>
                        <th>Unit Bisnis</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawan as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>
                            @if($data->gender == 'pria')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 20px; height: 20px;">
                                <path d="M289.8 46.8c3.7-9 12.5-14.8 22.2-14.8H424c13.3 0 24 10.7 24 24V168c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L321 204.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176S0 401.2 0 304s78.8-176 176-176c37 0 71.4 11.4 99.8 31l52.6-52.6L295 73c-6.9-6.9-8.9-17.2-5.2-26.2zM400 80l0 0h0v0zM176 416a112 112 0 1 0 0-224 112 112 0 1 0 0 224z" fill="blue"/>
                            </svg>                            
                            @elseif($data->gender == 'wanita')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 20px; height: 20px;">
                                <path d="M80 176a112 112 0 1 1 224 0A112 112 0 1 1 80 176zM224 349.1c81.9-15 144-86.8 144-173.1C368 78.8 289.2 0 192 0S16 78.8 16 176c0 86.3 62.1 158.1 144 173.1V384H128c-17.7 0-32 14.3-32 32s14.3 32 32 32h32v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H224V349.1z" fill="pink"/>
                            </svg>
                            @else
                                {{ $data->gender }}
                            @endif
                        </td>
                      
                        <td>{{ \Carbon\Carbon::parse($data->mulai_kontrak)->format('d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->selesai_kontrak)->format('d F Y') }}</td>                        
                        <td align="center">
                            @php
                                $unitBisnis = $data->unit_bisnis;
                                $badgeColor = '';
                                $unitLabels = [
                                    '1' => 'KII',
                                    '3' => 'KAN',
                                    '4' => 'Kurasi',
                                    '5' => 'KC'
                                ];
                                
                                if(isset($unitLabels[$unitBisnis])) {
                                    $badgeLabel = $unitLabels[$unitBisnis];
                                } else {
                                    $badgeLabel = $unitBisnis;
                                }
                                
                                if($unitBisnis == '1') {
                                    $badgeColor = 'bg-danger';
                                } elseif($unitBisnis == '3') {
                                    $badgeColor = 'bg-info';
                                } elseif($unitBisnis == '4') {
                                    $badgeColor = 'bg-primary';
                                } elseif($unitBisnis == '5') {
                                    $badgeColor = 'bg-warning';
                                }
                            @endphp
                        
                            <span class="badge {{ $badgeColor }} bg-glow">{{ $badgeLabel }}</span>
                        </td>
                        <td>{{ $data->email }}</td>                    
                        <td>{{ $data->jabatan }}</td>
                        <td class="d-flex gap-1 py-2">
                        <a class="btn btn-sm btn-icon btn-success btn-edit" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Edit" onclick="window.location='{{ route('karyawan.edit', $data->id) }}'" >
                            <span class="svg-icon svg-icon-light svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/>
                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/>
                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </a>
                        <button type="button" class="btn btn-sm btn-icon btn-danger btnDelete" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Delete" data-id="{{$data->id}}">
                            <span class="svg-icon svg-icon-light svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
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
</div>

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

<script>
    $(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    function refreshTooltip() {
        $('[data-bs-toggle="tooltip"]').tooltip('dispose'); 
        $('[data-bs-toggle="tooltip"]').tooltip(); 
    }
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
                window.location.href= "{{ route('karyawan.destroy', '') }}" + '/' + btnId;
            }
        });
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


@endsection