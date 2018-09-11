<template>
    <div class="payment-tracker-page">
        <h1>Payment tracker component</h1>
        <div class="container p-0 shadow-all-corners">
            <!--Header-->
            <div class="container py-3 bg-white" :class="{'bg-dark': darkMode, 'text-white': darkMode}">
                <!--ManageFeatures-->
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
    export default {
        name: "PaymentTracker",
        data() {
            return {
                darkMode: true
            }
        }
    }
</script>

<style scoped>

</style>