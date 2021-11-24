<template>
    <div>
        <div class="container intro-container">
        <!-- Blog Entries Column -->
            <!-- Blog Post -->
            <router-view></router-view>
    <!-- /.row -->
        </div>
    </div>
</template>

<script>


    export default {
        name:'home',
        mounted() {
            console.log('Component mounted.')
        },

    }
</script>
