<template>
    <div class="row text-md-center">
        <div class="col-md-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="add-payment-options" value="add-payment-options">
                <label class="custom-control-label" for="add-payment-options">Add payment options</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="add-payments" value="add-payments">
                <label class="custom-control-label" for="add-payments">Add payments</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="show-payment-table" value="show-payment-table">
                <label class="custom-control-label" for="show-payment-table">Show payment table</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="dark-mode" value="dark-mode" @click="toggleDarkMode" :checked="darkMode">
                <label class="custom-control-label" for="dark-mode">Enable dark mode</label>
            </div>
        </div>
        <div class="col-md-12 px-0">
            <hr :class="{'bg-white' : darkMode}">
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {mapMutations} from 'vuex'

    export default {
        name: "PaymentOptions",
        computed: {
            ...mapGetters({
                darkMode: 'darkMode'
            })
        },
        methods: {
            ...mapMutations({
                toggleDarkMode: 'toggleDarkMode',
            })
        }
    }
</script>

<style scoped>

</style>