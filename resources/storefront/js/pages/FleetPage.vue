<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Fleet"></PageTitle>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-0 md:gap-4">
                <aside class="col-span-1 relative">
                    <div
                        v-if="loadingCars"
                        class="absolute inset-0 z-10 flex items-center justify-center bg-white/70"
                    ></div>
                    <CarFilter @filter="onFilter"></CarFilter>
                </aside>

                <div class="col-span-3 mt-6 md:mt-0">
                    <div class="sort-bar-top flex py-3 items-center justify-between mb-3">
                        <small>
                            Showing <strong>{{ total }}</strong> results
                        </small>
                        <SortDropdown @change="onSort"></SortDropdown>
                    </div>
                    <template v-if="cars.length === 0">
                        <Message class="w-full">No cars found matching your filters.</Message>
                    </template>
                    <div
                        class="car-list grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-3 gap-6"
                    >
                        <template v-if="loadingCars">
                            <CarCardSkeleton v-for="n in 12" :key="n" />
                        </template>
                        <template v-else>
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
                                ></CarCard> </template
                        ></template>
                    </div>
                    <div>
                        <PaginationModule
                            class="mt-3"
                            :current-page="currentPage"
                            :per-page="perPage"
                            :total="total"
                            @change="onPaginate"
                        ></PaginationModule>
                    </div>
                </div>
            </div></div
    ></PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import CarCard from '@storefront/components/modules/CarCard/CarCard.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'

import { onMounted, watch } from 'vue'
import { Message, ProgressSpinner } from 'primevue'
import { useRoute, useRouter } from 'vue-router'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import PaginationModule from '@storefront/components/modules/PaginationModule.vue'
import SortDropdown from '@storefront/components/modules/SortDropdown.vue'
import { useFleet } from '@storefront/composables/useFleet'
import CarCardSkeleton from '@storefront/components/modules/CarCard/CarCardSkeleton.vue'
import CarFilter from '@storefront/components/modules/CarFilter.vue'

const { getCars, cars, loadingCars, currentPage, perPage, total } = useFleet()

const route = useRoute()
const router = useRouter()

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
]

const onPaginate = async page => {
    if (currentPage.value === page) {
        return
    }
    const query = {
        ...route.query,
        page,
    }

    await router.push({
        query,
    })

    await getCars(query)
}

const buildFilters = filters => {
    const query = {}

    if (filters?.location) {
        query.location = filters.location
    }

    if (filters?.carTypes) {
        query.body_type = filters.carTypes
    }

    if (filters?.transmissions) {
        query.transmission = filters.transmissions
    }

    if (filters?.fuelTypes) {
        query.fuel = filters.fuelTypes
    }

    if (filters?.seats) {
        query.seats = filters.seats
    }

    if (filters?.luggageCounts) {
        query.luggage_count = filters.luggageCounts
    }

    if (filters?.priceRange[0] !== 0 || filters?.priceRange[1] !== 200) {
        query.price_per_day = [filters.priceRange[0], filters.priceRange[1]]
    }

    return query
}
watch(
    () => route.query,
    query => getCars(query),
    { immediate: true }
)

const onFilter = async filters => {
    const filterQuery = buildFilters(filters)

    const query = { ...route.query, ...filterQuery }

    const FILTER_KEYS = [
        'drop-off-date',
        'pick-up-date',
        'location',
        'price_per_day',
        'body_type',
        'transmission',
        'fuel',
        'seats',
        'luggage_count',
    ]

    FILTER_KEYS.forEach(key => delete query[key])

    Object.assign(query, filterQuery)

    await router.push({ query })
}

const onSort = async sort => {
    if (route.query.sort === sort) {
        return
    }
    const query = {
        ...route.query,
        sort,
    }

    await router.push({
        query,
    })
}

onMounted(async () => {})
</script>
