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
<div class="modal-body">
    <form  action="{{ route('event.update', $acara->id) }}" method="POST" id="formUpdate{{$acara->id}}">
    @csrf
    <div class="row">
      <div class="col-6 mb-3">
        <label for="nameExLarge-judul" class="form-label">Judul Acara</label>
        <input type="text" id="nameExLarge-judul" name="judul" class="form-control" placeholder="Enter Name" value="{{$acara->judul}}">
      </div>
      <div class="col-6 mb-3">
        <label for="tgl_acara" class="form-label">Tanggal Acara</label>
        <input type="date" id="tgl_acara" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="tgl_acara" value="{{$acara->tgl_acara}}">
    </div>
    </div> 
    <div class="row">
      <div class="col-4 mb-3">
        <label for="nameExLarge" class="form-label">Waktu Mulai Acara</label>
        <input type="text" name="wk_awal" id="fp-time" class="form-control flatpickr-time text-start" placeholder="HH:MM" value="{{$acara->wk_awal}}" />
      </div>
      <div class="col-4 mb-3">
        <label for="nameExLarge" class="form-label">Waktu Akhir Acara</label>
        <input type="text" name="wk_akhir" id="fp-time" class="form-control flatpickr-time text-start" placeholder="HH:MM" value="{{$acara->wk_akhir}}" />
      </div>
      <div class="col-4 mb-3">
        <label for="nameExLarge-koor-edit" class="form-label"> Koordinator </label>
        <select class="select2 w-100" id="vertical-modern-koor-edit" name="koordinator">
          <option label=" " value="{{$acara->user->id}}">{{$acara->user->name}}</option>
          @foreach($user as $singleUser)
          <option value="{{ $singleUser->id }}">{{ $singleUser->name }}</option>
          @endforeach
        </select>              
      </div>
    </div>
    <div class="row">
      <div class="col-6 mb-3">
        <label for="nameExLarge" class="form-label">Waktu Tutup Reservasi</label>
        <input type="date" id="wk_res" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="wk_res" value="{{$acara->wk_res}}">
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
      </div>  
    </div>
    <div class="row">
      <div class="col-12">
        <label class="form-label" for="fp-default">Deskripsi</label>
        <textarea name="deskripsi" id="vertical-modern-deskripsi" class="form-control"  name="deskripsi" placeholder="Masukan deskripsi" cols="5" rows="3"> {{$acara->deskripsi}}</textarea>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
  </div>
</form>

<script>
    $('.btn-submit').on('click', function(e) {
        // make swal moal? eh ku rafli weh etamah  awkwakwka :D
        $('#formUpdate{{$acara->id}}').submit();
    });
</script>
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

