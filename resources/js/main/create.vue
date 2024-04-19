<template>

  <h1 >Создать клиента</h1>

  <form  @submit.prevent="submitForm" method="POST" style="width: 50%">
    <div class="input-group mb-3" >
      <span class="input-group-text" id="basic-addon1">Введите ФИО клиента</span>
      <input type="text" class="form-control"  v-model="client.name" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3" >
      <span class="input-group-text" id="basic-addon2">Введите номер клиента</span>
      <input type="text" class="form-control"  v-model="client.phone" aria-label="Phone" aria-describedby="basic-addon2">
    </div>
    <div class="input-group mb-3" >
      <span class="input-group-text" id="basic-addon3">Введите email клиента</span>
      <input type="text" class="form-control"  v-model="client.email" aria-label="Phone" aria-describedby="basic-addon3">
    </div>

    <div class="input-group mb-3" >
      <span class="input-group-text" id="basic-addon4">Дата рождения:</span>
      <input type="date" class="form-control" v-model="client.date" aria-label="Date" aria-describedby="basic-addon4">
    </div>
      <div v-if="errors" style="background: #ba7979">
        {{ errors }}
        <!--<ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>-->
      </div>
      <div v-if="result" style="background: #4e864e">
        {{result}}
      </div>

    <button type="submit" class="btn btn-primary">Добавить</button>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data(){
    return {
      client:{},
      errors: null,
      result:null

    }
  },
  created() {
    axios.get('/api/client/create')
        .then(response => {
          console.log(response.data)
        })
  },
  methods: {
    submitForm() {
      console.log(this.client);
      axios.post('/api/client', this.client)
          .then(response => {
            this.result = response.data.result
            console.log('Password updated successfully', response.data);
          })
          .catch(error => {
            /*if (error.response.status === 422) {
              console.log(123)
              // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
              this.errors = Object.values(error.response.data.errors).flat().join(' ');
            }
            if (error.response.status === 409 && error.response.data.error === 'Duplicate entry for email') {
              this.errors = ['Duplicate entry for email'];
            }*/
            console.error(this.errors = error.message);
          });
    }
  }

}
</script>
