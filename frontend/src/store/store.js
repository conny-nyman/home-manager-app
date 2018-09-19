import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
   state: {
       darkMode: true
   },
    getters: {
       darkMode: state => state.darkMode
    },
    mutations: {
       toggleDarkMode: state => {
           state.darkMode = !state.darkMode
       }
    }
});