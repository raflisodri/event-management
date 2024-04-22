<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
    <form action="{{ route('ruang.update', $ruang->id) }}" method="POST">
        @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama</label>
                        <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name" name="nama" value="{{$ruang->nama}}">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="jenisSelect1" class="form-label">Jenis</label>
                        <select id="jenisSelect1" class="select2 form-select" aria-label="Default select example" name="jenis">
                            <option selected>Pilih Jenis</option>
                            <option value="Indoor">Indoor</option>
                            <option value="Outdoor">Outdoor</option>
                        </select>
                    </div>

                    <div class="col mb-0">
                        <label for="tempatSelect1" class="form-label">Tempat</label>
                        <select id="tempatSelect1" class="select2 form-select" aria-label="Default select example" name="tempat">
                            <option selected>Pilih Tempat</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
            </div>
    </form>
           
    <script>
        $(document).ready(function() {
        
            $('.select2').select2({
                minimumResultsForSearch: Infinity
            });
        
            $('#jenisSelect1').on('change', function() {
        
                $('#tempatSelect1').empty();
        
                var jenis = $(this).val();
        
                if (jenis === 'Indoor') {
                    $('#tempatSelect1').append('<option selected>Pilih Tempat</option>');
                    $('#tempatSelect1').append('<optgroup label="Indoor">' +
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
                    $('#tempatSelect1').append('<option selected>Pilih Tempat</option>');
                    $('#tempatSelect1').append('<optgroup label="Outdoor">' +
                                                  '<option value="Belakang A1">Belakang A1</option>' +
                                                  '<option value="Belakang A1">Belakang B1</option>' +
                                                  '<option value="Belakang A1">Belakang C1</option>' +
                                                  '<option value="Belakang A1">Belakang D1</option>' +
                                              '</optgroup>');
                } else {
                    $('#tempatSelect').append('<option selected>Pilih Tempat</option>');
                }
        
                $('#tempatSelect').trigger('change.select2');
            });
        });
        
        </script>
        @section('vendor-script')
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
      @endsection
      @section('page-script')
        <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
      @endsection
      