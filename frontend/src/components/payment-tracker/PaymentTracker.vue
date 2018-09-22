<template>
    <div class="payment-tracker-page">
        <div class="container p-0">
            <!--Header-->
            <div class="container py-3 bg-white" :class="{'bg-dark': darkMode, 'text-white': darkMode}">
                <!--<h1>Payment tracker component</h1>-->
                <!--ManageFeatures-->
                <app-manage-features></app-manage-features>
                <app-add-payment-options v-if="features.showAddPaymentOptions"></app-add-payment-options>
                <app-add-payment v-if="features.showAddPayment"></app-add-payment>
                <!--<template v-if="extraFields.showAddPayments">-->
                <!--loop --->
                <!--</template> -->
                <!--<template v-if="extraFields.showPaymentTable">-->
                <!--loop --->
                <!--</template>-->
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import ManageFeatures from './ManageFeatures'
    import AddPaymentOptions from './AddPaymentOptions'
    import AddPayment from './AddPayment'

    export default {
        name: "PaymentTracker",
        components: {
            appManageFeatures: ManageFeatures,
            appAddPaymentOptions: AddPaymentOptions,
            appAddPayment: AddPayment
        },
        data() {
            return {}
        },
        computed: {
            ...mapGetters({
                darkMode: 'darkMode',
                features: 'features'
            })
        }
    }
</script>

<style scoped>

</style>