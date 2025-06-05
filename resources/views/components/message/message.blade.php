@if (session()->has('success') || session()->has('error') || session()->has('warning') || $errors->any())
  <div
    class="mt-3 alert alert-{{ session()->has('success') ? 'success' : (session()->has('error') ? 'danger' : 'warning') }} alert-dismissible fade show"
    role="alert">
    {{ session('success') ? session('success') : (session('error') ? session('error') : session('warning')) }}

    @if ($errors->any())
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
