@php $editing = isset($report) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6" hidden>
        <x-inputs.select name="medical_board_id" label="Medical Board" required>
            @php $selected = old('medical_board_id', ($editing ? $report->medical_board_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Medical Board</option>
            @foreach($medicalBoards as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            style="resize: vertical;"
            name="record"
            label="Antecedentes"
            required
            >{{ old('record', ($editing ? $report->record : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            style="resize: vertical;"
            name="evaluation"
            label="Evaluación"
            required
            >{{ old('evaluation', ($editing ? $report->evaluation : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            style="resize: vertical;"
            name="diagnosis"
            label="Diagnóstico"
            required
            >{{ old('diagnosis', ($editing ? $report->diagnosis : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            style="resize: vertical;"
            name="recommendations"
            label="Recomendaciones"
            required
            >{{ old('recommendations', ($editing ? $report->recommendations :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
