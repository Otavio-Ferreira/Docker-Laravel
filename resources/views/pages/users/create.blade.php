@extends('templates.template')

@section('content')
  <div class="page-header">
    <div class="">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="col">
            <div class="page-pretitle">
              <a href="{{ route('users.index') }}">Usuários</a>/
              <a href="{{ route('users.create') }}">Adicionar usuário</a>
            </div>
            <h2 class="page-title">
              Adicionar Usuário
            </h2>
          </div>
        </div>
        <div class="col-auto ms-auto">
          <div class="btn-list">
            <a href="{{ route('users.index') }}" class="btn btn-info"><i class="ti ti-arrow-left me-1"></i>Voltar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <form action="{{ route('users.store') }}" method="POST" class="row">
      @csrf
      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <x-form-elements.select.select title="Método de inserção" id="method" name="method">
              <x-slot:options>
                <option value="" disabled selected>Selecione</option>
                <option value="1" {{ old('method') && old('method') == '1' ? 'selected' : '' }}>Manual</option>
                <option value="2" {{ old('method') && old('method') == '2' ? 'selected' : '' }}>Convite</option>
              </x-slot:options>
            </x-form-elements.select.select>

            <div id="text" class="d-none mt-2 text-muted">

            </div>
          </div>
        </div>
      </div>
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            @include('components.form-elements.input.input', [
                'title' => 'Nome',
                'type' => 'text',
                'class' => 'mb-3',
                'name' => 'name',
                'required' => 'true',
                'placeholder' => 'Digite o nome do usuário',
                'value' => old('name') ?? ''
            ])
            @include('components.form-elements.input.input', [
                'title' => 'Email',
                'type' => 'email',
                'class' => 'mb-3',
                'name' => 'email',
                'required' => 'true',
                'placeholder' => 'Digite o email do usuário',
                'value' => old('email') ?? ''
            ])

            <x-form-elements.select.select title="Grupo de permissões" id="role" name="role">
              <x-slot:options>
                <option value="" disabled selected>Selecione</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->name }}" {{ old('role') && old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
              </x-slot:options>
            </x-form-elements.select.select>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>            
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
      $('#method').on('change', function() {
        const value = $(this).val();
        const $text = $('#text');

        if (value === "1") {
          $text.removeClass('d-none').text(
            "Você irá cadastrar o usuário manualmente, ativando a conta automaticamente e gerando uma senha aleatória que será enviada para o e-mail informado."
            );
        } else if (value === "0") {
          $text.removeClass('d-none').text(
            "Um e-mail será enviado para o usuário definir a senha e ativar sua conta.");
        } else {
          $text.addClass('d-none').text('');
        }
      });
    });
  </script>
@endsection
