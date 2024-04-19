import './bootstrap';
import {createApp} from 'vue'
import App from './App.vue'
import { createStore } from 'vuex';
import router from './router/router';
import store from './store';


const  app = createApp(App);
app.use(store);
app.use(router);

app.mount("#app")

