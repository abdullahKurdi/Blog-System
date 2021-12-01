<template>
<div id="editPostModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form enctype="multipart/form-data" novalidate >
					<div class="modal-header">
						<h4 class="modal-title">Edit Post</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>title</label>
							<input type="text" class="form-control" required v-model="PostToEdit.title">
						</div>
						<div class="form-group">
							<label>body</label>
							<textarea name=""  cols="30" class="form-control"
                            rows="10" v-model="PostToEdit.body"></textarea>
						</div>
						<div class="form-group">
							<label>category</label>
							<select name="" class="form-control" v-if="PostToEdit.category" v-model="PostToEdit.category.id" >
								<option value="0" disabled selected>choose category</option>
                                <option v-for="(category,index) in categories.data" :key="index" :value="category.id">{{category.name}}</option>
                            </select>
						</div>
						<div class="form-group">
							<label>image</label>
                            <img :src="'assets/img/'+PostToEdit.image" style="height:60px ; width:60px; border:1px solid;" >
							<input type="file" class="form-control" required @change="onImageChange">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn " value="Save" @click.prevent="updatePost">
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    data(){
        return{
            categories:'',
        }
    },
    created() {
        this.getCtegories();
    },
    methods:{
        getCtegories:function (){
            axios.get('/api/admin/categories')
            .then(res => {
                console.log(res.data)
                this.categories = res.data;
                localStorage.setItem('admin-posts',JSON.stringify(this.categories))
            })
            .catch(err => console.log(err))
        },
        onImageChange(event){
            console.log(event.target.files[0]);
            this.PostToEdit.image = event.target.files[0]
        },
        updatePost(){
            let config={
                headers : {"content-type" : 'multipart/form-data'}
            }
            let formdata = new FormData();
            formdata.append('id',this.PostToEdit.id)
            formdata.append('title',this.PostToEdit.title)
            formdata.append('body',this.PostToEdit.body)
            formdata.append('image',this.PostToEdit.image)
            formdata.append('category_id',this.PostToEdit.category_id)

            axios.post('/api/admin/update-post',formdata,config)
            .then(res => {
                console.log(res.data.image)
                // this.title='';
                // this.body='';
                // this.category='';
                // this.image='';
                this.PostToEdit.image = res.data.data.image
                $('#editPostModal').modal('hide')
                $('#addPostModal').modal('hide')
            })
            .catch(err => console.log(err))
        }
    },computed:{
        PostToEdit(){
             return this.$store.getters.PostToEdit;
        }

    }
}
</script>

<style>

</style>
