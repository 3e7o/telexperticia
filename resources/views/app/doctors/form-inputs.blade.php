@php $editing = isset($doctor) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="ci"
            label="Cédula de Identidad"
            value="{{ old('ci', ($editing ? $doctor->ci : '')) }}"
            minlength="5"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Nombres"
            value="{{ old('name', ($editing ? $doctor->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="first_surname"
            label="Apellido Paterno"
            value="{{ old('first_surname', ($editing ? $doctor->first_surname : '')) }}"
            minlength="3"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="last_surname"
            label="Apellido Materno"
            value="{{ old('last_surname', ($editing ? $doctor->last_surname : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $doctor->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="phone"
            label="Teléfono"
            value="{{ old('phone', ($editing ? $doctor->phone : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group> --}}

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="specialty_id" label="Especialidad" required>
            @php $selected = old('specialty_id', ($editing ? $doctor->specialty_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione especialidades</option>
            @foreach($specialties as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
