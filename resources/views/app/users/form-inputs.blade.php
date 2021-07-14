@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $user->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="username"
            label="Usuario"
            value="{{ old('username', ($editing ? $user->username ?? (optional($user->patient)->matricula) : '')) }}"
            maxlength="255"
            required
            pattern="[A-Za-z0-9]{5,20}" title="Letras y números. Tamaño mínimo: 5. Tamaño máximo: 20"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $user->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.password
            name="password"
            label="Contraseña"
            placeholder="************"
            maxlength="255"
            :required="!$editing"
            pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Mínimo ocho caracteres, al menos una letra y un número"
        ></x-inputs.password>
    </x-inputs.group>


    <div class="form-group col-sm-12">
        <h4 class="card-title">@lang('crud.roles.name')</h4>
         <select name="roles[]" class="js-example-basic-multiple w-100" multiple="multiple">
            @foreach ($roles as $role)
            <div>
            <option
                id="role{{ $role->id }}"
                value="{{ $role->id }}"
                <?php if(isset($user) and $user->hasRole($role)){ echo "selected='selected'";}?>
            >{{ ucfirst($role->name) }}
            </option>
            </div>
            @endforeach
          </select>
        </div>
</div>
