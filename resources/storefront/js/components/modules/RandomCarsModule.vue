<template>
    <div v-if="!loading" class="cars-module mx-auto max-w-8xl">
        <div class="module-head p-4">
            <h3 class="module-head-title">Explore Our Fleet</h3>
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
        <div class="cars-module-list module-body p-4">
            <Carousel v-bind="carouselConfig" ref="carouselRef">
                <Slide v-for="car in cars" :key="car.id" class="cars-module-item">
                    <CarCard
                        :name="car.name"
                        :brand="car.brand_name"
                        :model="car.model_name"
                        :image="car.image_url"
                        :category="car.category"
                        :price-per-day="car.price_per_day"
                        :seats="car.seats"
                        :baggage="car.luggage_count"
                        :fuel="car.fuel"
                        :transmission="car.transmission"
                    ></CarCard>
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
import IconArrow from '@storefront/components//icons/IconArrow.vue'
import { fetchRandomCars } from '@storefront/services/carsModuleService.js'
import { onMounted, ref } from 'vue'

const carouselRef = ref()
const cars = ref([])
const loading = ref(false)
const next = () => {
    carouselRef.value.next()
}
const prev = () => {
    carouselRef.value.prev()
}

const getRandomCars = async () => {
    loading.value = true
    try {
        const { data } = await fetchRandomCars()
        cars.value = data
        console.log(cars)
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
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

/*
const cars = [
    {
        id: 1,
        name: 'Volkswagen Golf',
        image: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=1200',
        category: 'Premium',
        pricePerDay: 35,
        seats: 5,
        baggage: 3,
        fuel: 'Petrol',
        transmission: 'Automatic',
    },
    {
        id: 2,
        name: 'BMW 3 Series',
        image: 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=1200',
        category: 'Premium',
        pricePerDay: 45,
        seats: 5,
        baggage: 4,
        fuel: 'Diesel',
        transmission: 'Automatic',
    },
    {
        id: 3,
        name: 'Audi A4',
        image: 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=1200',
        category: 'Premium',
        pricePerDay: 42,
        seats: 5,
        baggage: 4,
        fuel: 'Petrol',
        transmission: 'Automatic',
    },
    {
        id: 4,
        name: 'Mercedes-Benz C-Class',
        image: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=1200',
        category: 'Premium',
        pricePerDay: 50,
        seats: 5,
        baggage: 4,
        fuel: 'Hybrid',
        transmission: 'Automatic',
    },
]
    */

onMounted(async () => {
    await getRandomCars()
})
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
