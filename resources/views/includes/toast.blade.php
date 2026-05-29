@if(session('success'))
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast bg-success text-white">
      <div class="toast-body">
        {{ session('success') }}
      </div>
    </div>
  </div>
@endif

@if(session('error'))
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast bg-danger text-white">
      <div class="toast-body">
        {{ session('error') }}
      </div>
    </div>
  </div>
@endif