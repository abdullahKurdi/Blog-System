require('./bootstrap');
import Vue from "vue";

Vue.component('pagination', require('laravel-vue-pagination'));

import Home from './components/HomeComponent'

import router from "./routes/routes";
const app = new Vue({
    el: '#app',
    router,
    components: {
        Home,

    }
});
