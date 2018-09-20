<template>
    <div id="app" class="container-fluid p-0 bg-dark">
        <div class="container p-0 shadow-all-corners">
            <!--<app-loading :show="loadingSpinner.show" :label="loadingSpinner.label"></app-loading>-->
            <!--<vue-snotify></vue-snotify>-->
            <app-header></app-header>
            <div v-if="mGroup.Name" class="py-3 bg-white" :class="{'bg-dark': darkMode, 'text-white': darkMode}">
                <h3 class="text-center">Welcome {{ mGroup.Name }}!</h3>
                <p class="text-center">{{ mGroup.Text }}</p>
                <app-hr></app-hr>
            </div>
            <app-payment-tracker></app-payment-tracker>
            <vue-snotify></vue-snotify>
        </div>
    </div>
</template>

<script>
    import Header from './components/Header.vue'
    import PaymentTracker from './components/PaymentTracker/PaymentTracker.vue'
    import {GET_MANAGEMENT_GROUPS_QUERY} from './constants/graphql'
    import {mapGetters} from 'vuex'

    export default {
        name: 'app',
        components: {
            appHeader: Header,
            appPaymentTracker: PaymentTracker
        },
        data() {
            return {
                mGroup: {}
            }
        },
        computed: {
            ...mapGetters({
                darkMode: 'darkMode'
            })
        },
        apollo: {
            mGroup: {
                query: GET_MANAGEMENT_GROUPS_QUERY,
                update(data) {
                    if (data.readManagementGroups) {
                        return data.readManagementGroups[0];
                    }
                }
            }
        }
    }
</script>

<style>

</style>
