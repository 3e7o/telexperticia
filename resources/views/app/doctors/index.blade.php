@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.doctores.index_title')</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="icon ion-md-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\Doctor::class)
                        <a
                            href="{{ route('doctors.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>@lang('crud.doctores.inputs.specialty_id')</th>
                            <th>@lang('crud.doctores.inputs.name')</th>
                            <th>@lang('crud.doctores.inputs.first_surname')</th>
                            <th>@lang('crud.doctores.inputs.email')</th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                        <tr>
                            <td>{{ optional($doctor->specialty)->name ?? '-' }}</td>
                            <td>{{ $doctor->name ?? '-' }}</td>
                            <td>{{ $doctor->first_surname ?? '-' }}</td>
                            <td>{{ $doctor->email ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('view', $doctor)
                                    <a
                                        href="{{ route('doctors.show', $doctor) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success ml-1"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('update', $doctor)
                                            <a
                                                href="{{ route('doctors.edit', $doctor) }}"
                                            >
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-info ml-1"
                                                >
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            </a>
                                        @endcan @can('delete', $doctor)
                                    {{-- <form
                                        action="{{ route('doctors.destroy', $doctor) }}"
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
                                    </form> --}}
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{!! $doctors->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
