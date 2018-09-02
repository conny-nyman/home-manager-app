// Add your js here..
import Vue from 'vue';
import axios from 'axios';
import moment from 'moment'

Vue.filter('formatDate', value => {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')
    }
});

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
        tableData: {
            payments: {}
        },
        showTotalSumTables: false
    },
    created() {
        // TODO: Use apollo for graphql. (this is for testing)
        this.getPayments();

      //   axios({
      //       url: 'http://localhost/house-manager-app/graphql',
      //       method: 'post',
      //       data: {
      //           query: `
      //   {
      //     readManagementGroups {
      //       edges {
      //         node {
      //           Name
      //           ID
      //           HouseMembers {
      //             edges {
      //               node {
      //                 ID
      //                 FirstName
      //                 Surname
      //                 Payments {
      //                   edges {
      //                     node {
      //                       ID
      //                       Sum
      //                       Categorys {
      //                         edges {
      //                           node {
      //                             ID
      //                             Title
      //                           }
      //                         }
      //                       }
      //                       Types {
      //                         edges {
      //                           node {
      //                             ID
      //                             Title
      //                           }
      //                         }
      //                       }
      //                       Stores {
      //                         edges {
      //                           node {
      //                             ID
      //                             Title
      //                           }
      //                         }
      //                       }
      //                     }
      //                   }
      //                 }
      //               }
      //             }
      //           }
      //         }
      //       }
      //     }
      //   }
      // `
      //       }
      //   }).then(response => {
      //       console.log(response.data);
      //   });
    },
    methods: {
        getPayments() {
            axios({
                url: 'http://localhost/house-manager-app/graphql',
                method: 'post',
                data: {
                    query: `
                    {
                      readPayments(CategoryIDs: "${this.formData.categoryIds.join(" ")}" TypeIDs: "${this.formData.typeIds.join(" ")}" StoreIDs: "${this.formData.storeIds.join(" ")}") {
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
                console.log(response.data.data.readPayments);
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
                }).then(response => console.log(response));
        },
        saveType() {
            axios.post('paymentoptions/saveType',
                JSON.stringify(this.paymentOptions.typeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
        },
        saveStore() {
            axios.post('paymentoptions/saveStore',
                JSON.stringify(this.paymentOptions.storeTitle),
                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(response => console.log(response));
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
