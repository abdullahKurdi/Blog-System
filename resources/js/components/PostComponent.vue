<template>

    <div v-if="post.status == 200">
        <div class="row">
<div class="col-md-12">
        <!-- Title -->
            <h1 class="mt-4">Title: {{post.data.title}}</h1>

            <!-- Author -->
            <p class=" alert alert-info" style="width: fit-content;
                padding: 5px;
                color: #142d31;" >Category : {{post.data.category.name}}
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on <strong class="badge badge-primary p-1">{{post.data.added_at}}</strong>
                <span class="float-right"><strong class="badge badge-info p-1">{{post.data.comments_count}}</strong> Comments</span></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" :src="'/assets/img/'+post.data.image" style="width:900px;max-height:300px" alt="">

            <hr>

            <!-- Post Content -->
            {{post.data.body}}
            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <div class="media mb-4" v-for="single_post in post.data.comments" :key="single_post.id">
                <img class="d-flex mr-3 rounded-circle" height="50" width="50" :src="'/assets/img/'+single_post.user.profile_img" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{single_post.user.name}}</h5>
                    {{single_post.body}}
                </div>
            </div>
        </div>
                <!-- Sidebar Widgets Column -->
        </div>
        
    </div>

    <div v-else>
        <div class="row">
            <div class="col-12 alert alert-warning">
                <strong>No Post Found !</strong>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'post',
        data(){
            return{
                post:''
            }
        },
        created(){
            this.getPost();
        },
        methods:{
            getPost:function(){
                axios.get('/api/posts/'+this.$route.params.slug)
                    .then(res => {this.post = res.data;})
                    .catch(err => {this.post = err.data;})
            }
        },
    }
</script>
