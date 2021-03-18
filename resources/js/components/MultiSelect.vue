<template>
    <div>
        <v-select
            id="doctors"
            placeholder="- Seleccione Doctores -"
            :options="doctores"
            :reduce="item => item.id"
            label="name"
            :clearable="true"
            :multiple="true"
            v-model="doctoresSeleccionados"
        >
            <template #search="{attributes, events}">
                <input
                    class="vs__search"
                    :required="!(!!doctoresSeleccionados.length)"
                    v-bind="attributes"
                    v-on="events"
                />
            </template>
        </v-select>
        <input type="hidden" :value="doctoresSeleccionados" name="doctors_id[]">
    </div>
</template>

<script>
    export default {
        name: 'Multiselect',
        props: ['doctors', 'doctorsSelected'],
        data() {
            return {
                doctores: [],
                doctoresSeleccionados: [],
            };
        },
        mounted() {
            const doctors  = JSON.parse(this.doctors);
            this.doctores = Object.keys(doctors).map((key) => {
                return {
                    id: key,
                    name: doctors[key]
                };
            });
            const doctorsSelected = JSON.parse(this.doctorsSelected);
            this.doctoresSeleccionados = Object.keys(doctorsSelected).map(key => doctorsSelected[key].toString());
        }
    };
</script>
