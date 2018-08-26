// Add your js here..
import Vue from 'vue';
import axios from 'axios';

let vm = new Vue({
    el: '#app',
    data: {
        formData: {
            sum: 0,
            categoryIds: [],
            typeIds: [],
            storeIds: []
        },
        paymentOptions: {
            categoryTitle: '',
            typeTitle: '',
            storeTitle: ''
        },
        extraFields: {
            showCategoryField: false,
            showTypeField: false,
            showStoreField: false
        },
        endpoints: {
            saveCategory: '',
            saveType: '',
            saveStore: '',
            savePayment: ''
        }
    },
    created() {
        axios.get('http://localhost/house-manager-app/paymentendpoints/getEndpoints').then(response => this.endpoints = response.data);
    },
    methods: {
        saveCategory() {
            axios.post(this.endpoints.saveCategory,
                JSON.stringify(this.paymentOptions.categoryTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        saveType() {
            axios.post(this.endpoints.saveType,
                JSON.stringify(this.paymentOptions.typeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        saveStore() {
            axios.post(this.endpoints.saveStore,
                JSON.stringify(this.paymentOptions.storeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        savePayment() {
            axios.post(this.endpoints.savePayment,
                JSON.stringify(this.formData),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                })
                .then(response => console.log(response))
                .catch(error => { console.log(error) });
        }
    }
});
