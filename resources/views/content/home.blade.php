@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('content')

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

<style>
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transisi untuk animasi */
}

.card:hover {
    transform: translateY(-5px); /* Sedikit naik saat di-hover */
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2); /* Bayangan lebih kuat saat di-hover */
}

</style>

<div class="container"> <!-- Menjaga konten dalam batasan -->
  <div class="row row-cols-6 row-cols-md-4 g-6"> <!-- Membuat jarak antar kolom lebih rapat -->
    @foreach ($koordinators as $koordinator)
    <div class="col"> <!-- Kolom untuk setiap card -->
      <div class="card text-center w-100"> <!-- Pastikan card memenuhi kolom -->
        <div class="card-body p-6"> <!-- Tambahkan padding untuk jarak -->
          <!-- Gambar Koordinator -->
          <img class="rounded-circle border" src="{{ asset('uploads/foto/' . $koordinator->foto) }}" alt="Card image cap" style="width: 100px; height: 100px; object-fit: cover;" />

          <!-- Jumlah Acara -->
          <h2 class="fw-bolder mt-3">{{ $koordinator->acara_count }} Acara</h2> <!-- Tambahkan margin-top -->
          
          <!-- Nama Koordinator -->
          <p class="card-text">{{ $koordinator->name }}</p>
        </div> <!-- Tutup card-body -->
      </div> <!-- Tutup card -->
    </div> <!-- Tutup kolom -->
    @endforeach
  </div> <!-- Tutup row -->
</div> <!-- Tutup container -->

{{-- <div class="col-xl-2 col-md-4 col-sm-6">
  @foreach ($koordinators as $koordinator)
  <div class="card text-center">
    <div class="card-body">
      <img class="card-img-top" src="{{ asset('uploads/foto/' . $koordinator->foto) }}" alt="Card image cap" width="100" height="250" />
        <div class="avatar-content">
          <i data-feather="eye" class="font-medium-5"></i>
        </div>
      </div>
      <h2 class="fw-bolder">{{ $koordinator->acara_count }} Acara</h2>
      <p class="card-text">{{ $koordinator->name }}</p>
    </div>
  </div>
  @endforeach
</div> --}}

{{-- <div class="card"> <!-- Wrapper utama -->
  <div class="card-body">
    <!-- Bagian yang menampilkan top movers -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach ($koordinators as $koordinator)
      <div class="col">
        <div class="card h-100"> <!-- Efek hover berlaku pada seluruh card -->
          <!-- Gambar Koordinator -->
          <img class="card-img-top" src="{{ asset('uploads/foto/' . $koordinator->foto) }}" alt="Card image cap" width="100" height="250" />
    
          <div class="card-body">
            <!-- Nama Koordinator -->
            <h5 class="card-title">{{ $koordinator->name }}</h5>
    
            <!-- Jumlah Acara -->
            <p class="card-text">{{ $koordinator->acara_count }} Acara</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  
  </div>
</div> --}}

<div class="card" style="padding: 50px">
  <form method="GET" action="{{ route('index') }}" style="display: flex; flex-direction: column; gap: 10px;">
    <label for="bulan-select">Pilih Bulan:</label>
    <select class="select2 w-100" id="bulan-select" name="bulan" style="width: 100%;">
        @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ $i == $bulanDipilih ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
        @endfor
    </select>
    <button type="submit" class="btn btn-primary">Lihat</button>
</form>

  <canvas id="myChart" width="400" height="200"></canvas>
  <!-- Menambahkan konten tambahan -->
  <div class="row mt-4"> <!-- Memberikan jarak atas -->
    <div class="col-12"> <!-- Card baru untuk diagram donut -->
    </div>
  </div>
</div>
  <br>

<!-- Kick start -->
<div class="card" style="padding: 50px">
  <div class="timeline">
    @foreach ($acara as $item)
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div class="timeline-event">
                <div class="timeline-header mb-sm-0 mb-3">
                    <!-- Judul Acara -->
                    <h6 class="mb-0">{{ $item->judul }}</h6>
                    <!-- Tanggal Acara -->
                    <span class="text-muted">{{ $item->tgl_acara }}</span>
                </div>
                <!-- Deskripsi -->
                <p>{{ $item->deskripsi }}</p>
                <div class="d-flex justify-content-between">
                    <!-- Waktu atau informasi tambahan -->
                    <h6>{{ $item->wk_res }}</h6>
                    <div class="d-flex">
                        <div class="avatar avatar-xs me-2">
                            <!-- Avatar atau gambar tambahan -->
                            {{-- <img src="https://th.bing.com/th/id/OIP.dcjqMa8x9r17LqdE5BfeZgHaFv?rs=1&pid=ImgDetMain" width="50px" height="45px" /> --}}
                        </div>
                        <div class="avatar avatar-xs">
                            {{-- <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
  </div>
</div>

<!--/ Page layout -->
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/charts/chart-chartjs.js')) }}"></script>
@endsection

<script>
  $(document).ready(function() {
      $('.select2').select2({
          placeholder: "Pilih bulan",
          allowClear: true,
          width: 'resolve' // Menggunakan lebar penuh
      });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 var acaraPerMinggu = @json($acaraPerMinggu);

var labels = acaraPerMinggu.map(a => 'Minggu ' + a.minggu);
var data = acaraPerMinggu.map(a => a.jumlah_acara);

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Acara per Minggu',
            data: data,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

  // Mendapatkan data acara per minggu dan bulan
var acaraPerBulanMinggu = @json($acaraPerBulanMinggu);

// Membuat label untuk sumbu X dengan format 'Bulan - Minggu'
var labels = acaraPerBulanMinggu.map(a => 'Bulan ' + a.bulan + ' - Minggu ' + a.minggu);
var data = acaraPerBulanMinggu.map(a => a.jumlah_acara);

// Membuat grafik
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // Grafik batang
    data: {
        labels: labels, // Label untuk sumbu X
        datasets: [{
            label: 'Jumlah Acara per Minggu dan Bulan',
            data: data, // Data untuk sumbu Y
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                ticks: {
                    autoSkip: false // Untuk memastikan semua label terlihat
                }
            },
            y: {
                beginAtZero: true // Memastikan grafik dimulai dari 0
            }
        }
    }
});
</script>


@endsection
