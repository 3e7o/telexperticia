@php $editing = isset($role) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $role->name : '')) }}"
        ></x-inputs.text>
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4 class="card-title">Asignar a @lang('crud.permissions.name')</h4>

        @foreach ($permissions as $permission)
        <div>
            <div class="form-check">
                <label class="form-check-label">
                     <input
                        id="role{{ $permission->id }}"
                        name="permissions[]"
                        type="checkbox"
                        value="{{ $permission->id }}"
                        class="form-check-input"
                        <?php if(isset($role) and $role->hasPermissionTo($permission)){ echo "checked";}?>
                    >
                    {{ ucfirst(__($permission->name)) }} ({{ ucfirst(__($permission->description)) }})
                </label>
              </div>
        </div>
        @endforeach
    </div>
</div>
