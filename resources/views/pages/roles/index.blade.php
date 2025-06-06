@extends('templates.template')

@section('content')
  <div class="page-header">
    <div class="">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
            <a href="{{ route('roles.index') }}">Grupos</a>
          </div>
          <h2 class="page-title">
            Grupos
          </h2>
        </div>
        <div class="col-auto ms-auto">
          <div class="btn-list">
            <button class="btn btn-primary d-sm-inline-block" data-bs-toggle="offcanvas" data-bs-target="#modal-add-role"
              aria-controls="offcanvasExample">
              <i class="icon ti ti-plus"></i>
              Adicionar grupo
            </button>
            <x-modal.offcanvas route="{{ route('roles.store') }}" id="modal-add-role" class="offcanvas-end"
              title="Adicionar grupo">
              <x-slot:content>
                @include('components.form-elements.input.input', [
                    'title' => 'Nome do grupo',
                    'type' => 'text',
                    'class' => 'mb-3',
                    'name' => 'name',
                    'required' => 'true',
                    'placeholder' => 'Adicone um nome para o grupo de usuário',
                ])
                <div class="">
                  <label class="form-label">Permissões</label>
                  <div class="card">
                    <x-table.table tableClass="table-vcenter card-table table-striped">
                      <x-slot:ths>
                        <th>Nome</th>
                        <th width="10%"></th>
                      </x-slot:ths>
                      <x-slot:trs>
                        @foreach ($permissions as $permission)
                          <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</td>
                            <td>
                              <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                  <input class="form-check-input" name="permission_selected[]"
                                    value="{{ $permission->name }}" type="checkbox">
                                </label>
                              </span>
                            </td>
                          </tr>
                        @endforeach
                      </x-slot:trs>
                    </x-table.table>
                  </div>
                </div>
              </x-slot:content>
              </x-modal.offcanv>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card">
      <div class="table-responsive">
        <x-table.table tableClass="table-vcenter table-sm card-table table-striped">
          <x-slot:ths>
            <th>Nome</th>
            <th width="10%"></th>
          </x-slot:ths>
          <x-slot:trs>
            @foreach ($roles as $role)
              <tr>
                <td>{{ ucwords($role->name) }}</td>
                <td>
                  <button class="btn btn-secondary" data-bs-toggle="offcanvas" aria-controls="offcanvasExample"
                    data-bs-target="#modal-edit-role{{ $role->id }}">
                    Editar
                </button>
                </td>
              </tr>
            @endforeach
          </x-slot:trs>
        </x-table.table>

        @foreach ($roles as $role)
          <x-modal.offcanvas route="{{ route('roles.update', $role->id) }}" id="modal-edit-role{{ $role->id }}"
            class="offcanvas-end" title="Editar grupo: {{ $role->name }}">
            <x-slot:content>
              @include('components.form-elements.input.input', [
                  'title' => 'Nome do grupo',
                  'type' => 'text',
                  'class' => 'mb-3',
                  'name' => 'name',
                  'required' => 'true',
                  'value' => $role->name,
              ])
              <div class="card">
                <x-table.table tableClass="table-vcenter card-table table-striped">
                  <x-slot:ths>
                    <th>Nome</th>
                    <th width="10%"></th>
                  </x-slot:ths>
                  <x-slot:trs>
                    @foreach ($permissions as $permission)
                      <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</td>
                        <td>
                          <span class="col-auto">
                            <label class="form-check form-check-single form-switch">
                              <input class="form-check-input" name="permission_selected[]"
                                value="{{ $permission->name }}" type="checkbox"
                                @if ($role->permissions->contains($permission)) checked @endif>
                            </label>
                          </span>
                        </td>
                      </tr>
                    @endforeach
                  </x-slot:trs>
                </x-table.table>
              </div>
            </x-slot:content>
          </x-modal.offcanvas>
        @endforeach
      </div>
    </div>
  </div>
@endsection
