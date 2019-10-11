//require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

//Vue.use(BootstrapVue);

Vue.component(
    'ticket-printer',
    require('./components/App.vue').default
);

const app = new Vue({
    el: '#app'
});
