@extends('layouts/contentLayoutMaster')

@section('title', 'Acara saya')

@section('content')

<div class="card">
<div class="card-header">

</div>
<div class="card-body">
  
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Waktu Acara</th>
                <th>Tutup Reservasi</th>
                <th>Reservasi</th>
                <th>partisipan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($acara as $index => $data)
          <tr>
            <td>{{$index + 1}}</td>
            <td>{{$data->judul}}</td>
            <td>{{ \Carbon\Carbon::parse($data->tgl_acara)->isoFormat('D MMMM Y') }} until {{ \Carbon\Carbon::parse($data->wk_akhir)->format('h:i A') }}</td>
            <td>{{ \Carbon\Carbon::parse($data->wk_res)->isoFormat('D MMMM Y') }}</td>
            <td align="center">
              @if ($data->wk_res < now()) 
                  <span class="badge bg-secondary">Reservation Closed</span>
              @elseif ($data->userParticipating)
                  <form action="{{ route('event.partisipan.hapus') }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="acara_id" value="{{ $data->id }}">
                      <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Tidak Ikuti">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                              <path d="M3.5 3.5l9 9m0-9l-9 9" stroke="currentColor" fill="none"/>
                          </svg>
                      </button>
                  </form>
              @else
                  <form action="{{ route('event.partisipan.tambah') }}" method="post">
                      @csrf
                      <input type="hidden" name="acara_id" value="{{ $data->id }}">
                      <button type="submit" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Ikuti">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                              <path d="M3.5 9.5l3.5 3.5L13.5 4" stroke="currentColor" fill="none"/>
                          </svg>
                      </button>
                  </form>
              @endif
          </td>          
            <td> 
              <span class="badge bg-info bg-glow">Total partisipan : {{$data->participantCount}} </span>
            </td>
            <td class="d-flex gap-1 py-3">
              <a class="btn btn-sm btn-icon btn-primary btn-my-detail" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Detail" aria-valuetext="{{ $data->id }}">
                <span class="svg-icon svg-icon-light svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/>
                    </svg>
                </span>
            </a>
            <a class="btn btn-success btn-sm btn-icon editButton" aria-valuetext="{{ $data->id }}">
              <span class="svg-icon svg-icon-light svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
<!-- Modal Detail -->
<div class="modal fade" id="detailMyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail data My Event</h5>
        <a href="{{route('event.myevents')}}"><button type="button" class="btn-close"></button></a>
      </div>
      <div class="modal-body">
        <div class="response-detail"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit data Event</h5>
        <a href="{{route('event.index')}}"><button type="button" class="btn-close"></button></a>
      </div>
      <div class="modal-body">
        <div class="response-edit"></div>
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
              window.location.href= "{{ route('event.delete', '') }}" + '/' + btnId;
          }
      });
  });
</script>

<script>
$('.btn-my-detail').on('click', function () {
  var btnId = $(this).attr('aria-valuetext');
  $.ajax({
    type: "GET",
    url: "{{ route('event.mydetail', '') }}" + '/' + btnId,
    success: function (response) {
      $('.response-detail').html(response); // Tempatkan pada elemen yang benar
      $('#detailMyModal').modal('show');
    }
  });
});

$('.editButton').on('click', function () {
  console.log("Button clicked!");
  var btnId = $(this).attr('aria-valuetext');
  $.ajax({
    type: "GET",
    url: "{{ route('event.edit', '') }}" + '/' + btnId,
    success: function (response) {
      $('.response-edit').html(response); // Tempatkan pada elemen yang benar
      $('#editModal').modal('show');
    }
  });
});
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('partisipanForm').addEventListener('submit', function(event) {
          event.preventDefault();
          fetch(this.getAttribute('action'), {
              method: 'POST',
              body: new FormData(this),
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
          }).then(response => {
              if (response.ok) {
                  return response.json();
              }
              throw new Error('Ada masalah dengan permintaan Anda.');
          }).then(data => {
              console.log(data);
              alert('Anda berhasil bergabung sebagai partisipan.');
          }).catch(error => {
              console.error('Ada kesalahan:', error);
              alert('Terjadi kesalahan. Silakan coba lagi.');
          });
      });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
      flatpickr('.flatpickr-basic', {
          dateFormat: "d F Y",
      });
  });
</script>

<script>
  document.getElementById("tgl_acara").addEventListener("change", function() {
      var wk_res_input = document.getElementById("wk_res");

      if (this.value !== "") {
          wk_res_input.removeAttribute("disabled");
      } else {
          wk_res_input.setAttribute("disabled", "disabled");
          wk_res_input.value = ""; 
      }
  });

  document.getElementById("wk_res").addEventListener("change", function() {
      var tgl_acara = new Date(document.getElementById("tgl_acara").value);
      var wk_res = new Date(this.value); 

      if (wk_res >= tgl_acara) {
    Swal.fire({
        title: "Tanggal Tidak Sesuai!",
        text: "Anda hanya dapat memilih tanggal sebelum tanggal acara",
        icon: "info",
        button: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            this.value = "";
        }
    });
  }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('ikuti'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('ikuti') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif
@if(session('tidak'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('tidak') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif
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

@endsection