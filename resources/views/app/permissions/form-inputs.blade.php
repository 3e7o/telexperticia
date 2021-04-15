@php $editing = isset($permission) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $permission->name : '')) }}"
        ></x-inputs.text>
        <x-inputs.text
        name="description"
        label="Descripción"
        value="{{ old('description', ($editing ? $permission->description : '')) }}"
        ></x-inputs.text>
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4 class="card-title">Asignar a @lang('crud.roles.name')</h4>

        @foreach ($roles as $role)
        <div>
            <div class="form-check">
                <label class="form-check-label">
                     <input
                        id="role{{ $role->id }}"
                        name="roles[]"
                        type="checkbox"
                        value="{{ $role->id }}"
                        class="form-check-input"
                        <?php if(isset($permission) and $role->hasPermissionTo($permission)){ echo "checked";}?>
                    >
                  {{ ucfirst($role->name) }}
                </label>
              </div>
        </div>
        @endforeach
    </div>
</div>
