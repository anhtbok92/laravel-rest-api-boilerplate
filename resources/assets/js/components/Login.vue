<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="#" @submit.prevent="login">

                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <p v-if="error.username" class="c-red m-b-0 font-15">
                                {{ error.username }}
                            </p>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" required autofocus
                                       v-model="authenticate.username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <p v-if="error.password" class="c-red m-b-0 font-15">
                                {{ error.password }}
                            </p>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                       v-model="authenticate.password">
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

                        <div class="form-group text-center">
                            <p v-if="apiStatus !== 200" class="c-red m-b-0 font-15">
                                {{ message }}
                            </p>
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
                       console.log(response);
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
