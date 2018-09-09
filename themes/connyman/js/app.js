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
import 'swiper/dist/css/swiper.css'
import {swiper, swiperSlide} from 'vue-awesome-swiper'

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
        return moment(String(value)).format('DD/MM/YYYY HH:mm')
    }
});

new Vue({
    el: '#app',
    components: {
        appDatepicker: Datepicker,
        appLoading: Loading,
        appMultiselect: Multiselect,
        appSwiper: swiper,
        appSwiperSlide: swiperSlide
    },
    data: {
        darkMode: true,
        swiperOption: {
            speed: 2000,
            parallax: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        },
        slides: [],
        index: 0,
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
            showPaymentTable: false
        },
        tableData: {
            filter: {
                houseMembers: [],
                categories: [],
                types: [],
                stores: [],
                startDate: moment().startOf('month').format('YYYY-MM-DD'),
                endDate: moment().endOf('month').format('YYYY-MM-DD')
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
        this.getSlides();
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
        validateResponse(response, name) {
            if (response.data.errors) {
                this.$snotify.error(response.data.errors[0].message);
                return false;
            }
            this.$snotify.success(`${name} saved`);
            return true;
        },
        getSlides() {
            axios({
                url: 'graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readSlides {
                        Text
                        TextWhite
                        Image {
                          File {
                            URL
                          }
                        }
                      }
                    }
                  `
                }
            }).then(response => {
                this.slides = response.data.data.readSlides;
            });
        },
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
                        ID
                        Name
                        Text
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
            }).then((response) => {
                if (this.validateResponse(response, 'Category')) {
                    this.paymentOptions.categoryTitle = '';
                    this.getCategories();
                }
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
            }).then((response) => {
                if (this.validateResponse(response, 'Type')) {
                    this.paymentOptions.typeTitle = '';
                    this.getTypes();
                }
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
            }).then((response) => {
                if (this.validateResponse(response, 'Store')) {
                    this.paymentOptions.storeTitle = '';
                    this.getStores();
                }
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
                      CategoryIDs: "${this.formData.categoryIds.map(i => i.ID).join(" ")}", 
                      TypeIDs: "${this.formData.typeIds.map(i => i.ID).join(" ")}", 
                      StoreIDs: "${this.formData.storeIds.map(i => i.ID).join(" ")}") {
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
                if (this.validateResponse(response, 'Payment')) {
                    this.getPayments();
                }
            });
        }
    }
});
