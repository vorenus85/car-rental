<template>
    <PublicLayout class="details-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <Button
                size="small"
                outlined
                severity="secondary"
                icon="pi pi-angle-left"
                label="Back"
                @click="goBack"
            />
            <div class="container mx-auto py-8">
                <div class="grid gap-8 lg:grid-cols-[1.5fr_1fr_320px]">
                    <!-- Car Image -->
                    <div>
                        <div class="relative overflow-hidden rounded-lg bg-white">
                            <Image
                                :src="car?.imageUrl"
                                :alt="car?.name"
                                class="h-full w-full object-cover"
                                preview
                            />
                        </div>
                    </div>

                    <!-- car Info -->
                    <div>
                        <Tag :value="car?.category" class="uppercase" severity="secondary" />

                        <h1 class="mt-4 text-4xl font-bold">
                            {{ car?.name }}
                        </h1>

                        <p class="mt-2 text-surface-500">{{ car?.productionYear }}</p>

                        <p class="mt-6 leading-7 text-surface-600">
                            {{ car?.description }}
                        </p>

                        <!-- Specs -->
                        <div class="mt-8 grid grid-cols-4 gap-6">
                            <div v-tooltip="'Seats'" class="text-center flex flex-col items-center">
                                <SeatsV1 :size="20" />
                                <p class="text-sm">{{ car?.seats }} seats</p>
                            </div>

                            <div
                                v-tooltip="'Transmission'"
                                class="text-center flex flex-col items-center"
                            >
                                <TransmissionV1 :size="20" />
                                <p class="text-sm">
                                    {{ car?.transmission }}
                                </p>
                            </div>

                            <div
                                v-tooltip="'Fuel type'"
                                class="text-center flex flex-col items-center"
                            >
                                <FuelV1 :size="20" />
                                <p class="text-sm">
                                    {{ car?.fuel }}
                                </p>
                            </div>

                            <div
                                v-tooltip="'Luggage count'"
                                class="text-center flex flex-col items-center"
                            >
                                <LuggageV1 :size="20" />
                                <p class="text-sm">{{ car?.luggageCount }} bags</p>
                            </div>

                            <div v-tooltip="'Doors'" class="text-center flex flex-col items-center">
                                <DoorsV1 :size="20" />
                                <p class="text-sm">{{ car?.doors }} doors</p>
                            </div>

                            <div v-tooltip="'Range'" class="text-center flex flex-col items-center">
                                <RangeV1 :size="20" />
                                <p class="text-sm">{{ car?.rangeKm }} km</p>
                            </div>

                            <div
                                v-tooltip="'Production year'"
                                class="text-center flex flex-col items-center"
                            >
                                <ProductionYearV1 :size="20" />
                                <p class="text-sm">{{ car?.productionYear }}</p>
                            </div>

                            <div
                                v-tooltip="'Mileage'"
                                class="text-center flex flex-col items-center"
                            >
                                <MilageV1 :size="20" />
                                <p class="text-sm">{{ car?.mileage }} km</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Card -->
                    <Card class="sticky top-6 h-fit">
                        <template #content>
                            <div class="space-y-5">
                                <div>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-4xl font-bold">
                                            €{{ car?.pricePerDay }}
                                        </span>

                                        <span class="text-surface-500"> / day </span>
                                    </div>

                                    <p class="mt-2 text-sm text-surface-500">
                                        Price includes taxes and basic insurance
                                    </p>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium">
                                        Pick-up Location
                                    </label>

                                    <Select
                                        v-model="searchParams.location"
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

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Pick-up Date
                                        </label>

                                        <DatePicker
                                            v-model="searchParams.pickUpDate"
                                            :min-date="minPickUpDate"
                                            date-format="yy-mm-dd"
                                            placeholder="Select date"
                                        />
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Pick-up Time
                                        </label>

                                        <Select
                                            v-model="searchParams.pickUpTime"
                                            :options="timeOptions"
                                            option-label="label"
                                            option-value="value"
                                            placeholder="Select time"
                                            class="w-full"
                                        />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Drop-off Date
                                        </label>

                                        <DatePicker
                                            v-model="searchParams.dropOffDate"
                                            :min-date="minDropOffDate"
                                            date-format="yy-mm-dd"
                                            class="w-full"
                                            placeholder="Select date"
                                        />
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Drop-off Time
                                        </label>

                                        <Select
                                            v-model="searchParams.dropOffTime"
                                            :options="timeOptions"
                                            option-label="label"
                                            option-value="value"
                                            placeholder="Select time"
                                            class="w-full"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium">
                                        Rental Period
                                    </label>

                                    <InputText :model-value="rentalPeriod" readonly fluid />
                                </div>

                                <Button label="Book Now" fluid size="large" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="mt-5">
                    <Tabs value="0">
                        <TabList>
                            <Tab value="0">Features</Tab>
                            <Tab value="1">Rental terms</Tab>
                        </TabList>
                        <TabPanels>
                            <TabPanel value="0">
                                <!-- Features -->
                                <div class="grid grid-cols-2 gap-y-4">
                                    <template v-for="feature in car?.features" :key="feature">
                                        <div class="flex items-center gap-2">
                                            <i class="pi pi-check-circle text-green-500" />
                                            <span>{{ feature.name }}</span>
                                        </div>
                                    </template>
                                </div>
                            </TabPanel>
                            <TabPanel value="1">
                                <div class="space-y-4">
                                    <ul class="space-y-3 text-gray-600">
                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span>Minimum driver age is 25 years.</span>
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span
                                                >A valid driver's license held for at least 2 years
                                                is required.</span
                                            >
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span
                                                >Unlimited mileage included in the rental
                                                price.</span
                                            >
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span>Basic insurance coverage is included.</span>
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span
                                                >A refundable security deposit may be required at
                                                pick-up.</span
                                            >
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span
                                                >Fuel policy: Return the vehicle with the same fuel
                                                level as received.</span
                                            >
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span
                                                >Free cancellation up to 24 hours before
                                                pick-up.</span
                                            >
                                        </li>

                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span
                                                >Additional drivers can be added for an extra
                                                fee.</span
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </Tabs>
                </div>
            </div>
        </div>
        <div class="background-white pt-3">
            <CarsModule :cars="cars" title="Similar cars" :loading-cars="loadingCars"></CarsModule>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import {
    Button,
    Card,
    DatePicker,
    Image,
    InputText,
    Select,
    Tab,
    TabList,
    TabPanel,
    TabPanels,
    Tabs,
    Tag,
} from 'primevue'
import FuelV1 from '@storefront/components/icons/FuelV1.vue'
import SeatsV1 from '@storefront/components/icons/SeatsV1.vue'
import TransmissionV1 from '@storefront/components/icons/TransmissionV1.vue'
import LuggageV1 from '@storefront/components/icons/LuggageV1.vue'
import { computed, onMounted, watch } from 'vue'
import { useRentalSearch } from '@storefront/composables/useRentalSearch'
import { useCar } from '@storefront/composables/useCar'
import { useCars } from '@storefront/composables/useCars'
import { useLocation } from '@storefront/composables/useLocation'
import { useRoute } from 'vue-router'
import { useRouter } from 'vue-router'
import ProductionYearV1 from '@storefront/components/icons/ProductionYearV1.vue'
import DoorsV1 from '@storefront/components/icons/DoorsV1.vue'
import MilageV1 from '@storefront/components/icons/MilageV1.vue'
import RangeV1 from '@storefront/components/icons/RangeV1.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { getDaysBetween } from '@storefront/utils.js'
import CarsModule from '@storefront/components/modules/CarsModule.vue'

const route = useRoute()
const router = useRouter()
const carId = route.params.id
const { getLocations, groupedLocations } = useLocation()
const { minPickUpDate, minDropOffDate, searchParams, hydrateRentalSearchFromQuery, timeOptions } =
    useRentalSearch()
const { getCar, car, loadingCar, bodyType } = useCar()
const { cars, loadingCars, getSimilarCars } = useCars()

const breadcrumbItems = computed(() => [
    {
        label: 'Fleet',
        route: '/fleet',
    },
    {
        label: bodyType.value?.label ?? '',
        route: `/fleet?bodyType=${bodyType.value?.value ?? ''}`,
    },
])

const rentalPeriod = computed(() => {
    const days = getDaysBetween(searchParams.pickUpDate, searchParams.dropOffDate)
    return days === 1 ? days + ' day' : days + ' days'
})

const goBack = () => {
    if (globalThis.history.length) {
        router.back()
    } else {
        router.push({ name: 'fleet' })
    }
}

watch(
    () => route.params.id,
    async id => {
        Promise.all([getCar(id), getSimilarCars(id)])
    }
)

onMounted(async () => {
    Promise.all([getCar(carId), getLocations(), getSimilarCars(carId)])
    hydrateRentalSearchFromQuery()
})
</script>
<style scoped>
:deep(.p-datepicker-input) {
    width: 135px;
}

:deep(.p-image-mask .p-image-toolbar) {
    --p-image-toolbar-background: rgba(0, 0, 0, 0.5);
    background: var(--p-image-toolbar-background) !important;
}

:deep(.p-image-original) {
    background: #fff !important;
}

:deep(.p-image-preview) {
    display: flex !important;
}
</style>
