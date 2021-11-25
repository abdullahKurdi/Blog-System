require('./bootstrap');
import Vue from "vue";

Vue.component('pagination', require('laravel-vue-pagination'));
import router from "./routes/routes";

import Home from './components/HomeComponent'




const app = new Vue({
    el: '#app',
    router,
    components:{

        Home
    },
});
