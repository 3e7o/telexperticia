@extends('layout.master')

@section('title', 'Roles')

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
                  <h4 class="mb-3 mb-md-0">@lang('crud.roles.index_title')</h4>
                    </div>
                        @can('create', App\Models\Role::class)
                        <div class="d-flex align-items-center flex-wrap text-nowrap">
                            <a
                                href="{{ route('roles.create') }}"
                                class="btn btn-primary"
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
                                        <th>@lang('crud.roles.inputs.name')</th>
                                        <th>@lang('crud.roles.date')</th>
                                        <th class="text-center">
                                            @lang('crud.common.actions')
                                        </th>
                                    </tr>
                                </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->name ?? '-' }}</td>
                            <td>{{ $role->created_at->format('d-m-Y') ?? '-'}}</td>
                            <td class="text-center" style="width: 134px;">
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="btn-group"
                                    >
                                    @can('update', $role)

                                    <a href="{{ route('roles.edit', $role) }}">
                                        <button
                                            type="button"
                                            class="btn btn-info btn-icon">
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
                                    @can('delete', $role)
                                    <form
                                        action="{{ route('roles.destroy', $role) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-icon">
                                            <i data-feather="delete"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
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
