<template>
  <h1>Создать рассылку</h1>
  <form  @submit.prevent="submitForm" method="POST">
  <div class="" style="width: 50%">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Название рассылки</label>
      <input type="text" class="form-control" v-model="sms.name" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>


    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Текст рассылки</label>
      <textarea v-model="sms.content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="">Рассылку получат {{count}}/{{count}}</div>

    <div class="">Выберите тип рассылки</div>
    <div style="display: flex;gap: 80px;">
      <div class="">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" v-model="sms.choice" value="option1">
          <label class="form-check-label" for="flexRadioDefault1">
            Разовая рассылка по времени
          </label>
        </div>
      <div class="cs-form">
        <input  type="time" class="form-control" v-model="sms.time">
      </div>

    </div>
      <div class="form-check" >
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" v-model="sms.choice" value="option2">
        <label class="form-check-label" for="flexRadioDefault2">
          Отправка ежедневно за 7 дней до дня рождения в 10:30
        </label>
      </div>
    </div>

     <div v-if="errors" style="background: #ba7979">
       {{errors}}
<!--      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>-->
    </div>
    <div class="" v-if="result"style="background: #567b56">
      {{result}}
    </div>

    <button class="btn btn-primary" type="submit">Добавить</button>

  </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data(){
    return {
      sms:{},
      count:'',
      errors:null,
      selectedOption: '',
      result:null
    }
  },
  created() {
    axios.get('/api/newsletter')
        .then(response => {
          console.log(response.data)
          this.count = response.data.count
        })
  },
  methods: {
    submitForm() {
      console.log(this.sms);
      axios.post('/api/newsletter', this.sms)
          .then(response => {
            this.result = response.data.result
            console.log('Password updated successfully', response.data);
          })
          .catch(error => {
            /*if (error.response.status === 422) {
              // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
              this.errors = Object.values(error.response.data.errors).flat();
            }*/
            console.error(this.errors = error.message);
          });
    }
  }

}
</script>
