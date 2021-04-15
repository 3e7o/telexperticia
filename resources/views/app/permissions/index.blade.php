@extends('layout.master')
@section('title', 'Permisos')

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
                  <h4 class="mb-3 mb-md-0">@lang('crud.permissions.index_title')</h4>
                    </div>
                            @can('create', App\Models\Permission::class)
                            <div class="d-flex align-items-center flex-wrap text-nowrap">
                            <a
                                href="{{ route('permissions.create') }}"
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
                            <th>@lang('crud.permissions.inputs.name')</th>
                            <th>@lang('crud.permissions.inputs.description')</th>
                            <th>@lang('crud.permissions.date')</th>
                            @can('update', $permissions)
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ __($permission->name) ?? '-' }}</td>
                            <td>{{ $permission->description ?? '-' }}</td>
                            <td>{{ $permission->created_at->format('d-m-Y') ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                @can('view', $permission)
                                <a>
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-icon"
                                        data-toggle="modal"
                                        data-target="#ID{{  $permission->id ?? '-' }}"
                                    >
                                        <i data-feather="eye"></i>
                                    </button>
                                    <div class="modal fade" id="ID{{ $permission->id ?? '-' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="ID{{$permission->id ?? '-' }}Title">@lang('crud.permissions.show_title')</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                @include('app.permissions.show')
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </a>
                                @endcan
                                </div>
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $permission)
                                    <a
                                        href="{{ route('permissions.edit', $permission) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-info btn-icon">
                                            <i data-feather="edit"></i>
                                        </button>
                                    </a>
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
