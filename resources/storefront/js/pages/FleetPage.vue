<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Fleet"></PageTitle>

            <div class="sort-bar-top flex py-3">
                <small> Showing {{ count }} results </small>
            </div>
            <div
                class="car-list grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6"
            >
                <template v-for="car in cars" :key="car.id">
                    <CarCard
                        :year="car.production_year"
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
                </template>
            </div></div
    ></PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import CarCard from '@storefront/components/modules/CarCard/CarCard.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { fetchCars } from '@storefront/services/carService'
import { ref, onMounted } from 'vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
]
const loading = ref(false)
const cars = ref([])
const count = ref(null)

const getCars = async params => {
    loading.value = true
    try {
        const result = await fetchCars(params)
        console.log(result)
        count.value = result.data.meta.total
        cars.value = result.data.data
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}

onMounted(async () => {
    await getCars({ transmission: 'manual' })
})
</script>
