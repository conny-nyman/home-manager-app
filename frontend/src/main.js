import Vue from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'mdbvue/build/css/mdb.css'
import './app.scss'
import ApolloClient from "apollo-boost"
import VueApollo from "vue-apollo"

const apolloProvider = new VueApollo({
    defaultClient: new ApolloClient({
        uri: "http://localhost/house-manager-app/graphql",
        headers: { "authorization": "Basic YWRtaW46YWRtaW4=" }
    })
})

Vue.use(VueApollo)

Vue.config.productionTip = false

new Vue({
    render: h => h(App),
    apolloProvider
}).$mount('#app')
