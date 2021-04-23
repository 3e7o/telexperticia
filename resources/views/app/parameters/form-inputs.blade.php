@php $editing = isset($parameter) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre Grupo"
            value="{{ old('name', ($editing ? $parameter->name : '')) }}"
            minlength="5"
            maxlength="255"
            required
        ></x-inputs.text>
        <x-inputs.text
            name="description"
            label="Descripcion"
            value="{{ old('description', ($editing ? $parameter->description : '')) }}"
            minlength="5"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>
</div>
