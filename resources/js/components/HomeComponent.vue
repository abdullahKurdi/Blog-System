<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Ayat Amine</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active" v-if="isAdmin">
                            
                            <router-link class="nav-link" :to="'/admin'">admin
                                <span class="sr-only">(current)</span>
                            </router-link>
                            <!-- <span style="color:white">
                            <router-link :to="'/'"> home</router-link>
                            </span> -->
                            <!-- <router-link :to="'/'"> home</router-link> -->
                        </li>
                        <li class="nav-item active">
                            
                            <router-link class="nav-link" :to="'/'">Home
                                <span class="sr-only">(current)</span>
                            </router-link>
                            <!-- <span style="color:white">
                            <router-link :to="'/'"> home</router-link>
                            </span> -->
                            <!-- <router-link :to="'/'"> home</router-link> -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>

                        <li v-if="!isLogged"  class="nav-item register-btn reg-login-btn" data-toggle="modal" data-target="#register-modal">
                            <a class="btn btn-info nav-link" href="" data-toggle="modal" data-target="#register-modal">Register</a>
                        </li>
                        <li v-if="!isLogged" class="nav-item reg-login-btn" data-toggle="modal" data-target="#login-modal">
                            <a class="btn btn-primary text-weight nav-link" href="#">login</a>
                        </li>
                        <li v-if="isLogged" @click.stop="logout" class="nav-item reg-login-btn" data-toggle="modal" data-target="#login-modal">
                            <a class="btn btn-primary text-weight nav-link" href="" >logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container intro-container">
        <!-- Blog Entries Column -->
            <!-- Blog Post -->
            <router-view></router-view>
            <register/>
            <login/>
    <!-- /.row -->
        </div>
    </div>
</template>

<script>
import Register from './RegisterComponent'
import Login from './LoginComponent'
    export default {
        name:'home',
        components:{
            Register,
            Login
        },
        created(){
            this.updateToken();
            this.setUser();
        },
        computed:{
            isLogged(){
                return this.$store.getters.isLogged;
            },
            isAdmin(){
                return this.$store.getters.isAdmin;
            }
        },
        methods:{
            updateToken(){
                let token = JSON.parse(localStorage.getItem('userToken'));
                
                if(token){
                this.$store.commit('userLoggedin',token);}
            },
            setUser(){
                let token = JSON.parse(localStorage.getItem('userToken'));
                
                if(token){
                axios.get('/api/user')
                .then(res => {
                    //console.log(res.data)
                    this.$store.commit('setUser', res.data.user)
                })
                }
            },logout(){
                this.$store.commit('logout');
            }
        }
    }
</script>
