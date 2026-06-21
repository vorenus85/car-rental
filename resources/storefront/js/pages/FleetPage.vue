<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Fleet"></PageTitle>
            <div class="flex flex-col gap-0 md:flex-row md:gap-4">
                <aside class="md:w-[250px] md:flex-shrink-0 col-span-1 relative">
                    <div
                        v-if="loadingCars"
                        class="absolute inset-0 z-10 flex items-center justify-center bg-white/70"
                    ></div>
                    <CarFilter @filter="onFilter"></CarFilter>
                </aside>

                <div class="col-span-3 mt-6 md:mt-0 flex-1">
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
                                <CarCard :car="car"></CarCard> </template
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
import { watch } from 'vue'
import { Message } from 'primevue'
import { useRoute, useRouter } from 'vue-router'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import PaginationModule from '@storefront/components/modules/PaginationModule.vue'
import SortDropdown from '@storefront/components/modules/SortDropdown.vue'
import { useFleet } from '@storefront/composables/useFleet'
import CarCardSkeleton from '@storefront/components/modules/CarCard/CarCardSkeleton.vue'
import CarFilter from '@storefront/components/modules/CarFilter.vue'
import { formatDate } from '@storefront/utils.js'

const { getCars, cars, loadingCars, currentPage, perPage, total } = useFleet()

const route = useRoute()
const router = useRouter()

const breadcrumbItems = [
    {
        label: 'Fleet',
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

    if (filters?.pickUpDate) {
        query.pickUpDate = formatDate(filters.pickUpDate)
    }

    if (filters?.dropOffDate) {
        query.dropOffDate = formatDate(filters.dropOffDate)
    }

    if (filters?.location) {
        query.location = filters.location
    }

    if (filters?.carTypes) {
        query.bodyType = filters.carTypes
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
        query.luggageCount = filters.luggageCounts
    }

    if (filters?.priceRange[0] !== 0 || filters?.priceRange[1] !== 200) {
        query.pricePerDay = [filters.priceRange[0], filters.priceRange[1]]
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
        'dropOffDate',
        'pickUpDate',
        'location',
        'pricePerDay',
        'bodyType',
        'transmission',
        'fuel',
        'seats',
        'luggageCount',
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
</script>
