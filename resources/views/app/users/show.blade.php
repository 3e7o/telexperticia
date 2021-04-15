        <div class="mb-4">
            <h5>@lang('crud.usuarios.inputs.name')</h5>
            <span>{{ $user->name ?? '-' }}</span>
        </div>
        <div class="mb-4">
            <h5>@lang('crud.usuarios.inputs.email')</h5>
            <span>{{ $user->email ?? '-' }}</span>
        </div>
        <div class="mb-4">
            <h5>@lang('crud.usuarios.date')</h5>
            <span>{{ $user->created_at ?? '-' }}</span>
        </div>
        <div class="mb-4">
            <h5>@lang('crud.usuarios.update')</h5>
            <span>{{ $user->updated_at ?? '-' }}</span>
        </div>
        <div class="mb-4">
            <h5>@lang('crud.roles.name')</h5>
            <div>
                @forelse ($user->roles as $role)
                <div class="badge badge-primary">{{ $role->name }}</div>
                @empty - @endforelse
            </div>
        </div>
