@php $editing = isset($gparameter) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre Grupo"
            value="{{ old('name', ($editing ? $gparameter->name : '')) }}"
            minlength="5"
            maxlength="255"
            required
        ></x-inputs.text>
        <x-inputs.text
            name="description"
            label="Descripcion"
            value="{{ old('description', ($editing ? $gparameter->description : '')) }}"
            minlength="5"
            maxlength="255"
        ></x-inputs.text>
        <a>Parametros</a>
        <div class="col-sm-12" >
            <div>
               @foreach ($parameters as  $value)
               <?php if(isset($gparameter) and ($value->group_id)==$gparameter->id){
                ?>
                <a href="#"
                class="badge badge-pill badge-secondary"
                >{{ ucfirst($value->name) }}
                </a>
               <?php
               }?>
               @endforeach
            </div>
            <br>
        </div>

        <div>
          <input name="tags" id="tags" value="" />
        </div>
    </x-inputs.group>
</div>
