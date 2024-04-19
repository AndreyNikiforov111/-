// store/index.js
/*import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isAuthenticated: false
    },
    mutations: {
        setAuthentication(state, status) {
            state.isAuthenticated = status;
        }
    },
    actions: {
        login({ commit }) {
            commit('setAuthentication', true);
        },
        logout({ commit }) {
            commit('setAuthentication', false);
        }
    },
    getters: {
        isAuthenticated: state => state.isAuthenticated
    }
});*/


// import { createApp } from 'vue';
import { createStore } from 'vuex';

//const app = createApp(App);
const store = createStore({
    state: {
        isAuthenticated: false
    },
    mutations: {
        setAuthentication(state, status) {
            state.isAuthenticated = status;
        }
    },
    actions: {
        login({ commit }) {
            commit('setAuthentication', true);
        },
        logout({ commit }) {
            commit('setAuthentication', false);
        }
    },
    getters: {
        isAuthenticated: state => state.isAuthenticated
    }
});

//app.use(store);
export default store;
