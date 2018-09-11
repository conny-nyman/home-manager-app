<template>
    <div id="app" class="container-fluid p-0">
        <div class="container p-0 shadow-all-corners">
            <!--<app-loading :show="loadingSpinner.show" :label="loadingSpinner.label"></app-loading>-->
            <!--<vue-snotify></vue-snotify>-->
            <app-header></app-header>
            <app-payment-tracker></app-payment-tracker>
        </div>
    </div>
</template>

<script>
    import Header from './components/Header.vue'
    import PaymentTracker from './components/PaymentTracker/PaymentTracker.vue'

    export default {
        name: 'app',
        components: {
            appHeader: Header,
            appPaymentTracker: PaymentTracker
        }
    }
</script>

<style>

</style>
