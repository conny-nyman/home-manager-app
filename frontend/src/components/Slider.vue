<template>
    <div>
        <!--<h4 v-if="$apollo.queries.slides.loading">Loading...</h4>-->
        <app-swiper :options="swiperOption">
            <app-swiper-slide v-for="(slide, index) in slides"
                              :key="index"
                              :style="{ backgroundImage: 'url(http://localhost' + slide.Image.File.URL + ')' }"
                              style="height:400px; background-size: cover;">
                <h1 style="
                        line-height: 400px;
                        background: linear-gradient(rgba(33,33,33,.9999), rgba(125, 125, 125,.20));
                        text-shadow: 0 0 2px #ccc, 0 0 2px #ccc"
                    class="text-center" :class="{'text-white' : slide.TextWhite}">{{ slide.Text }}</h1>
            </app-swiper-slide>
        </app-swiper>
    </div>
</template>

<script>
    import 'swiper/dist/css/swiper.css'
    import {swiper, swiperSlide} from 'vue-awesome-swiper'
    import {GET_SLIDES_QUERY} from '../constants/graphql'

    export default {
        name: "Slider",
        components: {
            appSwiper: swiper,
            appSwiperSlide: swiperSlide
        },
        data() {
            return {
                slides: [],
                swiperOption: {}
            }
        },
        apollo: {
            slides: {
                query: GET_SLIDES_QUERY,
                update(data) {
                    return data.readSlides;
                }
            }
        }
    }
</script>

<style scoped>

</style>