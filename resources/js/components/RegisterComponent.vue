<template>
    <div>
        <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="login-form">
                            <form action="/examples/actions/confirmation.php" method="post" nonvalidate>
                                <h2 class="text-center">Create New Account</h2>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="firstname" v-model="firstname">
                                    <div>
                                        <small v-show="firstnamerError" class="text-danger">The firstname is too short</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="lastname" v-model="lastname">
                                    <div>
                                        <small v-show="lastnamerError" class="text-danger">The lastname is too short</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="email" v-model="email">
                                    <div>
                                        <small v-show="emailError" class="text-danger">The email is not valid</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" v-model="password">
                                    <div>
                                        <small v-show="passwordError" class="text-danger">The password is too short</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" v-show="isValidForm" @click.prevent="submitRegister">Create Account</button>
                                </div>
                                <div class="clearfix">
                                    <a href="#" class="pull-right">Forgot Password?</a>
                                </div>
                            </form>
                            <p class="text-center">having account ?
                                <strong class="switch-tologin-modal" ><a href="#">Login</a></strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'register',
        data(){
            return{
             firstname: '',
             lastname: '',
             email: '',
             password: '',
            }
        },
        computed:{
            firstnamerError(){
                return this.firstname.length>0 && this.firstname.length<4
            },
            lastnamerError(){
                return this.lastname.length>0 && this.lastname.length<4
            },
            emailError(){
                //axios
                return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.email.length > 0

            },
            passwordError(){
                return this.password.length>0 && this.password.length < 8
            },
            isValidForm(){
                return this.firstname.length>3 && this.lastname.length > 3 && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.password.length > 7
            }
        },methods:{
            submitRegister:function(){
                // console.log('submited')
                // console.log(this.$store.getters.isLogged)
                let {firstname ,lastname,email,password} = this;
                this.$store.dispatch('registerUser',{firstname ,lastname,email,password})
                $('#register-modal').modal('hide')
            }
        }
    }
</script>
