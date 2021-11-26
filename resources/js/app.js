require('./bootstrap');
import Vue from "vue";
import Vuex from 'vuex'

import storeData from './store/store';


Vue.component('pagination', require('laravel-vue-pagination'));
import router from "./routes/routes";

import Home from './components/HomeComponent';


Vue.use(Vuex);

const store = new Vuex.Store(storeData)





const app = new Vue({
    el: '#app',
    router,store,
    components:{
        Home
    },
});
