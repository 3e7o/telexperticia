@extends('layout.master')


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
                  <h4 class="mb-3 mb-md-0">@lang('crud.especialidades.index_title')</h4>
                </div>
                @can('create', App\Models\Specialty::class)
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                    <a
                        href="{{ route('specialties.create') }}"
                        class="btn btn-primary btn-icon-text mb-2 mb-md-0"
                        >
                        <i class="icon ion-md-add"></i>
                         @lang('crud.common.create')
                    </a>
                </div>
                @endcan
              </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table dataTable no-footer" role="grid" aria-describedby="dataTableExample_info">
                <thead>
                    <tr>
                        <th>@lang('crud.especialidades.inputs.name')</th>
                        <th class="text-center">@lang('crud.common.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($specialties as $specialty)
                    <tr>
                        <td>{{ $specialty->name ?? '-' }}</td>
                        <td class="text-center" style="width: 250px;">
                            <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                            >
                                @can('update', $specialty)
                                        <a
                                            href="{{ route('specialties.edit', $specialty) }}"
                                        >
                                            <button
                                                type="button"
                                                class="btn btn-primary btn-icon">
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
                                    @can('delete', $specialty)


                                <form
                                    action="{{ route('specialties.destroy', $specialty) }}"
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

