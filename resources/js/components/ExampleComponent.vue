<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Menu</div>
                  
                    <div class="card-body">
                        <router-link to="/login">Login</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/register">Register</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/client/create">Создать клиента</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/client">Все клиенты</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/newsletter">Рассылки</router-link>
                    </div>
                  <div class="card-body">
                        <router-link to="/history">Статистика</router-link>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <router-view/>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            /*logout(){
                axios.post('/logout').then( res =>{
                    this.$router.push({name:'user.login'})
                })
            }*/
        }
    }
</script>
