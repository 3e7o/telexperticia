@php $editing = isset($specialty) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Especialidad"
            value="{{ old('name', ($editing ? $specialty->name : '')) }}"
            minlength="5"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
