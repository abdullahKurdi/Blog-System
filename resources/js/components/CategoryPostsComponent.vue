<template>
    <div class="">
        <div class="row">
        <div class="col-md-8">
        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>
        <div class="media simple-post" v-for="(post) in posts.data" :key="post.id">
            <img class="mr-3" :src="'/assets/img/'+post.image" alt="Generic placeholder image">
            <div class="media-body">
                <h4 class="mt-0">
                    <router-link :to="'/post/'+post.slug">{{post.title}}</router-link>
<!--                    <a :href="'/post/'+post.slug">{{post.title}}</a> </h4>-->
                </h4>
                {{post.body}}
                <ul class="list-inline list-unstyled d-flex post-info">
                    <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">{{post.user.name}}</strong> </span></li>
                    <li>|</li>
                    <li><span><i class="fa fa-calendar"></i> {{post.add_at}} </span></li>
                    <li>|</li>
                    <span><i class="fa fa-comment"></i> {{post.comments_count}} comments</span>
                </ul>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="...">
            <ul class="pagination float-right">
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
            <span class="page-link">
            2
            <span class="sr-only">(current)</span>
            </span>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        </div>
        <div class="col-md-4">
            <search></search>       
        </div>
        </div>

    </div>

</template>

<script>
import Search from './SearchComponent.vue'
    export default {
        name:'posts',
        data(){
            return{
                posts:''
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getCategoryPosts();
        },
        methods:{
             getCategoryPosts:function(){
                axios.get('http://127.0.0.1:8000/api/category/'+this.$route.params.slug+'/posts')
                .then(res =>{this.posts=res.data;})
                .catch(err =>{this.posts=err.data;})
            }
        },
        components:{
            Search,
        }
    }
</script>
