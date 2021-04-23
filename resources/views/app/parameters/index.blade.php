@extends('layout.master')
@section('title', 'Grupo de Parametros')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                  <h4 class="mb-3 mb-md-0">@lang('crud.parametros.index_title')</h4>
                </div>
              </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table dataTable no-footer" role="grid" aria-describedby="dataTableExample_info">
                <thead>
                    <tr>
                        <th>@lang('crud.parametros.inputs.name')</th>
                        <th>@lang('crud.parametros.inputs.description')</th>
                        <th class="text-center">@lang('crud.common.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parameters as $parameter)
                    <tr>
                        <td>{{ $parameter->name ?? '-' }}</td>
                        <td>{{ $parameter->description ?? '-' }}</td>
                        <td class="text-center" style="width: 250px;">
                            <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                            >
                            @can('view', $parameter)
                                <a
                                    href="{{ route('parameters.edit', $parameter) }}"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-info btn-icon"
                                    >
                                        <i data-feather="edit"></i>
                                    </button>
                                </a>
                            @endcan
                            </div>

                            <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                            >
                                    @can('delete', $parameter)


                                <form
                                    action="{{ route('parameters.destroy', $parameter) }}"
                                    method="POST"
                                >
                                     @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-icon" type="button" onclick="showSwal('passing-parameter-execute-cancel')" id="btn-ok"><i data-feather="x-square"></i></button>
                                </form>
                                @endcan
                            </div>


                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>

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

