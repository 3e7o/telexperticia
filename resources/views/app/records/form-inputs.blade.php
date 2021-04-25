@php $editing = isset($record) @endphp

<div class="row">

    <x-inputs.group class="form-group col-sm-6">
        <x-inputs.select name="blood_type" label="Grupo Sanguineo" required>
            @php $selected = old('blood_type', ($editing ? $record->blood_type : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione un paciente</option>
            @foreach($blood_types as $blood_type)
            <option value="{{ $blood_type->name }}" {{ $selected == $blood_type->name ? 'selected' : '' }} >{{ $blood_type->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <div class="form-group col-sm-6">
        <x-inputs.select name="allergies[]" label="Alergias" class="js-example-basic-multiple w-100" multiple="multiple">
            @php $selected = old('allergie_id', ($editing ? $selectedAllergies : '')) @endphp
            @foreach ($allergies as $allergie)
            <div>
            <option
                id="allergie{{ $allergie->id }}"
                value="{{ $allergie->id }}"
                <?php if (is_array($selected) || is_object($selected))
               {
                   ?>
                   @foreach ( $selected as $item)
                   <?php if(isset($record) and $item==$allergie->id){ echo "selected='selected'";}?>
                   @endforeach
                   <?php
               }
               ?>
            >{{ ucfirst($allergie->name) }}
            </option>
            </div>
            @endforeach
        </x-inputs.select>
    </div>

    <div class="form-group col-sm-6">
        <x-inputs.select name="vaccines[]" label="Vacunas" class="js-example-basic-multiple w-100" multiple="multiple">
            @php $selected = old('vaccine_id', ($editing ? $selectedVaccines : '')) @endphp
            @foreach ($vaccines as $vaccine)
            <div>
            <option
                id="vaccine{{ $vaccine->id }}"
                value="{{ $vaccine->id }}"
                <?php if (is_array($selected) || is_object($selected))
                {
                    ?>
                    @foreach ( $selected as $item)
                    <?php if(isset($record) and $item==$vaccine->id){ echo "selected='selected'";}?>
                    @endforeach
                    <?php
                }
                ?>
            >{{ ucfirst($vaccine->name) }}
            </option>
            </div>
            @endforeach
        </x-inputs.select>
    </div>

    <div class="form-group col-sm-6">
        <x-inputs.select name="operations[]" label="Operaciones" class="js-example-basic-multiple w-100" multiple="multiple">
            @php $selected = old('operation_id', ($editing ? $selectedOperations : '')) @endphp
            @foreach ($operations as $operation)
            <div>
            <option
                id="operation{{ $operation->id }}"
                value="{{ $operation->id }}"
                <?php if (is_array($selected) || is_object($selected))
                {
                    ?>
                    @foreach ( $selected as $item)
                    <?php if(isset($record) and $item==$operation->id){ echo "selected='selected'";}?>
                    @endforeach
                    <?php
                }
                ?>
            >{{ ucfirst($operation->name) }}
            </option>
            </div>
            @endforeach
        </x-inputs.select>
    </div>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            style="resize: vertical;"
            name="record_familiar"
            label="Antecedentes Familiares"
            required
            >{{ old('record_familiar', ($editing ? $record->record_familiar : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            style="resize: vertical;"
            name="record_clinic"
            label="Antecedentes Clinicos"
            required
            >{{ old('record_clinic', ($editing ? $record->record_clinic : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

</div>


