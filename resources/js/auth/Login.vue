<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ 'Login' }}</div>

                    <div class="card-body">
                       <form  method="POST"  @submit.prevent="submitForm" ><!--action="/api/login"-->


                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ 'Email Address' }}</label>

                                <div class="col-md-6">
                                    <input v-model="email" type="email" class="form-control" required autofocus>

                                    <span v-if="email" class="invalid-feedback" role="alert">
                                        <strong>{{ email }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ 'Password' }}</label>

                                <div class="col-md-6">
                                    <input v-model="password" type="password" class="form-control" required>
                                    <span v-if="password" class="invalid-feedback" role="alert">
                                        <strong>{{ password }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input v-model="remember" type="checkbox">
                                        <label>{{ 'Remember Me' }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ 'Login' }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ 'Forgot Your Password?' }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";

export default {
    data() {
        return {

                email: '',
                password: '',
                remember: false,

            formErrors: {}
        };
    },
    methods: {

            submitForm() {
                console.log({
                    password: this.password,
                    email: this.email,
                    remember: this.remember
                })
                axios.get('/sanctum/csrf-cookie').then(response =>{
                    console.log(123);
                    axios.post('/login', {
                        password: this.password,
                        email: this.email,
                        remember: this.remember
                    } )
                        .then(response => {
                            console.log('Password updated successfully', response);
                            this.$router.push({name:'password'})
                        })
                        .catch(error => {
                            console.error('An error occurred:', error.response);
                        });
                })

            }


    }
};
</script>
