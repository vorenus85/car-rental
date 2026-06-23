<template>
    <div class="bg-white rounded-xl p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold">Filters</h3>

            <Button label="Clear filters" link size="small" @click="clearFilters" />
        </div>

        <div class="mb-8">
            <h4 class="font-medium mb-4">Pick-up Location</h4>
            <Select
                v-model="filters.location"
                :options="groupedLocations"
                input-id="pick-up-location"
                option-group-label="label"
                option-group-children="items"
                option-label="label"
                option-value="value"
                filter
                placeholder="Select location"
                class="w-full"
            >
                <template #optiongroup="slotProps">
                    <div class="flex items-center">
                        <img
                            :alt="slotProps.option.label"
                            src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                            :class="`mr-2 flag flag-${slotProps?.option?.code?.toLowerCase()}`"
                            style="width: 18px"
                        />
                        <div>{{ slotProps.option.label }}</div>
                    </div>
                </template>
            </Select>
        </div>

        <div class="mb-8">
            <h4 class="font-medium mb-4">Pick-up Date</h4>
            <DatePicker
                v-model="filters.pickUpDate"
                :min-date="minPickUpDate"
                icon-display="input"
                date-format="yy-mm-dd"
                class="w-full"
                placeholder="Select date"
            />
        </div>

        <div class="mb-8">
            <h4 class="font-medium mb-4">Drop-off Date</h4>

            <DatePicker
                v-model="filters.dropOffDate"
                :min-date="minDropOffDate"
                icon-display="input"
                date-format="yy-mm-dd"
                class="w-full"
                placeholder="Select date"
            />
        </div>

        <!-- Price Range -->
        <div class="mb-8">
            <h4 class="font-medium mb-4">Price per Day</h4>

            <Slider
                v-model="draftPriceRange"
                range
                :min="0"
                :max="200"
                class="mb-3"
                @slideend="applyPriceFilter"
            />

            <div class="flex justify-between text-sm text-surface-500">
                <span>${{ filters.priceRange[0] }}</span>
                <span>${{ filters.priceRange[1] }}</span>
            </div>
        </div>

        <!-- Car Types -->
        <div class="mb-8">
            <h4 class="font-medium mb-4">Car Type</h4>

            <div class="space-y-3">
                <div
                    v-for="type in filterParams.carTypes"
                    :key="type.value"
                    class="flex items-center gap-3"
                >
                    <Checkbox
                        v-model="filters.carTypes"
                        :input-id="type.value"
                        :value="type.value"
                    />

                    <label :for="type.value">
                        {{ type.label }}
                    </label>
                </div>
            </div>
        </div>
        <Accordion :value="openPanels" multiple>
            <FilterCheckboxGroup
                title="Brands"
                panel-value="brand"
                :items="filterParams.brands"
                :model-value="filters.brands"
                id-prefix="seat"
                @update:model-value="filters.brands = $event"
            ></FilterCheckboxGroup>

            <FilterCheckboxGroup
                title="Transmission"
                panel-value="transmission"
                :items="filterParams.transmissions"
                :model-value="filters.transmissions"
                id-prefix="transmission"
                @update:model-value="filters.transmissions = $event"
            ></FilterCheckboxGroup>

            <FilterCheckboxGroup
                title="Fuel types"
                panel-value="fuel"
                :items="filterParams.fuelTypes"
                :model-value="filters.fuelTypes"
                id-prefix="fuel"
                @update:model-value="filters.fuelTypes = $event"
            ></FilterCheckboxGroup>

            <FilterCheckboxGroup
                title="Seats"
                panel-value="seat"
                :items="filterParams.seats"
                :model-value="filters.seats"
                id-prefix="seats"
                suffix="seats"
                @update:model-value="filters.seats = $event"
            ></FilterCheckboxGroup>

            <FilterCheckboxGroup
                title="Luggage Capacity"
                panel-value="luggage"
                :items="filterParams.luggageCounts"
                :model-value="filters.luggageCounts"
                id-prefix="luggage"
                suffix="bags"
                @update:model-value="filters.luggageCounts = $event"
            ></FilterCheckboxGroup>
        </Accordion>
        <!-- Apply -->
        <Button
            class="mt-3"
            severity="contrast"
            outlined
            fluid
            size="small"
            :label="`Clear filter`"
            @click="clearFilters"
        />
    </div>
</template>
<script setup>
import { Accordion, Button, Checkbox, DatePicker, Select, Slider } from 'primevue'
import { computed, nextTick, onMounted, reactive, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useLocation } from '@storefront/composables/useLocation'
import { useCarFilters } from '@storefront/composables/useCarFilters'
import { useBrandStore } from '@storefront/stores/useBrandStore'
import FilterCheckboxGroup from './FilterCheckboxGroup.vue'

const { filterParams } = useCarFilters()
const { getLocations, groupedLocations } = useLocation()
const emit = defineEmits(['filter'])
const route = useRoute()
const query = route.query
const brandStore = useBrandStore()
const openPanels = computed(() => {
    const panels = []

    if (query.brand) panels.push('brand')
    if (query.seat) panels.push('seat')
    if (query.transmission) panels.push('transmission')
    if (query.fuel) panels.push('fuel')
    if (query.luggageCount) panels.push('luggage')

    return panels
})

const minPickUpDate = new Date()

const minDropOffDate = new Date()
minDropOffDate.setDate(minDropOffDate.getDate() + 1)

const syncing = ref(true)

const filters = reactive({
    location: null,
    pickUpDate: null,
    dropOffDate: null,
    priceRange: [0, 200],
    brands: [],
    carTypes: [],
    transmissions: [],
    fuelTypes: [],
    seats: [],
    luggageCounts: [],
})

const draftPriceRange = ref([0, 200])

const applyPriceFilter = event => {
    filters.priceRange = event.value
}

watch(
    filters,
    () => {
        if (syncing.value) return

        emit('filter', filters)
    },
    { deep: true }
)

const clearFilters = () => {
    filters.location = null
    filters.pickUpDate = null
    filters.dropOffDate = null
    filters.priceRange = [0, 200]
    filters.brands = []
    filters.carTypes = []
    filters.transmissions = []
    filters.fuelTypes = []
    filters.seats = []
    filters.luggageCounts = []
    emit('filter', filters)
}

const hydrateFiltersFromQuery = query => {
    if (query.pickUpDate) {
        const pickUpDate = new Date(query.pickUpDate)
        pickUpDate.setHours(0, 0, 0, 0)
        filters.pickUpDate = pickUpDate
    }

    if (query.dropOffDate) {
        const dropOffDate = new Date(query.dropOffDate)
        dropOffDate.setHours(0, 0, 0, 0)
        filters.dropOffDate = dropOffDate
    }

    if (query.brand) {
        const brands = Array.isArray(query.brand) ? query.brand : [query.brand]

        filters.brands = brands.map(Number)
    }

    if (query.location) {
        filters.location = Number(query.location)
    }

    if (query.bodyType) {
        filters.carTypes = Array.isArray(query.bodyType) ? query.bodyType : [query.bodyType]
    }

    if (query.pricePerDay) {
        filters.priceRange = Array.isArray(query.pricePerDay)
            ? query.pricePerDay
            : [query.pricePerDay]
    }

    if (query.transmission) {
        filters.transmissions = Array.isArray(query.transmission)
            ? query.transmission
            : [query.transmission]
    }

    if (query.fuel) {
        filters.fuelTypes = Array.isArray(query.fuel) ? query.fuel : [query.fuel]
    }

    if (query.seat) {
        const seats = Array.isArray(query.seat) ? query.seat : [query.seat]

        filters.seats = seats.map(Number)
    }

    if (query.luggageCount) {
        const luggage = Array.isArray(query.luggageCount)
            ? query.luggageCount
            : [query.luggageCount]

        filters.luggageCounts = luggage.map(Number)
    }
}

onMounted(() => {
    hydrateFiltersFromQuery(query)

    draftPriceRange.value = filters.priceRange

    getLocations()
    brandStore.fetchBrands()

    nextTick(() => {
        syncing.value = false
    })
})
</script>
<style>
.p-accordionheader {
    --p-accordion-header-padding: 1.125rem 0;
}
.p-accordioncontent-content {
    --p-accordion-content-padding: 0 0 1.125rem 0;
}
</style>
