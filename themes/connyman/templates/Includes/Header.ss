<div class="container p-0">
    <transition name="fade">
        <div v-if="paymentOptions.managementGroup.Text"
             class="jumbotron text-center bg-dark text-white my-0 rounded-0">
            <h1>Home manager app</h1>
        </div>
    </transition>
    <transition name="fade">
        <template v-if="slides.length > 0">
            <app-swiper :options="swiperOption">
                <app-swiper-slide v-for="(slide, index) in slides"
                                  :key="index"
                                  :style="{ backgroundImage: 'url(' + slide.Image.File.URL + ')' }"
                                  style="height:400px; background-size: cover;">
                    <h1 style="
                        line-height: 400px;
                        font-size: 100px;
                        background: linear-gradient(rgba(33,33,33,.9999), rgba(125, 125, 125,.20));
                        text-shadow: 0 0 2px #ccc, 0 0 2px #ccc"
                        class="text-center" :class="{'text-white' : slide.TextWhite}">{{ slide.Text }}</h1>
                </app-swiper-slide>
                <%--<template v-if="slides.length > 1">--%>
                    <%--<div class="swiper-pagination" slot="pagination"></div>--%>
                    <%--<div class="swiper-button-prev" slot="button-prev"></div>--%>
                    <%--<div class="swiper-button-next" slot="button-next"></div>--%>
                <%--</template>--%>
            </app-swiper>
        </template>
    </transition>
</div>