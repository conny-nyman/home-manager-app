import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        darkMode: true,
        showAddPaymentOptions: true
    },
    getters: {
        darkMode: state => state.darkMode,
        showAddPaymentOptions: state => state.showAddPaymentOptions
    },
    mutations: {
        toggleDarkMode: state => {
            state.darkMode = !state.darkMode
        },
        toggleShowAddPaymentOptions: state => {
            state.showAddPaymentOptions = !state.showAddPaymentOptions
        }
    }
});