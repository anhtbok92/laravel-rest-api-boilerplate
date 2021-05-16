<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="#" @submit.prevent="register">
                        <div v-if="apiStatus !== 200 && apiStatus !== ''" class="form-group">
                            <div  class="alert alert-danger">
                                {{ message }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" required
                                       v-model="user.username">
                                <span v-if="error.username" class="error text-danger">
                                    {{ error.username }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                       v-model="user.password">
                            </div>
                            <span v-if="error.password" class="error text-danger">
                                    {{ error.password }}
                                </span>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required v-model="user.confirmPassword">
                                <span v-if="error.confirmPassword" class="error text-danger">
                                    {{ error.confirmPassword }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="btnRegister"
                                        data-loading-text="<i class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></i> Register">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="reg-success" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content size">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Message</h4>
                    </div>
                    <div class="modal-body text-center">
                        <h4>{{ message }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return {
                apiStatus: '',
                message: '',
                user: {
                    username: '',
                    password: '',
                    confirmPassword: ''
                },
                error: {
                    username: '',
                    password: '',
                    confirmPassword: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            register(){
                let component = this;
                $("#btnRegister").button('loading');
                axios.post('/api/regis/regis-account', this.user)
                    .then(function (response) {
                        $("#btnRegister").button('reset');
                        component.message = response.data.message;
                        component.apiStatus = response.data.code;
                        if (response.data.code === 200) {
                            Object.keys(component.user).forEach(key => component.user[key] = '')
                            Object.keys(component.error).forEach(key => component.error[key] = '')
                            $("#reg-success").modal('show');
                        }

                        if (response.data.code === 202) {
                            component.error.username = response.data.error.username;
                            component.error.password = response.data.error.password;
                            component.error.confirmPassword = response.data.error.confirmPassword;
                            component.apiStatus = 202;
                        }
                    }, function (response) {
                        console.log(response);
                    });
            }
        }
    }
</script>
