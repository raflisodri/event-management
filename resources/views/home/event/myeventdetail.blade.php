

<style>
body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .info-section {
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .info-section div {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>
    

    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet">
 
    <div class="modal-body">

        <div class="d-flex justify-content-end gap-1">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahpar">
                Tambah Partisipan
            </button>
    
            <a href="{{ route('event.print', ['id' => $acara->id]) }}"><button type="button" class="btn btn-primary float-end">Cetak</button></a>
        </div>

        <br>
        <div class="horizontal-table">
       
    <div class="card-header">Detail:</div>
    <div class="card-body">
        <table>
            <tr>
                <th>Judul Acara</th>
                <td>{{ $acara->judul }}</td>
            </tr>
            <tr>
                <th>Waktu Acara</th>
                <td>{{ \Carbon\Carbon::parse($acara->tgl_acara)->isoFormat('D MMMM Y') }} hingga {{ \Carbon\Carbon::parse($acara->wk_akhir)->format('h:i A') }}</td>
            </tr>
            <tr>
                <th>Reservasi Tutup Pada</th>
                <td>{{ \Carbon\Carbon::parse($acara->wk_res)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <th>Koordinator</th>
                <td>{{ $acara->User->name }}</td>
            </tr>
            <tr>
                <th>Tempat</th>
                <td>{{ $namaRuangString }}</td>
            </tr>
            <tr>
                <th>Deskripsi Acara</th>
                <td>{{ $acara->deskripsi }}</td>
            </tr>
            <tr>
                <th>Partisipan</th>
                <td>{{ $acara->participantCount }}</td>
            </tr>
        </table>
    </div>
   
        </div>    
    </div>
    
    <div class="card">
        <div class="card-header">Partisipan</div>
        <div class="card-body">
            @if($partisipan->isNotEmpty())
            <table id="tes" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partisipan as $p)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $p->User->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-icon btn-danger btnDelete" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Delete" data-id="{{$p->id}}">
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
            @else
                <p>Tidak ada partisipan untuk acara ini.</p>
            @endif
                    
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{route('event.index')}}"><button type="button" class="btn btn-secondary">Close</button></a>
    </div>

    <div class="modal fade" id="tambahpar" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <!-- Ubah action dengan URL yang benar untuk menyimpan partisipan -->
            <form action="{{route('event.partisipan.store')}}" class="modal-content" id="tambahpar" method="POST"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Tambah Partisipan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="idacara" class="form-label"> ID Acara </label>
                    <input type="text" id="idacara" name="acara_id" class="form-control" value="{{ $acara->id }}" readonly> <!-- idacara sebagai input hidden atau readonly -->
    
                    <label for="nameExLarge-par" class="form-label"> Partisipan </label>
                    <select class="select2 form-select" id="select2-multiple-par" multiple name="user_id[]">
                        <option label=" "></option>
                        @foreach($usersa as $singleUser)
                        <option value="{{ $singleUser->id }}">{{ $singleUser->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button> <!-- Tombol untuk submit form -->
                </div>
            </form>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.js"></script>
    
    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            $('#tes').DataTable({
                paging: true,
                searching: true,
                ordering: true, 
                lengthMenu: [10, 25, 50, 100]
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
                window.location.href= "{{ route('event.partisipan.delete', '') }}" + '/' + btnId;
            }
        });
    });
</script>
