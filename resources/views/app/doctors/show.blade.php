            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.ci')</h5>
                    <span>{{ $doctor->ci ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.name')</h5>
                    <span>{{ $doctor->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.first_surname')</h5>
                    <span>{{ $doctor->first_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.last_surname')</h5>
                    <span>{{ $doctor->last_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.email')</h5>
                    <span>{{ $doctor->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.date')</h5>
                    <span>{{ $doctor->created_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.update')</h5>
                    <span>{{ $doctor->updated_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.specialty_id')</h5>
                    <span>{{ optional($doctor->specialty)->name ?? '-' }}</span>
                </div>
            </div>
