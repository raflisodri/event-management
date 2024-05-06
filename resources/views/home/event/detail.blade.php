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

<div class="card">
    <div class="card-header">Partisipan</div>
    <div class="card-body">
        @if($partisipan->isNotEmpty())
        <table id="tes" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partisipan as $p)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $p->User->name }}</td>
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