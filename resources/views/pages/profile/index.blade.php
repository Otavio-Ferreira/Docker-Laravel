@extends('templates.template')

@section('styles')
@endsection
@section('content')
  <div class="page-header">
    <div class="">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
            <a href="{{ route('profile.index') }}">Perfil</a>
          </div>
          <h2 class="page-title">
            Informações pessoais
          </h2>
        </div>
        <div class="col-auto ms-auto">
        </div>
      </div>
    </div>
  </div>
  <div class="page-body row">
    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Alterar informações</div>

          <form action="{{ route('profile.store') }}" method="post" class="row">
            @csrf
            @include('components.form-elements.input.input', [
                'title' => 'Nome',
                'type' => 'text',
                'class' => 'mb-3 col-12',
                'name' => 'name',
                'placeholder' => 'Digite seu nome',
                'value' => $user->name,
            ])

            <div class="col-12 col-md-4">
              <label class="form-label">
                Senha Atual
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="actual_password" id="actual_password"
                  placeholder="Digite sua senha atual" value="{{ old("actual_password")}}">
                <span class="input-group-text">
                  <a href="#" class="link-secondary text-decoration-none" onclick="change('actual_password')">
                    <i class="ti ti-eye" style="font-size: 20px;"></i>
                  </a>
                </span>
              </div>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label">
                Nova Senha
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="password" id="password"
                  placeholder="Digite a nova senha" value="{{ old("password") }}">
                <span class="input-group-text">
                  <a href="#" class="link-secondary text-decoration-none" onclick="change('password')">
                    <i class="ti ti-eye" style="font-size: 20px;"></i>
                  </a>
                </span>
              </div>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label">
                Confirmar senha
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="password_confirm" id="password_confirm"
                  placeholder="Confirme a nova senha" value="{{ old("password_confirm")}}">
                <span class="input-group-text">
                  <a href="#" class="link-secondary text-decoration-none" onclick="change('password_confirm')">
                    <i class="ti ti-eye" style="font-size: 20px;"></i>
                  </a>
                </span>
              </div>
            </div>


            <div class="d-flex w-100 justify-content-between mt-3">
              <button type="submit" class="btn btn-success ms-auto">Salvar alterações</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Informações do usuário</div>
          <div class="mb-2">
            <i class="icon me-2 text-secondary icon-2 ti ti-id-badge-2"></i>
            Nome: <strong>{{ $user->name }}</strong>
          </div>
          <div class="mb-2">
            <i class="icon me-2 text-secondary icon-2 ti ti-mail"></i>
            Email: <strong>{{ $user->email }}</strong>
          </div>
          <div class="mb-2">
            <i class="icon me-2 text-secondary icon-2 ti ti-users-group"></i>
            Tipo de usuário: <strong>{{ $user->roles->first()->name }}</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    function change(id) {
      const input = document.getElementById(id);

      if (input.type === 'password') {
        input.type = 'text';
      } else {
        input.type = 'password';
      }

    }
  </script>
@endsection
