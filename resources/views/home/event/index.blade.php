@extends('layouts/contentLayoutMaster')

@section('title', 'Acara')

@section('content')

<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet">

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">
@endsection

@section('page-style')
  <!-- Page css files --> 
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
 
@endsection

<div class="card">
<div class="card-header">

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
    Tambah data
</button>
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
              @if ($data->wk_res < now()) <!-- Jika waktu reservasi sudah ditutup -->
                  <span class="badge bg-secondary">Reservation Closed</span>
              @elseif ($data->userParticipating)
                  <!-- Jika pengguna sudah bergabung -->
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
            <td>
              <a class="btn btn-sm btn-icon btn-primary btn-detail" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Detail" aria-valuetext="{{ $data->id }}">
                <span class="svg-icon svg-icon-light svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/>
                    </svg>
                </span>
            </a>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Tambah data Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('event.store')}}" method="POST">
          @csrf
          <div class="row">
            <div class="col-6 mb-3">
              <label for="nameExLarge-judul" class="form-label">Judul Acara</label>
              <input type="text" id="nameExLarge-judul" name="judul" class="form-control" placeholder="Enter Name">
              @error('judul')
              <div class="text-danger">{{$message}}</div>
             @enderror
            </div>
            <div class="col-6 mb-3">
              <label for="tgl_acara" class="form-label">Tanggal Acara</label>
              <input type="date" id="tgl_acara" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="tgl_acara">
              @error('tgl_acara')
              <div class="text-danger">{{$message}}</div>
              @enderror
          </div>
          </div> 
          <div class="row">
            <div class="col-4 mb-3">
              <label for="nameExLarge" class="form-label">Waktu Mulai Acara</label>
              <input type="text" name="wk_awal" id="fp-time" class="form-control flatpickr-time text-start" placeholder="HH:MM" />
              @error('wk_awal')
              <div class="text-danger">{{$message}}</div>
          @enderror
            </div>
            <div class="col-4 mb-3">
              <label for="nameExLarge" class="form-label">Waktu Akhir Acara</label>
              <input type="text" name="wk_akhir" id="fp-time" class="form-control flatpickr-time text-start" placeholder="HH:MM" />
              @error('wk_akhir')
              <div class="text-danger">{{$message}}</div>
          @enderror
            </div>
            <div class="col-4 mb-3">
              <label for="nameExLarge-koor" class="form-label"> Koordinator </label>
              <select class="select2 w-100" id="vertical-modern-koor" name="koordinator" id="">
                <option label=" "></option>
                @foreach($user as $singleUser)
                <option value="{{ $singleUser->id }}">{{ $singleUser->name }}</option>
                @endforeach
              </select>              
            </div>
            @error('koordinator')
            <div class="text-danger">{{$message}}</div>
        @enderror
          </div>
          <div class="row">
            <div class="col-6 mb-3">
              <label for="nameExLarge" class="form-label">Waktu Tutup Reservasi</label>
              <input type="date" id="wk_res" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="wk_res" disabled>
              @error('wk_res')
              <div class="text-danger">{{$message}}</div>
          @enderror
            </div>   
            <div class="col-6 mb-3">
              <label for="nameExLarge" class="form-label">Tempat Acara</label>
              <select class="select2 form-select" id="select2-multiple" multiple name="tempat[]">
                <option label=" "></option>
                @foreach($ruang as $singleRuang)
                <option value="{{ $singleRuang->id }}">{{ $singleRuang->nama }}</option>
                @endforeach
              </select>
              {{-- <input type="text" name="tp_acara" id="nameExLarge-tp" class="form-control" placeholder="Enter Name"> --}}
              @error('tempat[]')
              <div class="text-danger">{{$message}}</div>
          @enderror
            </div>  
          </div>
          <div class="row">
            <div class="col-12">
              <label class="form-label" for="fp-default">Deskripsi</label>
              <textarea name="deskripsi" id="vertical-modern-deskripsi" class="form-control"  name="deskripsi" placeholder="Masukan deskripsi" cols="5" rows="3"></textarea>
            </div>
            @error('deskripsi')
            <div class="text-danger">{{$message}}</div>
        @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
          
      </div>
    </div>
  </div>

  <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Detail data Event</h5>
          <a href="{{route('event.index')}}"><button type="button" class="btn-close"></button></a>
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

<script>
  $('.btn-detail').on('click', function () {
      var btnId = $(this).attr('aria-valuetext');
      $.ajax({
          type: "GET",
          url: "{{ route('event.detail', '') }}" + '/' + btnId,
          success: function (response) {
              $('.response').html(response);
              $('#detailModal').modal('show');
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



@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
@endsection


@endsection