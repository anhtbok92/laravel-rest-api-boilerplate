<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body"></div>
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
                authenticate: {
                    username: '',
                    password: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            login(){
                let authenticate = {
                    username: this.authenticate.username,
                    password: this.authenticate.password
                };
                let component = this;
                axios.post('/api/auth/login', authenticate)
                    .then(function (response) {
                        if (response.data.code === 200) {
                            component.message = response.data.message;
                            component.apiStatus = response.data.code;
                        }
                    }, function (response) {
                        console.log(response);
                    });
            }
        }
    }
</script>
