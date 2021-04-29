@extends('layout.master')
@section('title', 'Grupo de Parametros')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
<style>
    /* clase para ocultar el div al inicio */

    .oculto {
    display:none;
    margin-left:2em;
    margin-right:8em;
    }


    </style>
    <script type="text/javascript">
        <!--
        /*****************************Ocultar div**************************/

        var visto = null;
        function ver(num) {

        obj = document.getElementById(num);
        obj.style.display = (obj==visto) ? 'none' : 'block';
        if (visto != null)
        visto.style.display = 'none';
        visto = (obj==visto) ? null : obj;
        }

        -->
        </script>
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                  <h4 class="mb-3 mb-md-0">@lang('crud.gparametros.index_title')</h4>
                </div>
                @can('create', App\Models\GroupParameter::class)
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                    <a
                        href="{{ route('gparameters.create') }}"
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
                    <tr class="oculto">
                        <th>@lang('crud.gparametros.inputs.name')</th>
                        <th>@lang('crud.gparametros.inputs.description')</th>
                        <th class="text-center">@lang('crud.common.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gparameters as $gparameter)
                    <tr class="oculto">
                        <td>{{ $gparameter->name ?? '-' }}</td>
                        <td>{{ $gparameter->description ?? '-' }}</td>
                        <td class="text-center" style="width: 250px;">
                            <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                            >
                            @can('view', $gparameter)
                                <a
                                    href="{{ route('gparameters.edit', $gparameter) }}"
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
                                    @can('delete', $gparameter)


                                <form
                                    action="{{ route('gparameters.destroy', $gparameter) }}"
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

