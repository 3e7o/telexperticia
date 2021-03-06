@php $editing = isset($patient) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="ci"
            label="Cédula de Identidad"
            value="{{ old('ci', ($editing ? $patient->ci : '')) }}"
            minlength="5"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $patient->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="first_surname"
            label="Apellido Paterno"
            value="{{ old('first_surname', ($editing ? $patient->first_surname : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="last_surname"
            label="Apellido Materno"
            value="{{ old('last_surname', ($editing ? $patient->last_surname : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.date
            name="birthday"
            label="Fecha de Nacimiento"
            value="{{ old('birthday', ($editing ? optional($patient->birthday)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="gender" label="Género">
            @php $selected = old('gender', ($editing ? $patient->gender : '')) @endphp
            @foreach ($genders as  $gender)
               <?php if(isset($gender)){
                ?>
                <option value="{{ ($gender->name) }}" {{ $selected == ($gender->name) ? 'selected' : '' }} >{{ ucfirst($gender->name) }}</option>
               <?php
               }?>
               @endforeach
        </x-inputs.select>
    </x-inputs.group>

    
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="mat_asegurado"
            label="Matricula Asegurado"
            value="{{ old('mat_asegurado', ($editing ? $patient->mat_asegurado : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="mat_beneficiario"
            label="Matricula Beneficiario"
            value="{{ old('mat_beneficiario', ($editing ? $patient->mat_beneficiario : '')) }}"
            maxlength="255"
            disabled
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $patient->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="phone"
            label="Teléfono"
            value="{{ old('phone', ($editing ? $patient->phone : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="type" label="Tipo de Asegurado">
            @php $selected = old('type', ($editing ? $patient->type : '')) @endphp
            @foreach ($tipo_users as  $tipo_user)
               <?php if(isset($tipo_user)){
                ?>
                <option value="{{ ($tipo_user->name) }}" {{ $selected == ($tipo_user->name) ? 'selected' : '' }} >{{ ucfirst($tipo_user->name) }}</option>
               <?php
               }?>
               @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="force" label="Fuerza">
            @php $selected = old('force', ($editing ? $patient->force : '')) @endphp
            <option value="Ejercito" {{ $selected == 'Ejercito' ? 'selected' : '' }} >Ejercito</option>
            <option value="Armada" {{ $selected == 'Armada' ? 'selected' : '' }} >Armada</option>
            <option value="Aerea" {{ $selected == 'Aerea' ? 'selected' : '' }} >Aerea</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Dirección"
            value="{{ old('address', ($editing ? $patient->address : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
