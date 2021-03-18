@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title w-100">
                <a href="{{ route('reports.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.informes.show_title')
                @if ($isSupervisor)
                    @if ($approved)
                        <span class="text-right float-right btn btn-sm btn-info">
                            <i class="icon ion-md-checkmark"></i>
                            Reporte Aprobado
                        </span>
                    @else
                        <span class="text-right float-right">
                            <a
                                href="{{ route('reports.approve', $report) }}"
                                class="btn btn-sm btn-success"
                            >
                                <i class="icon ion-md-checkmark"></i>
                                Aprobar
                            </a>
                        </span>
                    @endif
                @endif
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.informes.inputs.medical_board_id')</h5>
                    <span
                        >{{ optional($report->medicalBoard)->identification ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.informes.inputs.record')</h5>
                    <span>{{ $report->record ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.informes.inputs.evaluation')</h5>
                    <span>{{ $report->evaluation ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.informes.inputs.diagnosis')</h5>
                    <span>{{ $report->diagnosis ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.informes.inputs.recommendations')</h5>
                    <span>{{ $report->recommendations ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('reports.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Report::class)
                <a href="{{ route('reports.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
