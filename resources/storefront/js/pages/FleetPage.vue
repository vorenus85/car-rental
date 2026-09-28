<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Fleet"></PageTitle>
            <Button
                class="fleet-filter-toggle mb-4 w-full"
                icon="pi pi-filter"
                label="Filters"
                severity="contrast"
                outlined
                :aria-expanded="isMobileFilterOpen"
                aria-controls="fleet-filter-panel"
                size="large"
                @click="openMobileFilter"
            />
            <div class="flex flex-col gap-0 md:flex-row md:gap-4">
                <button
                    v-if="isMobileFilterOpen"
                    type="button"
                    class="fleet-filter-overlay"
                    aria-label="Close filters"
                    @click="closeMobileFilter"
                ></button>
                <aside
                    id="fleet-filter-panel"
                    class="fleet-filter-panel md:w-[250px] md:flex-shrink-0 col-span-1 relative"
                    :class="{ 'is-open': isMobileFilterOpen }"
                    :aria-hidden="!isMobileFilterOpen && isMobileViewport ? 'true' : null"
                    :aria-modal="isMobileFilterOpen && isMobileViewport ? 'true' : null"
                    :role="isMobileFilterOpen && isMobileViewport ? 'dialog' : null"
                    aria-labelledby="fleet-filter-title"
                >
                    <div
                        v-if="loadingCars"
                        class="absolute inset-0 z-10 flex items-center justify-center bg-white/70"
                    ></div>
                    <CarFilter
                        :show-close-button="isMobileFilterOpen && isMobileViewport"
                        @filter="onFilter"
                        @close="closeMobileFilter"
                    ></CarFilter>
                </aside>

                <div class="col-span-3 mt-6 md:mt-0 flex-1">
                    <div
                        class="sort-bar-top flex py-3 items-center justify-between mb-3 flex-col md:flex-row gap-3 md:gap-0"
                    >
                        <small class="text-xl">
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
import { onBeforeUnmount, onMounted, ref, watch } from 'vue'
import { Button, Message } from 'primevue'
import { useRoute, useRouter } from 'vue-router'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import PaginationModule from '@storefront/components/modules/PaginationModule.vue'
import SortDropdown from '@storefront/components/modules/SortDropdown.vue'
import { useFleet } from '@storefront/composables/useFleet'
import CarCardSkeleton from '@storefront/components/modules/Skeleton/CarCardSkeleton.vue'
import CarFilter from '@storefront/components/modules/CarFilter.vue'
import { formatDate } from '@storefront/utils.js'

const { getCars, cars, loadingCars, currentPage, perPage, total } = useFleet()

const route = useRoute()
const router = useRouter()
const isMobileFilterOpen = ref(false)
const isMobileViewport = ref(false)
const mobileFilterMediaQuery = ref(null)
let previousBodyOverflow = ''
let bodyScrollLocked = false

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

    if (filters?.pickUpLocation) {
        query.pickUpLocation = filters.pickUpLocation
    }

    if (filters?.dropOffLocation) {
        query.dropOffLocation = filters.dropOffLocation
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
        query.seat = filters.seats
    }

    if (filters?.brands) {
        query.brand = filters.brands
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

const lockBodyScroll = () => {
    if (bodyScrollLocked) return

    previousBodyOverflow = document.body.style.overflow
    document.body.style.overflow = 'hidden'
    bodyScrollLocked = true
}

const unlockBodyScroll = () => {
    if (!bodyScrollLocked) return

    document.body.style.overflow = previousBodyOverflow
    bodyScrollLocked = false
}

const openMobileFilter = () => {
    isMobileFilterOpen.value = true
}

const closeMobileFilter = () => {
    isMobileFilterOpen.value = false
}

const updateMobileViewport = event => {
    isMobileViewport.value = event.matches

    if (!event.matches) {
        closeMobileFilter()
    }
}

watch(
    [isMobileFilterOpen, isMobileViewport],
    ([isOpen, isMobile]) => {
        if (isOpen && isMobile) {
            lockBodyScroll()
            return
        }

        unlockBodyScroll()
    },
    { flush: 'post' }
)

const onFilter = async filters => {
    const filterQuery = buildFilters(filters)

    const query = { ...route.query, ...filterQuery }

    const FILTER_KEYS = [
        'dropOffDate',
        'pickUpDate',
        'pickUpLocation',
        'dropOffLocation',
        'pricePerDay',
        'bodyType',
        'transmission',
        'fuel',
        'seat',
        'brand',
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

onMounted(() => {
    mobileFilterMediaQuery.value = window.matchMedia('(max-width: 775.98px)')
    isMobileViewport.value = mobileFilterMediaQuery.value.matches
    if (mobileFilterMediaQuery.value.addEventListener) {
        mobileFilterMediaQuery.value.addEventListener('change', updateMobileViewport)
        return
    }

    mobileFilterMediaQuery.value.addListener(updateMobileViewport)
})

onBeforeUnmount(() => {
    unlockBodyScroll()

    if (mobileFilterMediaQuery.value?.removeEventListener) {
        mobileFilterMediaQuery.value.removeEventListener('change', updateMobileViewport)
        return
    }

    mobileFilterMediaQuery.value?.removeListener(updateMobileViewport)
})
</script>
<style scoped>
.fleet-filter-toggle,
.fleet-filter-overlay {
    display: none;
}

@media (max-width: 775.98px) {
    .fleet-filter-toggle {
        display: inline-flex;
        position: sticky;
        top: 0.75rem;
        z-index: 99;
        background: #fff;
    }

    .fleet-filter-panel {
        display: none;
    }

    .fleet-filter-panel.is-open {
        display: block;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 101;
        width: min(90vw, 35rem);
        max-width: 100%;
        overflow-y: auto;
        padding: 1rem;
        background: #fff;
        box-shadow: -1rem 0 2rem rgb(0 0 0 / 0.18);
    }

    .fleet-filter-panel.is-open :deep(.bg-white.rounded-xl) {
        min-height: 100%;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
    }

    .fleet-filter-overlay {
        display: block;
        position: fixed;
        inset: 0;
        z-index: 100;
        border: 0;
        padding: 0;
        background: rgb(15 23 42 / 0.48);
        cursor: pointer;
    }
}
</style>
