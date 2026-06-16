<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Fleet"></PageTitle>

            <div class="sort-bar-top flex py-3 items-center justify-between mb-3">
                <small>
                    Showing <strong>{{ total }}</strong> results
                </small>
                <SortDropdown @change="onSort"></SortDropdown>
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
            </div>
            <div>
                <PaginationModule
                    class="mt-3"
                    :current-page="currentPage"
                    :per-page="perPage"
                    :total="total"
                    @change="onPaginate"
                ></PaginationModule>
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
import PaginationModule from '@storefront/components/modules/PaginationModule.vue'
import { useRoute, useRouter } from 'vue-router'
import SortDropdown from '../components/modules/SortDropdown.vue'

const route = useRoute()
const router = useRouter()

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
]
const loading = ref(false)
const cars = ref([])
const currentPage = ref(null)
const perPage = ref(null)
const total = ref(null)

const getCars = async params => {
    loading.value = true
    console.log(params)
    try {
        const result = await fetchCars(params)
        //console.log(result)
        total.value = result.data.meta.total
        currentPage.value = result.data.meta.current_page
        perPage.value = result.data.meta.per_page
        cars.value = result.data.data
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}

const onPaginate = async page => {
    const query = {
        ...route.query,
        page,
    }

    await router.push({
        query,
    })

    await getCars(query)
}

const onSort = async sort => {
    const query = {
        ...route.query,
        sort,
    }

    await router.push({
        query,
    })

    await getCars(query)
}

onMounted(async () => {
    await getCars()
})
</script>
