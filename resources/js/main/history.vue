<template>
  <h1>Статистика</h1>
  <!-- Форма для автоматической отправки -->
  <form @change="submitForm">
  <div class="">
    <div :class="{active: selectedDate === 'sevenDays'}" @click="changeColor('red')"     class="">7 дней</div>
    <div :class="{active: selectedDate === 'oneMonth'}" @click="changeColor('blue')"    class="">Месяц</div>
    <div :class="{active: selectedDate === 'threeMonth'}" @click="changeColor('green')"   class="">Квартал</div>
    <div :class="{active: selectedDate === 'oneYear'}" @click="changeColor('yellow')"  class="">Год</div>
  </div>


  <!-- Select для выбора определенного option -->
  <select v-model="selectedDate"  class="form-select form-select-lg mb-3" aria-label="Large select example" style="width: 50%;margin-top: 10px">

      <option value="sevenDays">{{ newStartDate }} - {{sevenDays}}</option>
      <option value="oneMonth">{{ newStartDate }} - {{oneMonth}}</option>
      <option value="threeMonth">{{ newStartDate }} - {{threeMonth}}</option>
      <option value="oneYear">{{ startDate    }} - {{oneYear}}</option>

  </select>
    <!-- Ваши поля формы здесь -->
  </form>
  <table class="table">
    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Всего в задании</th>
      <th scope="col">Доставлено</th>
    </tr>
    </thead>
    <tr v-for="(newsletter, index) in newsletters" :key="index">
      <td  scope="row">
        {{ newsletter.id }}
      </td>
      <td>
        {{ newsletter.name }}
      </td>
      <td>
        {{ newsletter.total_newsletters }}
      </td>
      <td>
        {{ newsletter.send_newsletters }}
      </td>
    </tr>
  </table>





</template>

<script>
import axios from "axios";
import moment from 'moment';


export default {
  data(){
    return {
      newsletters:[],
      startDate:'',
      newStartDate:'',
      sevenDays:'',
      oneMonth:'',
      threeMonth:'',
      oneYear:'',
      selectedDate: 'sevenDays'


    }
  },
  created() {
    if (this.startDate) {

    }

    axios.get('/api/history')
        .then(response => {
          console.log(response.data)

          this.newsletters = response.data.newsletters;
          this.startDate = response.data.dateStart;

          let originalDate = new Date(this.startDate);
          let newFormattedDate = originalDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
          this.newStartDate = newFormattedDate;

          this.sevenDays = moment(this.startDate).add(7, 'days').format('MMMM D Y');
          this.oneMonth = moment(this.startDate).add(1, 'month').format('MMMM D Y');
          this.threeMonth = moment(this.startDate).add(3, 'month').format('MMMM D Y');
          this.oneYear = moment(this.startDate).add(1, 'year').format('YYYY-MM-DD');
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
    submitForm(){
      console.log(this.selectedDate);
      axios.post('api/history', { selectedDate: this.selectedDate })
          .then(response => {
            console.log('Password updated successfully', response.data);
            this.newsletters = response.data.newsletters;
            this.startDate = response.data.dateStart;

            let originalDate = new Date(this.startDate);
            let newFormattedDate = originalDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
            this.newStartDate = newFormattedDate;

            this.sevenDays = moment(this.startDate).add(7, 'days').format('MMMM D Y');
            this.oneMonth = moment(this.startDate).add(1, 'month').format('MMMM D Y');
            this.threeMonth = moment(this.startDate).add(3, 'month').format('MMMM D Y');
            this.oneYear = moment(this.startDate).add(1, 'year').format('YYYY-MM-DD');
          })
          .catch(error => {
            //if (error.response.status === 422) {
              // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
             // this.errors = Object.values(error.response.data.errors).flat();
            //}
            console.error('An error occurred:', error);
          });
    }
  }

}
</script>
<style>
.active {
  background-color: yellow; /* Замените на цвет, который вам нужен */
}
</style>