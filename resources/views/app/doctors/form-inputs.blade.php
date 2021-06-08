@php $editing = isset($doctor) @endphp

<div class="row">

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Nombres"
            value="{{ old('name', ($editing ? optional($doctor->user)->name : '')) }}"
            maxlength="255"

        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="first_surname"
            label="Apellido Paterno"
            value="{{ old('first_surname', ($editing ? optional($doctor->user)->first_surname : '')) }}"
            minlength="3"
            maxlength="255"

        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="last_surname"
            label="Apellido Materno"
            value="{{ old('last_surname', ($editing ? optional($doctor->user)->last_surname : '')) }}"
            maxlength="255"

        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="ci"
            label="Cédula de Identidad"
            value="{{ old('ci', ($editing ? optional($doctor->user)->ci : '')) }}"
            minlength="5"
            maxlength="255"

        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="username"
            label="Usuario"
            value="{{ old('username', ($editing ? optional($doctor->user)->username ?? (optional($user->patient)->matricula) : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? optional($doctor->user)->email : '')) }}"
            maxlength="255"

        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="regional_id" label="Regional">
            @php $selected = old('regional_id', ($editing ? $doctor->regional_id : '')) @endphp
            @foreach ($regionals as  $regional)
               <?php if(isset($regional)){
                ?>
                <option value="{{ ($regional->name) }}" {{ $selected == ($regional->name) ? 'selected' : '' }} >{{ ucfirst($regional->name) }}</option>
               <?php
               }?>
               @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="specialty_id" label="Especialidad" >
            @php $selected = old('specialty_id', ($editing ? $doctor->specialty_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione especialidades</option>
            @foreach($specialties as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

        <div class="col-md-6 offset-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Firma Digitalizada</h6>
              @if (isset($doctor->signature))
              <img src="{{ Storage::url($doctor->signature) }}" class="w-100">
              @else
              <input type="file" name="signature" id="myDropify" class="border"/>
              @endif
            </div>
          </div>
        </div>

</div>
