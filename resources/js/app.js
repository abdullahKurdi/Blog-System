require('./bootstrap');
import Vue from "vue";

import Posts from "./components/PostsComponent";
import Post from "./components/PostComponent";
import Home from './components/HomeComponent'


import router from "./routes/routes";
const app = new Vue({
    el: '#app',
    router,
    components: {
        Home

    }
});
