
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ 'Register' }}</div>

                    <div class="card-body">
                        <form @submit.prevent="submitForm">
<!--                        <form action="/api/register" method="post">-->
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ 'Name' }}</label>
                                <div class="col-md-6">
                                    <input v-model="name" type="text" class="form-control" required autofocus>
                                    <span v-if=" name" class="invalid-feedback" role="alert">
                    <strong>{{  name }}</strong>
                  </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ 'Email Address' }}</label>
                                <div class="col-md-6">
                                    <input v-model="email" type="email" class="form-control" required>
                                    <span v-if=" email" class="invalid-feedback" role="alert">
                    <strong>{{  email }}</strong>
                  </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ 'Password' }}</label>
                                <div class="col-md-6">
                                    <input v-model="password" type="password" class="form-control" required>
                                    <span v-if=" password" class="invalid-feedback" role="alert">
                    <strong>{{  password }}</strong>
                  </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ 'Confirm Password' }}</label>
                                <div class="col-md-6">
                                    <input v-model="password_confirmation" type="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ 'Register' }}
                                    </button>
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

                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',

                    formErrors: {}
        };
    },
    methods: {
        submitForm() {

            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register',
                    {
                        name: this.name,
                        email: this.email,
                        role: 'user',
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    })
                    .then(response => {
                        console.log('Password updated successfully', response);
                        this.$router.push({name:'password'})
                        //this.response = response.data; // Обновляем состояние для отображения ответа
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                    });
            })
        }
    }
};
</script>
