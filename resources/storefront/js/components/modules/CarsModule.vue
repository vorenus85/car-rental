<template>
    <div v-if="!loadingCars" class="cars-module mx-auto max-w-8xl">
        <div class="module-head p-4">
            <h3 class="module-head-title">{{ title }}</h3>
            <div class="carousel-nav">
                <Button
                    severity="secondary"
                    variant="text"
                    rounded
                    class="carousel-prev"
                    @click="prev"
                    ><IconArrow orientation="left"
                /></Button>
                <Button
                    severity="secondary"
                    variant="text"
                    rounded
                    class="carousel-next"
                    @click="next"
                    ><IconArrow
                /></Button>
            </div>
        </div>
        <div
            v-if="loadingCars"
            class="car-list grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6"
        >
            <CarCardSkeleton v-for="n in 4" :key="n" />
        </div>
        <div v-else class="cars-module-list module-body p-4">
            <Carousel v-bind="carouselConfig" ref="carouselRef">
                <Slide v-for="car in cars" :key="car.id" class="cars-module-item">
                    <CarCard :car="car"></CarCard>
                </Slide>
            </Carousel>
        </div>
    </div>
</template>
<script setup>
// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide } from 'vue3-carousel'
import CarCard from '@storefront/components/modules/CarCard/CarCard.vue'
import { Button } from 'primevue'
import IconArrow from '@storefront/components/icons/IconArrow.vue'
import { ref } from 'vue'
import CarCardSkeleton from '@storefront/components/modules/CarCard/CarCardSkeleton.vue'

defineProps({
    title: {
        type: String,
        default: '',
    },
    cars: {
        type: Array,
        default: () => {},
    },
    loadingCars: {
        type: Boolean,
        default: false,
    },
})

const carouselRef = ref()
const next = () => {
    carouselRef.value.next()
}
const prev = () => {
    carouselRef.value.prev()
}

const carouselConfig = {
    itemsToShow: 1,
    itemsToScroll: 1,
    wrapAround: true,
    snapAlign: 'end',
    // breakpoints are mobile first
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
        // 200px and up
        200: {
            itemsToShow: 1,
        },
        400: {
            itemsToShow: 2,
        },
        // 400px and up
        768: {
            itemsToShow: 3,
        },
        992: {
            itemsToShow: 4,
        },
    },
}
</script>
<style scoped>
.cars-module-list {
    --carousel-padding: 0.5rem;
    .carousel {
        margin: 0 calc(var(--carousel-padding) * -1);
        width: calc(100% + calc(var(--carousel-padding) * 2));
    }

    .carousel__slide {
        padding: 0 var(--carousel-padding);
    }
}

.cars-module .module-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
</style>
<style>
.cars-module-item .car-card {
    justify-content: space-between;
    display: flex;
    align-items: center;
    flex-direction: column;
    width: 100%;
    height: 100%;
}
</style>
