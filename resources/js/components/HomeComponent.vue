<template>
    <div>
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
        }
    }
</script>
