<template>
    <div class="">
        <div class="row">
            <div class="col-8" v-if="issearching">
                ...searching posts
            </div>
        <div class="col-md-8" v-else>
        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>
        <div v-if="posts">
            <div class="media simple-post" v-for="(post) in posts.data" :key="post.id">
                <img class="mr-3" :src="'/assets/img/'+post.image" alt="Generic placeholder image">
                <div class="media-body">
                    <h4 class="mt-0">
                        <router-link :to="'/post/'+post.slug">{{post.title}}</router-link>
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
             <!-- Pagination
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
            </nav> -->
        </div>
        <div v-else>
            <div class="row">
                <div class="col-12 alert alert-warning">
                    <strong>No Post Found !</strong>
                </div>
            </div>
        </div>
        
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="searchPost" placeholder="Search for...">
                            <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>        
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
                posts:{},
                searchPost:'',
                issearching:false
            }
        },
        created() {
            console.log('Component mounted.')
            this.getCategoryPosts();
        },
        watch:{
            searchPost(query){
                if(query.length > 0){
                    console.log(query)
                    this.issearching=true
                    axios.get('/api/search-post/'+query)
                    .then(res =>{this.posts =res.data.data ; this.issearching=false})
                    .catch(err =>console.log(err))
                }else{
                    let oldposts = JSON.parse(localStorage.getItem('posts'))
                    this.posts = oldposts;
                }
            }
        },
        methods:{
             getCategoryPosts:function(){
                axios.get('http://127.0.0.1:8000/api/category/'+this.$route.params.slug+'/posts')
                .then(res =>{this.posts=res.data; localStorage.setItem('posts',JSON.stringify(res.data))})
                .catch(err =>{this.posts=err.data;})
            },
            setData:function(qurery){
                this.posts = qurery.data
            }
        },
        components:{
            Search,
        }
    }
</script>
