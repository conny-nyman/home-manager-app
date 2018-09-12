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
        // Basic Y29ubnk6Y29ubnkxMjM= test account.
        headers: { "authorization": "Basic Y29ubnk6Y29ubnkxMjM=" }
    })
})

Vue.use(VueApollo)

Vue.config.productionTip = false

new Vue({
    apolloProvider,
    render: h => h(App)
}).$mount('#app')
