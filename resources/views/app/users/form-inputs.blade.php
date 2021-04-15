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
