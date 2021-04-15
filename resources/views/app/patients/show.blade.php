            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.ci')</h5>
                    <span>{{ $patient->ci ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.name')</h5>
                    <span>{{ $patient->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.first_surname')</h5>
                    <span>{{ $patient->first_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.last_surname')</h5>
                    <span>{{ $patient->last_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.email')</h5>
                    <span>{{ $patient->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.force')</h5>
                    <span>{{ $patient->force ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.birthday')</h5>
                    <span>{{ $patient->birthday ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.gender')</h5>
                    <span>{{ $patient->gender ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.address')</h5>
                    <span>{{ $patient->address ?? '-' }}</span>
                </div>
            </div>
