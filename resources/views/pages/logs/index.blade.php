@extends('templates.template')

@section('styles')
@endsection
@section('content')
  <div class="page-header">
    <div class="">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
            <a href="{{ route('logs.index') }}">Logs</a>
          </div>
          <h2 class="page-title">
            Logs
          </h2>
        </div>
        <div class="col-auto ms-auto">
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card p-0">
      <div class="card-body p-0 m-0">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          @foreach ($logs as $log)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseOne{{ $log->id }}" aria-expanded="false"
                  aria-controls="flush-collapseOne">
                  {{json_decode($log->details)->message}}
                </button>
              </h2>
              <div id="flush-collapseOne{{ $log->id }}" class="accordion-collapse collapse"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div>
                    <div>
                      <pre><code>Agente: {{ $log->agent }}</code></pre>
                    </div>
                    <div>
                      <pre><code>Tipo de evento: {{ $log->event }}</code></pre>
                    </div>
                    <div>
                      <pre><code>Data e hora: {{ date('d/m/Y H:i:s', strtotime($log->created_at)) }}</code></pre>
                    </div>
                    <h4>Detalhes</h4>
                    <div>
                      <pre>{{ json_encode(json_decode($log->details, true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
