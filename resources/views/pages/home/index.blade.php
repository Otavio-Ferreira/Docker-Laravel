@extends('templates.template')

@section('styles')
@endsection
@section('content')
  <div class="page-header">
    <div class="">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
            <a href="{{ route('home.index') }}">Home</a>
          </div>
          <h2 class="page-title">
            Home
          </h2>
        </div>
        <div class="col-auto ms-auto">
        </div>
      </div>
    </div>
  </div>
  <div class="page-body row">
    <div class="col-sm-12 col-md-7">
      <div class="card">
        <div class="card-body pt-4 pb-5">
          <div class="row gy-3">
            <div class="col-12 col-sm d-flex flex-column">
              <h3 class="h2">Bem vindo, {{ $user->name }}</h3>
              @if (session('last_login_temp'))
                <p class="text-muted">Seu último login foi em {{ date('d/m/Y', strtotime(session('last_login_temp'))) }}
                  às
                  {{ date('H:i:s', strtotime(session('last_login_temp'))) }}</p>
              @else
                <p class="text-muted">Seu último login foi em {{ date('d/m/Y', strtotime($user->last_login_at)) }}
                  às
                  {{ date('H:i:s', strtotime($user->last_login_at)) }}</p>
              @endif
            </div>
            <div class="col-12 col-sm-auto d-flex justify-content-center">
              <img src="{{ asset('assets/img/illustrations/welcome_back.svg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">Perfil Atualizado há</div>
          </div>
          <div class="h1 mb-3">{{ $user->updated_at->diffForHumans() }}</div>
          <div class="d-flex mb-2">
            <div>Nível de segurança do perfil</div>
            <div class="ms-auto">
              <span
                class="d-inline-flex align-items-center lh-1
                {{ $user->updated_at->diffInMonths() < 2 ? 'text-green' : ($user->updated_at->diffInMonths() < 4 ? 'text-warning' : 'text-danger') }}
              ">
                {{ $progress }}
              </span>
            </div>
          </div>
          <div class="progress progress-sm">
            <div
              class="progress-bar {{ $user->updated_at->diffInMonths() < 2 ? 'bg-green' : ($user->updated_at->diffInMonths() < 4 ? 'bg-warning' : 'bg-danger') }}"
              style="width: {{ $progress }}" role="progressbar" aria-valuemin="0" aria-valuemax="100">
              <span class="visually-hidden">{{ $progress }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="h1 mb-0">Perfil {{ $profile < 100 ? 'Incompleto' : 'Completo' }}</div>
            <a class="btn btn-sm btn-primary rounded-2" id="sales-dropdown"
              href="{{ route('profile.index') }}">{{ $profile < 100 ? 'Completar perfil' : 'Acessar perfil' }}</a>
          </div>
          <div class="d-flex mb-2">
            <div>Quantidade completa</div>
            <div class="ms-auto">
              <span
                class="d-inline-flex align-items-center lh-1
                {{ $profile == 100 ? 'text-green' : ($profile > 60 ? 'text-warning' : 'text-danger') }}
              ">
                {{ $profile }}%
              </span>
            </div>
          </div>
          <div class="progress progress-sm">
            <div class="progress-bar {{ $profile == 100 ? 'bg-green' : ($profile > 60 ? 'bg-warning' : 'bg-danger') }}"
              style="width: {{ $profile }}%" aria-valuenow="{{ $profile }}" role="progressbar"
              aria-valuemin="0" aria-valuemax="100">
              <span class="visually-hidden">{{ $profile }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
