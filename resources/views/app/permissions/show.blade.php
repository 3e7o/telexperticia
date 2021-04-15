
                <div class="mb-4">
                    <h5>@lang('crud.permissions.inputs.name')</h5>
                    <span>{{ __($permission->name) ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.permissions.inputs.description')</h5>
                    <span>{{ __($permission->description) ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.permissions.date')</h5>
                    <span>{{ $permission->created_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.permissions.update')</h5>
                    <span>{{ $permission->updated_at ?? '-' }}</span>
                </div>

