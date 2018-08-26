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
        }
    },
    methods: {
        addCategory() {
            axios.post('http://localhost/house-manager-app/paymentoptions/saveCategory',
                JSON.stringify(this.paymentOptions.categoryTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        addType() {
            axios.post('http://localhost/house-manager-app/paymentoptions/saveType',
                JSON.stringify(this.paymentOptions.typeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        addStore() {
            axios.post('http://localhost/house-manager-app/paymentoptions/saveStore',
                JSON.stringify(this.paymentOptions.storeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        savePayment() {
            axios.post('http://localhost/house-manager-app/payments/savePayment',
                JSON.stringify(this.formData),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        }
    }
});
