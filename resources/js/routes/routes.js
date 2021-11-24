import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Post from "../components/PostComponent";
import Posts from "../components/PostsComponent";
import CategoryPosts from "../components/CategoryPostsComponent";

const routes =[
    {
        path:'/',
        component:Posts,
        name:'Posts'
    },
    {
        path:'/post/:slug',
        component:Post,
        name:'Post'
    },
    {
        path:'/category/:slug/posts',
        component:CategoryPosts,
        name:'CategoryPosts'
    }

];

const router = new  VueRouter({
    routes,
    hashbang:false,
    mode:"history"
})

export default router;
