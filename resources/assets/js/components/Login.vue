<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="#" @submit.prevent="login">
                        <div v-if="apiStatus !== 200 && apiStatus !== ''" class="form-group">
                            <div  class="alert alert-danger">
                                {{ message }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" required autofocus
                                       v-model="authenticate.username">
                                <span v-if="error.username" class="error text-danger">
                                    {{ error.username }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                       v-model="authenticate.password">
                                <span v-if="error.password" class="error text-danger">
                                    {{ error.password }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="btnLogin"
                                        data-loading-text="<i class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></i> Login">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import * as MutationTypes from '../store/auth/MutationTypes';

    export default {
        data() {
            return {
                apiStatus: '',
                message: '',
                authenticate: {
                    username: '',
                    password: ''
                },
                error: {
                    username: '',
                    password: ''
                }
            }
        },
        components: {
            // Loading
        },
        mounted() {
        },
        methods: {
            login() {
                let authenticate = {
                    username: this.authenticate.username,
                    password: this.authenticate.password
                };
                let component = this;
                $("#btnLogin").button('loading');
                axios.post('/api/auth/login', authenticate)
                    .then(function (response) {
                        $("#btnLogin").button('reset');
                        if (response.data.code === 200) {
                            component.$store.dispatch(MutationTypes.LOGIN, response);
                            component.$router.push('home');
                        } else {
                            component.message = response.data.message;
                            component.apiStatus = response.data.code;
                            component.error.username = response.data.error.username;
                            component.error.password = response.data.error.password;
                        }
                    }, function (response) {
                        console.log(response);
                    });
            }
        }
    }
</script>
