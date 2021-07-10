@extends('layout.master')

@section('title', 'Medicos')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section("content")

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex flex-row">
                <div class="col-md-10">
                    <h6 class="m-0 font-weight-bold text-primary">Registro de Actividades</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableExample" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Detalle de Actividad</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Dirección IP</th>
                        <th aria-sort="descending">Fecha de Actividad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activityList as $data)
                        <tr>
                            <td>{{ $data->log_details }}. <strong style="color: mediumvioletred">realizado por: {{ optional($data->users)->username }}</strong></td>
                            <td>{{ optional($data->users)->email }}</td>
                            <td>{{ optional($data->users)->name }}</td>
                            <td>{{ $data->ip_address }}</td>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush
@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush
