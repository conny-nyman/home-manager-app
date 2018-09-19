<template>
    <div class="payment-tracker-page">
        <div class="container p-0">
            <!--Header-->
            <div class="container py-3 bg-white" :class="{'bg-dark': darkMode, 'text-white': darkMode}">
                <!--<h1>Payment tracker component</h1>-->
                <!--ManageFeatures-->
                <app-manage-features></app-manage-features>
                <!--<template v-if="extraFields.showAddPaymentOptions">-->
                <!--loop PaymentOptions--->
                <!--</template>-->
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

    export default {
        name: "PaymentTracker",
        components: {
            appManageFeatures: ManageFeatures,
        },
        data() {
            return {}
        },
        computed: {
            ...mapGetters({
                darkMode: 'darkMode'
            })
        }
    }
</script>

<style scoped>

</style>