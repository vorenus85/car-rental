<template>
    <PublicLayout>
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <Button
                size="small"
                outlined
                severity="secondary"
                icon="pi pi-angle-left"
                label="Back"
                @click="router.push({ name: 'fleet' })"
            />
            <div class="container mx-auto py-8">
                <div class="grid gap-8 lg:grid-cols-[1.5fr_1fr_320px]">
                    <!-- Car Image -->
                    <div>
                        <div class="relative overflow-hidden rounded-lg bg-white">
                            <Image
                                :src="car?.image_url"
                                :alt="car?.name"
                                class="h-full w-full object-cover"
                                preview
                            />
                        </div>
                    </div>

                    <!-- car Info -->
                    <div>
                        <Tag :value="car?.category" class="uppercase" />

                        <h1 class="mt-4 text-4xl font-bold">
                            {{ car?.name }}
                        </h1>

                        <p class="mt-2 text-surface-500">{{ car?.production_year }}</p>

                        <p class="mt-6 leading-7 text-surface-600">
                            {{ car?.description }}
                        </p>

                        <!-- Specs -->
                        <div class="mt-8 grid grid-cols-4 gap-6">
                            <div v-tooltip="'Seats'" class="text-center flex flex-col items-center">
                                <SeatsV1 :size="20" />
                                <p class="text-sm">{{ car?.seats }}</p>
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
                                <p class="text-sm">{{ car?.luggage_count }}</p>
                            </div>

                            <div v-tooltip="'Doors'" class="text-center flex flex-col items-center">
                                <DoorsV1 :size="20" />
                                <p class="text-sm">{{ car?.doors }} doors</p>
                            </div>

                            <div v-tooltip="'Range'" class="text-center flex flex-col items-center">
                                <RangeV1 :size="20" />
                                <p class="text-sm">{{ car?.range_km }} km</p>
                            </div>

                            <div
                                v-tooltip="'Production year'"
                                class="text-center flex flex-col items-center"
                            >
                                <ProductionYearV1 :size="20" />
                                <p class="text-sm">{{ car?.production_year }}</p>
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
                                            €{{ car?.price_per_day }}
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
                                        v-model="booking.location"
                                        :options="locations"
                                        optionLabel="name"
                                        placeholder="Select location"
                                        fluid
                                    />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Pick-up Date
                                        </label>

                                        <DatePicker v-model="booking.pickupDate" fluid />
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Pick-up Time
                                        </label>

                                        <Select
                                            v-model="booking.pickupTime"
                                            :options="times"
                                            fluid
                                        />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Drop-off Date
                                        </label>

                                        <DatePicker v-model="booking.dropoffDate" fluid />
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium">
                                            Drop-off Time
                                        </label>

                                        <Select
                                            v-model="booking.dropoffTime"
                                            :options="times"
                                            fluid
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
                            <Tab value="0">Overview</Tab>
                            <Tab value="1">Features</Tab>
                            <Tab value="2">Rental terms</Tab>
                        </TabList>
                        <TabPanels>
                            <TabPanel value="0">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <div>
                                        <h3 class="px-2 mb-3">Specifications</h3>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div
                                                v-for="spec in specifications"
                                                :key="spec.label"
                                                class="flex justify-between py-1 px-2 border-b border-gray-200"
                                            >
                                                <span class="text-md text-gray-500">{{
                                                    spec.label
                                                }}</span>
                                                <span class="text-sm">{{ spec.value }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="px-2 mb-3">Description</h3>
                                        <p>{{ car?.variant_desc }}</p>
                                    </div>
                                </div>
                            </TabPanel>
                            <TabPanel value="1">
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
                            <TabPanel value="2">
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
import { onMounted } from 'vue'
import { useCar } from '@storefront/composables/useCar'
import { useRouter } from 'vue-router'
import ProductionYearV1 from '@storefront/components/icons/ProductionYearV1.vue'
import DoorsV1 from '@storefront/components/icons/DoorsV1.vue'
import MilageV1 from '../components/icons/MilageV1.vue'
import RangeV1 from '../components/icons/RangeV1.vue'

const router = useRouter()
const rentalPeriod = {}
const booking = {}
const { getCar, car, loadingCar, carId, specifications } = useCar()

onMounted(() => {
    getCar()
    console.log(car)
})
</script>
