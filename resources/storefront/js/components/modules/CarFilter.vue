<template>
    <div class="bg-white rounded-xl p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold">Filters</h3>

            <Button @click="clearFilters" label="Clear All" link size="small" />
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

        <!-- Price Range -->
        <div class="mb-8">
            <h4 class="font-medium mb-4">Price Range</h4>

            <Slider v-model="filters.priceRange" range :min="0" :max="200" class="mb-3" />

            <div class="flex justify-between text-sm text-surface-500">
                <span>${{ filters.priceRange[0] }}</span>
                <span>${{ filters.priceRange[1] }}</span>
            </div>
        </div>

        <!-- Car Types -->
        <div class="mb-8">
            <h4 class="font-medium mb-4">Car Type</h4>

            <div class="space-y-3">
                <div v-for="type in carTypes" :key="type.value" class="flex items-center gap-3">
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
            <AccordionPanel value="transmission">
                <AccordionHeader> Transmission </AccordionHeader>

                <AccordionContent>
                    <div class="space-y-3">
                        <div
                            v-for="item in transmissions"
                            :key="item.value"
                            class="flex items-center gap-3"
                        >
                            <Checkbox
                                v-model="filters.transmissions"
                                :input-id="item.value"
                                :value="item.value"
                            />

                            <label :for="item.value">
                                {{ item.label }}
                            </label>
                        </div>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>

        <Accordion :value="openPanels" multiple>
            <AccordionPanel value="fuel">
                <AccordionHeader> Fuel Type </AccordionHeader>

                <AccordionContent>
                    <div class="space-y-3">
                        <div
                            v-for="item in fuelTypes"
                            :key="item.value"
                            class="flex items-center gap-3"
                        >
                            <Checkbox
                                v-model="filters.fuelTypes"
                                :input-id="item.value"
                                :value="item.value"
                            />

                            <label :for="item.value">
                                {{ item.label }}
                            </label>
                        </div>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>

        <Accordion :value="openPanels" multiple>
            <AccordionPanel value="seats">
                <AccordionHeader> Seats </AccordionHeader>

                <AccordionContent
                    ><div class="space-y-3">
                        <div v-for="seat in seats" :key="seat" class="flex items-center gap-3">
                            <Checkbox
                                v-model="filters.seats"
                                :input-id="`seat-${seat}`"
                                :value="seat"
                            />

                            <label :for="`seat-${seat}`"> {{ seat }} Seats </label>
                        </div>
                    </div></AccordionContent
                >
            </AccordionPanel></Accordion
        >

        <Accordion :value="openPanels" multiple>
            <AccordionPanel value="luggage">
                <AccordionHeader> Luggage Capacity </AccordionHeader>

                <AccordionContent>
                    <div class="space-y-3">
                        <div
                            v-for="count in luggageCounts"
                            :key="count"
                            class="flex items-center gap-3"
                        >
                            <Checkbox
                                v-model="filters.luggageCounts"
                                :input-id="`luggage-${count}`"
                                :value="count"
                            />

                            <label :for="`luggage-${count}`"> {{ count }} Bags </label>
                        </div>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>

        <!-- Apply -->
        <Button
            class="mt-3"
            severity="contrast"
            fluid
            size="large"
            :label="`Show Results`"
            @click="doFilter"
        />
    </div>
</template>
<script setup>
import {
    Accordion,
    AccordionContent,
    AccordionHeader,
    AccordionPanel,
    Button,
    Checkbox,
    Select,
    Slider,
} from 'primevue'
import { computed, onMounted, reactive, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useLocation } from '@storefront/composables/useLocation'
const { getLocations, groupedLocations } = useLocation()

const emit = defineEmits(['filter'])
const route = useRoute()
const query = route.query

const openPanels = computed(() => {
    const panels = []

    if (query.seats) panels.push('seats')
    if (query.transmission) panels.push('transmission')
    if (query.fuel) panels.push('fuel')
    if (query.luggage_count) panels.push('luggage')

    return panels
})

const filters = reactive({
    location: null,
    priceRange: [0, 200],
    carTypes: [],
    transmissions: [],
    fuelTypes: [],
    seats: [],
    luggageCounts: [],
})

const clearFilters = () => {
    filters.location = null
    filters.priceRange = [0, 200]
    filters.carTypes = []
    filters.transmissions = []
    filters.fuelTypes = []
    filters.seats = []
    filters.luggageCounts = []
    emit('filter', filters)
}

const carTypes = [
    { label: 'SUV', value: 'suv' },
    { label: 'Sedan', value: 'sedan' },
    { label: 'Hatchback', value: 'hatchback' },
    { label: 'Coupe', value: 'coupe' },
    { label: 'Wagon', value: 'wagon' },
]

const transmissions = [
    { label: 'Automatic', value: 'automatic' },
    { label: 'Manual', value: 'manual' },
]

const fuelTypes = [
    { label: 'Petrol', value: 'petrol' },
    { label: 'Diesel', value: 'diesel' },
    { label: 'Hybrid', value: 'hybrid' },
    { label: 'Electric', value: 'electric' },
]

const seats = [2, 4, 5, 6]

const luggageCounts = [1, 2, 3, 4, 5]

const resultCount = ref(24)

const doFilter = () => {
    emit('filter', filters)
}
onMounted(() => {
    if (query.location) {
        filters.location = Number(route.query.location)
    }

    if (query.body_type) {
        filters.carTypes = Array.isArray(query.body_type) ? query.body_type : [query.body_type]
    }

    if (query.price_per_day) {
        filters.priceRange = Array.isArray(query.price_per_day)
            ? query.price_per_day
            : [query.price_per_day]
    }

    if (query.transmission) {
        filters.transmissions = Array.isArray(query.transmission)
            ? query.transmission
            : [query.transmission]
    }

    if (query.fuel) {
        filters.fuelTypes = Array.isArray(query.fuel) ? query.fuel : [query.fuel]
    }

    if (query.seats) {
        const seats = Array.isArray(query.seats) ? query.seats : [query.seats]

        filters.seats = seats.map(Number)
    }

    if (query.luggage_count) {
        const luggage = Array.isArray(query.luggage_count)
            ? query.luggage_count
            : [query.luggage_count]

        filters.luggageCounts = luggage.map(Number)
    }

    getLocations()
})
</script>
