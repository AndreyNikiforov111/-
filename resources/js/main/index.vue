<template>
  <h1>Импорт клиентов</h1>
<div class="" style="display: flex;flex-direction: column-reverse; gap: 50px;">
  <table class="table">
    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Телефон</th>
      <th scope="col">Email</th>
      <th scope="col">День рождения</th>
    </tr>
    </thead>
    <tr v-for="item in clients" :key="clients.id">
      <td><div>{{ item.id}}   </div></td>
      <td><div>{{ item.name}}  </div></td>
      <td><div>{{ item.phone}}  </div></td>
      <td><div>{{ item.email}} </div></td>
      <td><div>{{ item.birthdate}} </div></td>
    </tr>
  </table>




  <form @submit.prevent="importFile" method="POST" enctype="multipart/form-data">
    <div class="input-group mb-3">
      <label class="input-group-text" for="inputGroupFile02">Upload</label>
      <input type="file" name="file" v-on:change="handleFileChange"  class="form-control" id="inputGroupFile02">
    </div>

    <div v-if="errors" style="background: #ba7979">
      {{errors}}
<!--      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>-->
    </div>
    <div class="" v-if="result" style="background: #4e864e">
      {{result}}
    </div>

    <button type="submit">Загрузить </button>
  </form>
  </div>



</template>

<script>
import axios from "axios";

export default {
  data(){
    return {
      clients:[],
      file:null,
      errors:'',
      result:null

    }
  },
  created() {
    axios.get('/api/client')
        .then(response => {
          this.clients = response.data.clients;

        })
        .catch(error => {
          console.error('An error occurred:', error);
          if(error.response.status === 401){
            this.$router.push('/login');
          }
          console.error('An error occurred:', error);
          return Promise.reject(error);
        });
  },
  methods: {
    importFile() {
      let formData = new FormData();
      formData.append('file', this.file);

      axios.post('api/client/import', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
        this.result = response.data.result
        console.log('Password updated successfully', response.data);
      })
          .catch(error => {
            if (error.response.status === 422) {
              // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
              this.errors = Object.values(error.response.data.errors).flat();
            }
            console.error('An error occurred:', error);
          });
      },
    handleFileChange(event) {
      // Access the selected file from the event

      this.file = event.target.files[0];
      console.log(this.file);
      // Perform actions with the selected file
    }
  }

}
</script>
