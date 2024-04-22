<style>
.horizontal-table {
    display: flex;
    flex-direction: row;
    overflow-x: auto;
}

.event-details {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.event-details div {
    margin-bottom: 5px;
}

.event-details div strong {
    margin-right: 5px;
}

#tes th,
#tes td {
    text-align: left;
}

</style>

<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet">

<div class="modal-body">
    <div class="horizontal-table">
        <div class="event-details"> 
            <div><strong>ID Acara:</strong> {{$acara->id}} </div>
            <div><strong>Judul Acara:</strong> {{$acara->judul}}</div>
            <div><strong>Waktu Acara:</strong> {{ \Carbon\Carbon::parse($acara->tgl_acara)->isoFormat('D MMMM Y') }} until {{ \Carbon\Carbon::parse($acara->wk_akhir)->format('h:i A') }}</div>
            <div><strong>Reservasi tutup pada:</strong> {{ \Carbon\Carbon::parse($acara->wk_res)->isoFormat('D MMMM Y') }} </div>
            <div><strong>Koordinator:</strong> {{$acara->User->name}} </div>
            <div><strong>Tempat:</strong> {{$namaRuangString}} </div>
            <div><strong>Deskripsi Acara:</strong> {{$acara->deskripsi}} </div>
            <div><strong>Partisipan:</strong> {{ $acara->participantCount }}</div>
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