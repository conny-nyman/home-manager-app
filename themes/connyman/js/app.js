// Add your js here..
import Vue from 'vue';
import axios from 'axios';
import moment from 'moment'

// Components
import Datepicker from 'vuejs-datepicker';
import Loading from 'vue-full-loading';
import Multiselect from 'vue-multiselect'

Vue.filter('formatDate', value => {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')
    }
});

new Vue({
    el: '#app',
    components: {
        appDatepicker: Datepicker,
        appLoading: Loading,
        appMultiselect: Multiselect
    },
    data: {
        formData: {
            sum: 0,
            categoryIds: [],
            typeIds: [],
            storeIds: [],
            dateOfPayment: ''
        },
        paymentOptions: {
            categories: [],
            types: [],
            stores: [],
            categoryTitle: '',
            typeTitle: '',
            storeTitle: ''
        },
        extraFields: {
            showCategoryField: false,
            showTypeField: false,
            showStoreField: false
        },
        tableData: {
            filter: {
                selectedCategories: [],
                selectedTypes: [],
                selectedStores: [],
                startDate: '',
                endDate: ''
            },
            payments: {}
        },
        showTotalSumTables: false,
        loadingSpinner: {
            show: false,
            label: 'GraphQL is awesome ¯\\_(ツ)_/¯'
        },
    },
    created() {
        axios.interceptors.request.use((config) => {
            this.loadingSpinner.show = true;
            return config;
        }, (error) => {
            this.loadingSpinner.show = false;
            return Promise.reject(error);
        });

        axios.interceptors.response.use((response) => {
            this.loadingSpinner.show = false;
            return response;
        }, (error) => {
            this.loadingSpinner.show = false;
            return Promise.reject(error);
        });
        // TODO: Use apollo for graphql. (this is for testing)
        this.getCategories();
        this.getTypes();
        this.getStores();
        this.getPayments();
    },
    methods: {
        getCategories() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readCategories {
                        ID
                        Title
                      }
                    }
                  `
                }
            }).then(response => {
                this.paymentOptions.categories = response.data.data.readCategories;
            });
        },
        getTypes() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readTypes {
                        ID
                        Title
                      }
                    }
                  `
                }
            }).then(response => {
                this.paymentOptions.types = response.data.data.readTypes;
            });
        },
        getStores() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readStores {
                        ID
                        Title
                      }
                    }
                  `
                }
            }).then(response => {
                this.paymentOptions.stores = response.data.data.readStores;
            });
        },
        getPayments() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readPayments(CategoryIDs: "${this.tableData.filter.selectedCategories.map(a => a.ID).join(" ")}" TypeIDs: "${this.tableData.filter.selectedTypes.map(a => a.ID).join(" ")}" StoreIDs: "${this.tableData.filter.selectedStores.map(a => a.ID).join(" ")}") {
                        edges {
                          node {
                            ID
                            Sum
                            Created
                            HouseMembers {
                              edges {
                                node {
                                  ID
                                  FirstName
                                  Surname
                                }
                              }
                            }
                            Categorys {
                              edges {
                                node {
                                  ID
                                  Title
                                }
                              }
                            }
                            Types {
                              edges {
                                node {
                                  ID
                                  Title
                                }
                              }
                            }
                            Stores {
                              edges {
                                node {
                                  ID
                                  Title
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  `
                }
            }).then(response => {
                this.tableData.payments = response.data.data.readPayments;
            });
        },
        saveCategory() {
            axios.post('paymentoptions/saveCategory',
                JSON.stringify(this.paymentOptions.categoryTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(() => {
                this.paymentOptions.categoryTitle = '';
                this.getCategories();
            });
        },
        saveType() {
            axios.post('paymentoptions/saveType',
                JSON.stringify(this.paymentOptions.typeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(() => {
                this.paymentOptions.typeTitle = '';
                this.getTypes();
            });
        },
        saveStore() {
            axios.post('paymentoptions/saveStore',
                JSON.stringify(this.paymentOptions.storeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(() => {
                this.paymentOptions.storeTitle = '';
                this.getStores();
            });
        },
        savePayment() {
            axios.post('payments/savePayment',
                JSON.stringify(this.formData),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                })
                .then(response => console.log(response))
                .catch(error => {
                    console.log(error)
                });
        }
    }
});
