import Vue from 'vue';
import Vuex from 'vuex';

// ApolloClient
// I am using apollo inside my actions even though vue-apollo is designed to be used alongside Vuex, because I want to integrate the GraphQL client into the Vuex store.
import ApolloClient from "apollo-boost"
import VueApollo from "vue-apollo"

const apolloProvider = new VueApollo({
    defaultClient: new ApolloClient({
        uri: "http://localhost/house-manager-app/graphql",
        // Basic Y29ubnk6Y29ubnkxMjM= test account.
        headers: {"authorization": "Basic Y29ubnk6Y29ubnkxMjM="}
    })
})

// GraphQL queries
import {GET_CATEGORIES_QUERY} from '../constants/graphql'
import {GET_TYPES_QUERY} from '../constants/graphql'
import {GET_STORES_QUERY} from '../constants/graphql'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        darkMode: true,
        features: {
            showAddPaymentOptions: true,
            showAddPayment: false
        },
        payments: {
            categories: [],
            types: [],
            stores: []
        }
    },
    getters: {
        darkMode: state => state.darkMode,
        features: state => state.features,
        categories: state => state.payments.categories,
        types: state => state.payments.types,
        stores: state => state.payments.stores
    },
    mutations: {
        toggleDarkMode: state => {
            state.darkMode = !state.darkMode
        },
        toggleShowAddPaymentOptions: state => {
            state.features.showAddPaymentOptions = !state.features.showAddPaymentOptions
        },
        toggleShowAddPayment: state => {
            state.features.showAddPayment = !state.features.showAddPayment
        },
        setCategories: (state, categories) => {
            state.payments.categories = categories
        },
        setTypes: (state, types) => {
            state.payments.types = types
        },
        setStores: (state, stores) => {
            state.payments.stores = stores
        }
    },
    actions: {
        async getCategories({commit}) {
            const response = await apolloProvider.defaultClient.query({
                query: GET_CATEGORIES_QUERY
            });
            commit('setCategories', response.data.readCategories);
        },
        async getTypes({commit}) {
            const response = await apolloProvider.defaultClient.query({
                query: GET_TYPES_QUERY
            });
            commit('setTypes', response.data.readTypes);
        },
        async getStores({commit}) {
            const response = await apolloProvider.defaultClient.query({
                query: GET_STORES_QUERY
            });
            commit('setStores', response.data.readStores);
        }
    }
});