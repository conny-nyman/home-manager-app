<template>
    <hr :class="{'bg-white' : darkMode}">
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "HorizontalLine",
        computed: {
            ...mapGetters({
                darkMode: 'darkMode'
            })
        }
    }
</script>

<style scoped>

</style>