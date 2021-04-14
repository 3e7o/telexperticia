@extends('layout.master')


@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">@lang('crud.especialidades.index_title')</h6>
          <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
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
                        <td class="text-center" style="width: 134px;">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                            >
                                @can('view', $specialty)
                                <a
                                    href="{{ route('specialties.show', $specialty) }}"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-outline-success ml-1"
                                    >
                                        <i class="icon ion-md-eye"></i>
                                    </button>
                                </a>
                                @endcan @can('update', $specialty)
                                        <a
                                            href="{{ route('specialties.edit', $specialty) }}"
                                        >
                                            <button
                                                type="button"
                                                class="btn btn-outline-info ml-1"
                                            >
                                                <i class="icon ion-md-create"></i>
                                            </button>
                                        </a>
                                    @endcan @can('delete', $specialty)
                                <form
                                    action="{{ route('specialties.destroy', $specialty) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                >
                                    @csrf @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger ml-1"
                                    >
                                        <i class="icon ion-md-trash"></i>
                                    </button>
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
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

