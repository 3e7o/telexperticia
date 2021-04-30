@extends('layout.master')
@push('plugin-styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/main.css') }}"/>
    <script src='{{ asset('assets/plugins/fullcalendar/locales/es.js') }}'></script>

@endpush
<script src="{{ asset('assets/plugins/jquery-ui-dist/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script>

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3 d-none d-md-block">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title mb-4">Calendario Juntas Medicas</h6>
            <div id='external-events' class='external-events'>
                <div id='external-events-listing'>
                  <h6 class="mb-2 text-muted">Eventos</h6>
                  <div class='fc-event'>Junta Programada</div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-9">
        <div class="card">
          <div class="card-body">
            <div id='fullcalendar'>
                {!! $calendar->calendar() !!}
                {!! $calendar->script() !!}
            </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
