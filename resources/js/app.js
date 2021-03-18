require('./bootstrap');

window.Vue = require('vue').default;

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);
import 'vue-select/dist/vue-select.css';

Vue.component('multi-select', require('./components/MultiSelect.vue').default);

const app = new Vue({
    el: '#app',
});
