@php $editing = isset($medicalBoard) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.datetime
            name="date"
            label="Fecha"
            value="{{ old('date', ($editing ? optional($medicalBoard->date)->format('Y-m-d\TH:i') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="patient_id" label="Paciente" required>
            @php $selected = old('patient_id', ($editing ? $medicalBoard->patient_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione un paciente</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="status" label="Estado">
            @php $selected = old('status', ($editing ? $medicalBoard->status : '')) @endphp
            <option value="Programado" {{ $selected == 'Programado' ? 'selected' : '' }} >Programado</option>
            <option value="Realizado" {{ $selected == 'Realizado' ? 'selected' : '' }} >Realizado</option>
            <option value="Cancelado" {{ $selected == 'Cancelado' ? 'selected' : '' }} >Cancelado</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="doctor_id" label="Medico Tratante Encargado" required>
            @php $selected = old('doctor_id', ($editing ? $medicalBoard->doctor_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione un meédico</option>
            @foreach($doctors as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <div class="col-sm-12 col-lg-12">
        @php $selected = old('doctors_id', ($editing ? $doctorsSelected : '')) @endphp
        @php $selected = !$editing && is_array($selected) ? explode(',', $selected[0]) : $doctorsSelected @endphp
        <label class="label label-required" for="doctors">Médicos Participantes</label>
        <multi-select doctors="{{ json_encode($doctors, true) }}" doctors-selected="{{ json_encode($selected) }}"></multi-select>    </div>
</div>
