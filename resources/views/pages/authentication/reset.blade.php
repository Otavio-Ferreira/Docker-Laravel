@extends('templates.auth')

@section('content')
  <div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36"
            alt=""></a>
      </div>
      <form class="card card-md bg-transparent shadow-none border-0" action="{{ route('login.send') }}" method="post"
        autocomplete="off" novalidate>
        @csrf
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Esqueceu sua senha?</h2>
          <p class="text-muted mb-4">Digite seu endereço de email e um email de restauraçõa de senha será enviado para
            você</p>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Digite seu email"
              value="{{ old('email') }}" required>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
              <i class="icon ti ti-mail"></i>
              Enviar email
            </button>
          </div>

          @if ($errors->any())
            <div class="alert mt-3 alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
          @endif
          @foreach (['success', 'error', 'warning'] as $msg)
            @if (session($msg))
              <div
                class="alert mt-3 alert-{{ $msg == 'success' ? 'success' : ($msg == 'error' ? 'danger' : 'warning') }} alert-dismissible fade show"
                role="alert">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
              </div>
            @endif
          @endforeach

        </div>
      </form>
      <div class="text-center text-muted mt-3">
        Esquecer, <a href="{{ route('login') }}">me envie de volta</a> para a página de login.
      </div>
    </div>
  </div>
@endsection
