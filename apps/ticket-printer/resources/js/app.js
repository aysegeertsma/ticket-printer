require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

Vue.component(
    'ticket-printer',
    require('./components/App.vue').default
);

const app = new Vue({
    el: '#app'
});

// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
