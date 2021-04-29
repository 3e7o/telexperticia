@php $editing = isset($medicalBoard) @endphp

<div class="row">
    <x-inputs.group class="form-group col-sm-6">
        <x-inputs.datetime
            class="form-group"
            name="date"
            label="Fecha"
            value="{{ old('date', ($editing ? optional($medicalBoard->date)->format('Y-m-d\TH:i') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="form-group col-sm-6">
        <x-inputs.select name="patient_id" label="Paciente" required>

            @php $selected = old('patient_id', ($editing ? $medicalBoard->patient_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione un paciente</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="form-group col-sm-6">
        <x-inputs.select name="status" label="Estado">
            @php $selected = old('status', ($editing ? $medicalBoard->status : '')) @endphp
            <option value="Programado" {{ $selected == 'Programado' ? 'selected' : '' }} >Programado</option>
            <option value="Realizado" {{ $selected == 'Realizado' ? 'selected' : '' }} >Realizado</option>
            <option value="Cancelado" {{ $selected == 'Cancelado' ? 'selected' : '' }} >Cancelado</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="form-group col-sm-6">
        <x-inputs.select name="doctor_id" label="Medico Tratante Encargado" required>
            @php $selected = old('doctor_id', ($editing ? $medicalBoard->doctor_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione un meédico</option>
            @foreach($doctors as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <div class="form-group col-sm-12" >Médicos Participantes
         <select  name="doctors_id[]" class="js-example-basic-multiple w-100" multiple="multiple">
            @php $selected = old('doctors_id', ($editing ? $doctorsSelected : '')) @endphp
            @foreach ($doctors as  $value => $label)
            <div>
            <option
                id="doctors_id{{ $value }}"
                value="{{ $value }}"
                <?php if (is_array($selected) || is_object($selected))
                {
                    ?>
                    @foreach ( $selected as $item)
                    <?php if(isset($medicalBoard) and $item==$value){ echo "selected='selected'";}?>
                    @endforeach
                    <?php
                }
                ?>

            >{{ $label }}
            </option>
            </div>
            @endforeach
          </select>
        </div>
        <x-inputs.group class="form-group col-sm-6">
            <x-inputs.select name="open_zoom" label="Reunion Zoom" required>
                @php $selected = old('open_zoom', ($editing ? $medicalBoard->open_zoom : '')) @endphp
                <option value="1" {{ $selected == 'Si' ? 'selected' : '' }} >Si</option>
                <option value="0" {{ $selected == 'No' ? 'selected' : '' }} >No</option>
            </x-inputs.select>
        </x-inputs.group>
