@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('content')
<!-- Kick start -->
<ul class="timeline">
  <li class="timeline-item timeline-item-transparent">
    <span class="timeline-point timeline-point-success"></span>
    <div class="timeline-event">
      <div class="timeline-header mb-sm-0 mb-3">
        <h6 class="mb-0">Design Review</h6>
        <span class="text-muted">4th October</span>
      </div>
      <p>
        Weekly review of freshly prepared design for our new
        application.
      </p>
      <div class="d-flex justify-content-between">
        <h6>New Application</h6>
        <div class="d-flex">
          <div class="avatar avatar-xs me-2">
            {{-- <img src="https://th.bing.com/th/id/OIP.dcjqMa8x9r17LqdE5BfeZgHaFv?rs=1&pid=ImgDetMain" width="50px" height="45px"/> --}}
          </div>
          <div class="avatar avatar-xs">
            {{-- <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" /> --}}
          </div>
        </div>
      </div>
    </div>
  </li>
  <li class="timeline-item timeline-item-transparent">
    <span class="timeline-point timeline-point-danger"></span>
    <div class="timeline-event">
      <div class="timeline-header mb-sm-0 mb-3">
        <h6 class="mb-0">Design Review</h6>
        <span class="text-muted">4th October</span>
      </div>
      <p>
        Weekly review of freshly prepared design for our new
        application.
      </p>
      <div class="d-flex justify-content-between">
        <h6>New Application</h6>
        <div class="d-flex">
          <div class="avatar avatar-xs me-2">
            {{-- <img src="https://th.bing.com/th/id/OIP.dcjqMa8x9r17LqdE5BfeZgHaFv?rs=1&pid=ImgDetMain" width="50px" height="45px"/> --}}
          </div>
          <div class="avatar avatar-xs">
            {{-- <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" /> --}}
          </div>
        </div>
      </div>
    </div>
  </li>
  <li class="timeline-item timeline-item-transparent">
    <span class="timeline-point timeline-point-info"></span>
    <div class="timeline-event">
      <div class="timeline-header mb-sm-0 mb-3">
        <h6 class="mb-0">Design Review</h6>
        <span class="text-muted">4th October</span>
      </div>
      <p>
        Weekly review of freshly prepared design for our new
        application.
        
      </p>
      <div class="d-flex justify-content-between">
        <h6>New Application</h6>
        <div class="d-flex">
          <div class="avatar avatar-xs me-2">
            {{-- <img src="https://th.bing.com/th/id/OIP.dcjqMa8x9r17LqdE5BfeZgHaFv?rs=1&pid=ImgDetMain" width="50px" height="45px"/> --}}
          </div>
          <div class="avatar avatar-xs">
            {{-- <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" /> --}}
          </div>
        </div>
      </div>
    </div>
  </li>
 
</ul>

<!--/ Page layout -->
@endsection
