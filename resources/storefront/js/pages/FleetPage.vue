<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Fleet"></PageTitle>
            <div class="grid grid-cols-4 gap-6">
                <aside class="col-span-1">
                    <CarFilter @filter="onFilter"></CarFilter>
                </aside>

                <div class="col-span-3">
                    <div class="sort-bar-top flex py-3 items-center justify-between mb-3">
                        <small>
                            Showing <strong>{{ total }}</strong> results
                        </small>
                        <SortDropdown @change="onSort"></SortDropdown>
                    </div>
                    <div
                        class="car-list grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-3 gap-6"
                    >
                        <template v-if="loadingCars">
                            <CarCardSkeleton v-for="n in 12" :key="n" />
                        </template>
                        <template v-for="car in cars" v-else :key="car.id">
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
                    </div>
                </div>
            </div></div
    ></PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import CarCard from '@storefront/components/modules/CarCard/CarCard.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'

import { onMounted } from 'vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import PaginationModule from '@storefront/components/modules/PaginationModule.vue'
import { useRoute, useRouter } from 'vue-router'
import SortDropdown from '../components/modules/SortDropdown.vue'
import { useCars } from '@storefront/composables/useCars'
import CarCardSkeleton from '../components/modules/CarCard/CarCardSkeleton.vue'
import CarFilter from '../components/modules/CarFilter.vue'

const { getCars, cars, loadingCars, currentPage, perPage, total } = useCars()

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

    if (filters?.carTypes.length) {
        query.body_type = filters.carTypes
    }

    if (filters?.transmissions.length) {
        query.transmission = filters.transmissions
    }

    if (filters?.fuelTypes.length) {
        query.fuel = filters.fuelTypes
    }

    if (filters?.seats.length) {
        query.seats = filters.seats
    }

    if (filters?.luggageCounts.length) {
        query.luggage_count = filters.luggageCounts
    }

    if (filters?.priceRange[0] !== 0 || filters?.priceRange[1] !== 200) {
        query.price_per_day = [filters.priceRange[0], filters.priceRange[1]]
    }

    return query
}

const onFilter = async filters => {
    const filterQuery = buildFilters(filters)

    const query = { ...route.query }

    delete query.price_per_day
    delete query.body_type
    delete query.transmission
    delete query.fuel
    delete query.seats
    delete query.luggage_count

    Object.assign(query, filterQuery)

    await router.push({ query })

    await getCars(query)
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

    await getCars(query)
}

onMounted(async () => {
    const query = {
        ...route.query,
    }
    await getCars(query)
})
</script>
