@extends('layouts/contentLayoutMaster')

@section('title', 'Tambah data Karyawan')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
 
@endsection
<div class="card">
  
  <div class="card-body">
    <form id="tambahForm" method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data"  autocomplete="off">
      @csrf
    <section class="modern-vertical-wizard">
      <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
        <div class="bs-stepper-header">
          <div
            class="step"
            data-target="#account-details-vertical-modern"
            role="tab"
            id="account-details-vertical-modern-trigger"
          >
            <button type="button" class="step-trigger">
              <span class="bs-stepper-box">
                <i data-feather="file-text" class="font-medium-3"></i>
              </span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Account Details</span>
                <span class="bs-stepper-subtitle">Setup Account Details</span>
              </span>
            </button>
          </div>
          <div
            class="step"
            data-target="#personal-info-vertical-modern"
            role="tab"
            id="personal-info-vertical-modern-trigger"
          >
            <button type="button" class="step-trigger">
              <span class="bs-stepper-box">
                <i data-feather="user" class="font-medium-3"></i>
              </span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Personal Info</span>
                <span class="bs-stepper-subtitle">Add Personal Info</span>
              </span>
            </button>
          </div>
          <div
            class="step"
            data-target="#social-links-vertical-modern"
            role="tab"
            id="social-links-vertical-modern-trigger"
          >
            <button type="button" class="step-trigger">
              <span class="bs-stepper-box">
                <i data-feather="link" class="font-medium-3"></i>
              </span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Emergency Info</span>
                <span class="bs-stepper-subtitle">Add Emergency info</span>
              </span>
            </button>
          </div>
        </div>
        <div class="bs-stepper-content">
          <div
            id="account-details-vertical-modern"
            class="content"
            role="tabpanel"
            aria-labelledby="account-details-vertical-modern-trigger"
          >
            <div class="content-header">
              <h5 class="mb-0">Account Details</h5>
              <small class="text-muted">Enter Your Account Details.</small>
            </div>
            <div class="row align-items-center">
              <div class="col-3">
                  <a href="#" class="me-3">
                      <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" id="account-upload-img" class="uploadedAvatar rounded" alt="profile image" height="100" width="100" />
                  </a>
              </div>
              <div class="col-6 mt-5">
                  <div class="mt-10 mb-3">
                      <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                      <input type="file" id="account-upload" name="foto" hidden accept="image/*" />
                      <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                      <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                  </div>
              </div>
          </div>
                 
            <div class="row">
              <div class="mb-1 col-md-6">
                <label class="form-label" for="vertical-modern-nama-emergency">Nama</label>
                <input type="text" id="vertical-modern-nama-emergency" class="form-control" placeholder="Masukan Nama" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror            
            </div>
              <div class="mb-1 col-md-6">
                <label class="form-label" for="vertical-modern-email">Email</label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Masukan Email"
                  name="email"
                />
                @error('email')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror  
              </div>
            </div>
              <div class="row">
                <div class="mb-1 form-password-toggle col-md-6">
                  <label class="form-label" for="vertical-modern-password">Password</label>               
                  <div class="input-group">
                    <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2"/>
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    @error('password')
                    <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
                   @enderror  
                  </div>
                </div>
                <div class="mb-1 col-md-6">
                  <label class="form-label" for="fp-defaultmk">Mulai kontrak</label>
                  <input type="date" id="fp-defaultmk" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" / name="mulai_kontrak">
                  @error('mulai_kontrak')
                  <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
                 @enderror  
                </div>
              </div>
            <div class="row">
              <div class="mb-1 col-md-6">
                <label class="form-label" for="fp-defaultsk">Selesai kontrak</label>
                <input type="date" id="fp-defaultsk" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" / name="selesai_kontrak">
                @error('selesai_kontrak')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror  
              </div>
              <div class="mb-1 col-md-6">
                <label class="form-label" for="vertical-modern-country">Unit bisnis</label>
                <select class="select2 w-100" id="vertical-modern-country" name="unit_bisnis">
                    <option label=" "></option>
                    @foreach($unit as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
                @error('unit_bisnis')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
                @enderror  
            </div>            
            </div>
            <div class="row">
              <div class="mb-1 col-md-12">
                <label class="form-label" for="vertical-modern-country">Jabatan</label>
                <select class="select2 w-100" id="jabatan" name="jabatan">
                  <option label=" "></option>
                  <option value="direksi">Direksi</option>
                  <option value="manager">Manager</option>
                  <option value="staff">Staff</option>
                  <option value="substaff">Substaff</option>
                </select>
                @error('jabatan')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
            </div>
           
          </div>
          <div
            id="personal-info-vertical-modern"
            class="content"
            role="tabpanel"
            aria-labelledby="personal-info-vertical-modern-trigger"
          >
            <div class="content-header">
              <h5 class="mb-0">Personal Info</h5>
              <small>Enter Your Personal Info.</small>
            </div>
            <div class="row">
              <div class="mb-1 col-md-6">
                <label class="form-label" for="fp-default">NIK</label>
                <input type="text" id="vertical-modern-username-nik" class="form-control" placeholder="Masukan Nik" name="nik">
                @error('nik')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
              <div class="mb-1 col-md-6">
                <label class="form-label" for="fp-default">No Telpon</label>
                <input type="text" id="vertical-modern-username-telp" class="form-control" placeholder="Masukan No telp" name="no_telp" maxlength="15">
                @error('no_telp')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
            </div>
            <div class="row">
              <div class="mb-1 col-md-6">
                <label class="form-label" for="vertical-modern-country">Gender</label>
                <select class="select2 w-100" id="gender" name="gender">
                  <option label=" "></option>
                  <option value="pria">Pria</option>
                  <option value="wanita">Wanita</option>
                </select>
                @error('gender')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
              <div class="mb-1 col-md-6">
                <label class="form-label" for="vertical-modern-country">Status</label>
                <select class="select2 w-100" id="status" name="status">
                  <option label=" "></option>
                  <option value="menikah">Menikah</option>
                  <option value="belum_menikah">Belum Menikah</option>
                </select>
                @error('status')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <label class="form-label" for="fp-default">Alamat</label>
                <textarea name="alamat" id="vertical-modern-alamat" class="form-control"  name="alamat" placeholder="Masukan alamat" cols="5" rows="3"></textarea>
                @error('alamat')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
            </div>
       
       <br>
          
          </div>
          <div
            id="social-links-vertical-modern"
            class="content"
            role="tabpanel"
            aria-labelledby="social-links-vertical-modern-trigger"
          >
            <div class="content-header">
              <h5 class="mb-0">Emergency Info</h5>
              <small>Enter Your Emergency Info.</small>
            </div>
            <div class="row">
              <div class="mb-1 col-md-6">
                <label class="form-label" for="fp-default">Nama</label>
                <input type="text" id="vertical-modern-username" class="form-control" placeholder="Masukan Nama Emergency" / name="nama_emergency">
                @error('nama_emergency')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
              <div class="mb-1 col-md-6">
                <label class="form-label" for="vertical-modern-country">Hubungan</label>
                <select class="select2 w-100" id="hubungan" name="hubungan">
                  <option label=" "></option>
                  <option value="orang_tua">Orang tua</option>
                  <option value="suami/istri">Suami/istri</option>
                  <option value="saudara/saudari">Saudara/saudari</option>
                  <option value="anak">Anak</option>
                </select>
                @error('hubungan')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
              </div>
            </div>
            <div class="row">
              <div class="mb-1 col-md-12">
                <label class="form-label" for="vertical-modern-no-telp-emergency">No Telpon</label>
                <input type="text" id="vertical-modern-no-telp-emergency" class="form-control" placeholder="Masukan No telp" name="no_telp_emergency" maxlength="15">
                @error('no_telp_emergency')
                <div class="alert alert-danger my-2 py-1" role="alert" style="text-align: center">{{ $message }}</div>
               @enderror 
            </div>
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-success" data-action="submit">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    </form>
  </div>
</div>


<script>
  document.getElementById('account-upload').addEventListener('change', function(event) {
      var file = event.target.files[0];
      if (file) {
          var reader = new FileReader();
          reader.onload = function(e) {
              document.getElementById('account-upload-img').src = e.target.result;
          }
          reader.readAsDataURL(file);
      }
  });

  document.getElementById('account-reset').addEventListener('click', function() {
      document.getElementById('account-upload-img').src = "{{ asset('images/portrait/small/avatar-s-11.jpg') }}";
  });
</script>

<script>
  setTimeout(function() {
      document.querySelectorAll('.alert').forEach(function(alert) {
          alert.remove(); 
      });
  }, 8000); 
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

</script>
@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings-account.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings-account.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
@endsection

@endsection