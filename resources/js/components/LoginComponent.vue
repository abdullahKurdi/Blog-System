<template>
    <div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="login-form">
                            <form action="/examples/actions/confirmation.php" method="post" nonValidate>
                                <h2 class="text-center">Log in</h2>
                                <div class="form-group">
                                    <input type="email" v-model="email" class="form-control" placeholder="Email" >
                                    <div>
                                        <small v-show="emailError" class="text-danger">The email is not valid</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" v-model="password" class="form-control" placeholder="Password" >
                                    <div>
                                        <small v-show="passwordError" class="text-danger">The password is too short</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" v-show="isValidForm" @click.prevent="submitLogin">Log in</button>
                                </div>
                                <div class="clearfix">
                                    <a href="#" class="pull-right">Forgot Password?</a>
                                </div>
                            </form>
                            <p class="text-center"><a class="switch-toregister-modal" href="#">Create an Account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


    export default {
        name:'login',
        data(){
            return{
             email: '',
             password: '',
            }
        },
        computed:{
            emailError(){
                //axios
                return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.email.length > 0

            },
            passwordError(){
                return this.password.length>0 && this.password.length < 8
            },
            isValidForm(){
                return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.password.length > 7
            }
        },methods:{
            submitLogin:function(){
                console.log('submited')
                let {email,password} = this;
                this.$store.dispatch('loginUser',{email,password})
                let token = JSON.parse(localStorage.getItem('userToken'));
            if(token){
                axios.get('/api/user')
                .then(res => {
                    //console.log(res.data)
                    this.$store.commit('setUser', res.data.user);
                });
                };
                $('#login-modal').modal('hide')
            },


        }
    }
</script>
