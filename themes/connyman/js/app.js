// Add your js here..
import Vue from 'vue';
import axios from 'axios';
import moment from 'moment'

// Components
import Datepicker from 'vuejs-datepicker';
import Loading from 'vue-full-loading';
import VueCurrencyFilter from 'vue-currency-filter';
import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.min.css";
import Snotify from 'vue-snotify';
import 'vue-snotify/styles/material.css';

Vue.use(VueCurrencyFilter,
    {
        symbol: '€',
        thousandsSeparator: '.',
        fractionCount: 2,
        fractionSeparator: ',',
        symbolPosition: 'back',
        symbolSpacing: true
    });

Vue.use(Snotify);

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
            dateOfPayment: moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
        },
        paymentOptions: {
            managementGroup: {},
            houseMembers: [],
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
            showStoreField: false,
            showAddPaymentOptions: false,
            showAddPayments: false,
            showPaymentTable: true
        },
        tableData: {
            filter: {
                houseMembers: [],
                categories: [],
                types: [],
                stores: [],
                startDate: '',
                endDate: ''
            },
            payments: {}
        },
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
        this.getManagementGroup();
        this.getCategories();
        this.getTypes();
        this.getStores();
        this.getPayments();
        this.getHouseMembers();
    },
    computed: {
        paymentSum() {
            if (Array.isArray(this.tableData.payments)) {
                return this.tableData.payments.map(item => item.Sum).reduce((prev, next) => prev + next);
            }
            return '';
        },
        sortedPayments() {
            if (Array.isArray(this.tableData.payments)) {
                this.tableData.payments.sort((a, b) => {
                    return new Date(b.DateOfPayment) - new Date(a.DateOfPayment);
                });
                return this.tableData.payments;
            } else {
                return []
            }
        }
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
                      readPayments(
                      HouseMemberIDs: "${this.tableData.filter.houseMembers.map(a => a.ID).join(" ")}" 
                      CategoryIDs: "${this.tableData.filter.categories.map(a => a.ID).join(" ")}" 
                      TypeIDs: "${this.tableData.filter.types.map(a => a.ID).join(" ")}" 
                      StoreIDs: "${this.tableData.filter.stores.map(a => a.ID).join(" ")}"
                      StartDate: "${ this.tableData.filter.endDate ? moment(this.tableData.filter.startDate).format('YYYY-MM-DD') : ''}"
                      EndDate: "${ this.tableData.filter.endDate ? moment(this.tableData.filter.endDate).format('YYYY-MM-DD') : ''}"
                      ) {
                        ID
                        Sum
                        DateOfPayment
                        HouseMembers {
                              ID
                              FirstName
                              Surname
                        }
                        Categories {
                              ID
                              Title
                        }
                        Types {
                              ID
                              Title
                        }
                        Stores {
                              ID
                              Title
                        }
                      }
                    }
                  `
                }
            }).then(response => {
                this.tableData.payments = response.data.data.readPayments;
            });
        },
        getHouseMembers() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readHouseMembers {
                        ID
                        FirstName
                        Surname
                      }
                    }
                  `
                }
            }).then(response => {
                this.paymentOptions.houseMembers = response.data.data.readHouseMembers;
            });
        },
        getManagementGroup() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readManagementGroups {
                        ID,
                        Name
                      }
                    }
                  `
                }
            }).then(response => {
                this.paymentOptions.managementGroup = response.data.data.readManagementGroups[0];
            });
        },
        saveCategory() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    mutation {
                      createCategory(Input: {Title: "${this.paymentOptions.categoryTitle}"}) {
                        ID
                        Title
                      }
                    }
                  `
                }
            }).then(() => {
                this.paymentOptions.categoryTitle = '';
                this.getCategories();
            });
        },
        saveType() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    mutation {
                      createType(Input: {Title: "${this.paymentOptions.typeTitle}"}) {
                        ID
                        Title
                      }
                    }
                  `
                }
            }).then(() => {
                this.paymentOptions.typeTitle = '';
                this.getTypes();
            });
        },
        saveStore() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    mutation {
                      createStore(Input: {Title: "${this.paymentOptions.storeTitle}"}) {
                        ID
                        Title
                      }
                    }
                  `
                }
            }).then(() => {
                this.paymentOptions.storeTitle = '';
                this.getStores();
            });
        },
        savePayment() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    mutation {
                      createPayment(
                      Input: {Sum: ${this.formData.sum}, DateOfPayment: "${this.formData.dateOfPayment ? moment(this.formData.dateOfPayment).format('YYYY-MM-DD HH:mm:ss') : ''}"}, 
                      CategoryIDs: "${this.formData.categoryIds.join(" ")}", 
                      TypeIDs: "${this.formData.typeIds.join(" ")}", 
                      StoreIDs: "${this.formData.storeIds.join(" ")}") {
                        ID
                        Sum
                        Categories {
                          ID
                          Title
                        }
                        Types {
                          ID
                          Title
                        }
                        Stores {
                          ID
                          Title
                        }
                      }
                    }
                  `
                }
            }).then((response) => {
                this.getPayments();
                if (response.data.errors) {
                    this.$snotify.error(response.data.errors[0].message);
                } else {
                    this.$snotify.success('Payment saved');
                }
            }).catch(error => {
                console.log(error)
            });
        }
    }
});
