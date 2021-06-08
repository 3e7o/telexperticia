@php $editing = isset($patient) @endphp

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.text name="name" label="Nombres"
        value="{{ old('name', $editing ? optional($patient->user)->name : '') }}" maxlength="255">
    </x-inputs.text>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.text name="first_surname" label="Apellido Paterno"
        value="{{ old('first_surname', $editing ? optional($patient->user)->first_surname : '') }}" minlength="3"
        maxlength="255">
    </x-inputs.text>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.text name="last_surname" label="Apellido Materno"
        value="{{ old('last_surname', $editing ? optional($patient->user)->last_surname : '') }}" maxlength="255">
    </x-inputs.text>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.text name="ci" label="Cédula de Identidad"
        value="{{ old('ci', $editing ? optional($patient->user)->ci : '') }}" minlength="5" maxlength="255">
    </x-inputs.text>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.text name="mat_beneficiario" label="Matricula Beneficiario"
        value="{{ old('mat_beneficiario', $editing ? optional($patient->user)->mat_beneficiario : '') }}" minlength="5" maxlength="255">
    </x-inputs.text>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.text name="mat_asegurado" label="Matricula Asegurado"
        value="{{ old('mat_asegurado', $editing ? optional($patient->user)->mat_asegurado : '-') }}" minlength="5" maxlength="255">
    </x-inputs.text>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.date name="birthday" label="Fecha de Nacimiento"
        value="{{ old('birthday', $editing ? optional($patient->user->birthday)->format('Y-m-d') : '') }}"
        max="255" required>
    </x-inputs.date>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.select name="gender" label="Género">
        @php $selected = old('gender', ($editing ? optional($patient->user)->gender : '')) @endphp
        @foreach ($genders as $gender)
            <?php if (isset($gender)) { ?>
            <option value="{{ $gender->name }}" {{ $selected == $gender->name ? 'selected' : '' }}>
                {{ ucfirst($gender->name) }}</option>
            <?php } ?>
        @endforeach
    </x-inputs.select>
</x-inputs.group>

<x-inputs.group class="col-sm-12 col-lg-6">
    <x-inputs.select name="force" label="Fuerza">
        @php $selected = old('force', ($editing ? $patient->force : '')) @endphp
        <option value="Ejercito" {{ $selected == 'Ejercito' ? 'selected' : '' }}>Ejercito</option>
        <option value="Armada" {{ $selected == 'Armada' ? 'selected' : '' }}>Armada</option>
        <option value="Aerea" {{ $selected == 'Aerea' ? 'selected' : '' }}>Aerea</option>
    </x-inputs.select>
</x-inputs.group>

<x-inputs.group class="col-sm-12">
    <x-inputs.text name="address" label="Dirección" value="{{ old('address', $editing ? $patient->address : '') }}"
        maxlength="255" required>
    </x-inputs.text>
</x-inputs.group>
</div>
