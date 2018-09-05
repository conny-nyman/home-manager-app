// Add your js here..
import Vue from 'vue';
import axios from 'axios';
import moment from 'moment'

// Components
import Datepicker from 'vuejs-datepicker';
import Loading from 'vue-full-loading';
import Multiselect from 'vue-multiselect';
import VueCurrencyFilter from 'vue-currency-filter';

Vue.use(VueCurrencyFilter,
    {
        symbol : '€',
        thousandsSeparator: '.',
        fractionCount: 2,
        fractionSeparator: ',',
        symbolPosition: 'back',
        symbolSpacing: true
    });

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
        this.getCategories();
        this.getTypes();
        this.getStores();
        this.getPayments();
        this.getHouseMembers();
    },
    computed: {
        paymentSum() {
            if (this.tableData.payments.edges) {
                return this.tableData.payments.edges.map(item => item.node.Sum).reduce((prev, next) => prev + next);
            }
            return '';
        },
        sortedPayments() {
            if (this.tableData.payments.edges) {
                this.tableData.payments.edges.sort((a, b) => {
                    return new Date(b.node.DateOfPayment) - new Date(a.node.DateOfPayment);
                });
                return this.tableData.payments.edges;
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
                        edges {
                          node {
                            ID
                            Sum
                            DateOfPayment
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
            this.formData.dateOfPayment ? moment(this.formData.dateOfPayment).format('YYYY-MM-DD') : '';
            axios.post('payments/savePayment',
                JSON.stringify(this.formData),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                })
                .then(() => this.getPayments())
                .catch(error => {
                    console.log(error)
                });
        }
    }
});
