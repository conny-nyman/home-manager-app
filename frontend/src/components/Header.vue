<template>
    <div class="container p-0">
        <transition name="fade">
            <div class="jumbotron text-center bg-dark text-white my-0 rounded-0">
                <h1>Home manager app</h1>
            </div>
        </transition>
        <transition name="fade">
            <app-slider></app-slider>
        </transition>
    </div>
</template>

<script>
    import Slider from './Slider'

    export default {
        name: 'Header',
        components: {
            appSlider: Slider
        }
    }
</script>

<style scoped>

</style>