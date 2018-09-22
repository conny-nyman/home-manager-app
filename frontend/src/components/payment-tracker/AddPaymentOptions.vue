<template>
    <div class="row m-3">
        <app-add-payment-option name="Category" :query="createCategoryMutation" updateAction="getCategories"></app-add-payment-option>
        <app-add-payment-option name="Type" :query="createTypeMutation" updateAction="getTypes"></app-add-payment-option>
        <app-add-payment-option name="Store" :query="createStoreMutation" updateAction="getStores"></app-add-payment-option>
        <app-hr></app-hr>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import AddPaymentOption from './AddPaymentOption'
    import {CREATE_CATEGORY_MUTATION} from '../../constants/graphql'
    import {CREATE_TYPE_MUTATION} from '../../constants/graphql'
    import {CREATE_STORE_MUTATION} from '../../constants/graphql'

    export default {
        name: "AddPaymentOptions",
        components: {
            appAddPaymentOption: AddPaymentOption
        },
        computed: {
            ...mapGetters({
                darkMode: 'darkMode'
            }),
            createCategoryMutation: () => CREATE_CATEGORY_MUTATION,
            createTypeMutation: () => CREATE_TYPE_MUTATION,
            createStoreMutation: () => CREATE_STORE_MUTATION
        }
    }
</script>

<style scoped>

</style>