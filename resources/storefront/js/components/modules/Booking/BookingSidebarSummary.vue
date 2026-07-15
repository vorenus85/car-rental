<template>
    <Card class="rounded-2xl shadow-sm booking-sidebar-summary">
        <template #content>
            <div class="space-y-6">
                <!-- Title -->
                <h2 class="text-lg font-semibold text-surface-900">Booking Summary</h2>

                <!-- Car -->
                <div class="flex items-center gap-4 cursor-pointer" @click="backToCar">
                    <img
                        :src="bookingLookupStore?.carData?.imageUrl"
                        :alt="bookingLookupStore?.carData?.name"
                        class="h-20 object-contain"
                        loading="lazy"
                    />

                    <div>
                        <h3 class="text-lg font-semibold">
                            {{ bookingLookupStore?.carData?.name }}
                        </h3>
                    </div>
                </div>

                <!-- Pickup -->
                <div class="flex flex-col gap-1">
                    <h4 class="mb-1 font-semibold">Pick-up</h4>

                    <p class="text-sm text-surface-600">
                        {{ bookingLookupStore?.pickUpLocation?.name }},
                        {{ bookingLookupStore?.pickUpLocation?.city }}
                    </p>

                    <p class="text-sm text-surface-600">
                        {{ pickUpDate }}, {{ bookingLookupStore?.pickUpTime }} ({{ pickUpDay }})
                    </p>
                </div>

                <!-- Dropoff -->
                <div class="flex flex-col gap-1">
                    <h4 class="mb-1 font-semibold">Drop-off</h4>

                    <p class="text-sm text-surface-600">
                        {{ bookingLookupStore?.dropOffLocation?.name }},
                        {{ bookingLookupStore?.dropOffLocation?.city }}
                    </p>

                    <p class="text-sm text-surface-600">
                        {{ dropOffDate }}, {{ bookingLookupStore?.dropOffTime }} ({{ dropOffDay }})
                    </p>
                </div>

                <!-- Duration -->
                <div class="flex flex-col gap-1">
                    <h4 class="mb-1 font-semibold">Rental Duration</h4>

                    <p class="text-sm text-surface-600">
                        {{ rentalPeriodWithText }}
                    </p>
                </div>

                <Divider />

                <!-- Prices -->
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between base-price-row">
                        <span class="text-surface-600">
                            Base price ({{ bookingLookupStore?.carData?.pricePerDay }} € ×
                            {{ rentalPeriodWithText }})
                        </span>

                        <span class="font-medium"> {{ baseRentalFee }} € </span>
                    </div>

                    <div class="flex justify-between insurance-price-row">
                        <span class="text-surface-600">
                            {{ bookingLookupStore?.insuranceData?.name }} ({{
                                bookingLookupStore?.insuranceData?.price
                            }}
                            € × {{ rentalPeriodWithText }})
                        </span>

                        <span class="font-medium"> {{ insuranceFee }} € </span>
                    </div>

                    <div class="extras-price-row space-y-3">
                        <div
                            v-for="extra in bookingLookupStore?.extrasData"
                            :key="extra.id"
                            class="flex justify-between"
                        >
                            <span class="text-surface-600">
                                {{ extra.name }} ({{ extra.price }} € ×
                                {{ rentalPeriodWithText }})</span
                            >

                            <span class="font-medium">
                                {{
                                    calcFee({
                                        price: extra.price,
                                        pickUpDate: bookingLookupStore?.pickUpDate,
                                        dropOffDate: bookingLookupStore?.dropOffDate,
                                    })
                                }}
                                €
                            </span>
                        </div>
                    </div>
                </div>

                <Divider />

                <!-- Total -->
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-semibold">Total</p>
                    </div>

                    <div class="text-right">
                        <p class="text-3xl font-bold text-primary">{{ bookingTotal }} €</p>

                        <p class="text-sm text-surface-500">VAT included</p>
                    </div>
                </div>
            </div>
        </template>
    </Card>
</template>

<script setup>
import Card from 'primevue/card'
import Divider from 'primevue/divider'
import { useBooking } from '@storefront/composables/useBooking'
import { computed, onMounted } from 'vue'
import { useBookingStore } from '@storefront/stores/bookingStore'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { formatDate, getDayName, getDaysBetween } from '@storefront/utils.js'
import { useRouter } from 'vue-router'

const router = useRouter()
const { loadBookingData, baseRentalFee, insuranceFee, bookingTotal, calcFee } = useBooking()
const bookingStore = useBookingStore()
const bookingLookupStore = useBookingLookupStore()

const rentalPeriodWithText = computed(() => {
    const days = getDaysBetween(bookingLookupStore?.pickUpDate, bookingLookupStore?.dropOffDate)
    return days === 1 ? days + ' day' : days + ' days'
})

const pickUpDate = computed(() => {
    return formatDate(new Date(bookingLookupStore?.pickUpDate), 'yyyy.MM.dd')
})

const dropOffDate = computed(() => {
    return formatDate(new Date(bookingLookupStore?.dropOffDate), 'yyyy.MM.dd')
})

const pickUpDay = computed(() => {
    return getDayName(new Date(bookingLookupStore?.pickUpDate))
})

const dropOffDay = computed(() => {
    return getDayName(new Date(bookingLookupStore?.dropOffDate))
})

const backToCar = () => {
    // bookingStore.setBookingStep('car')
    const queryParams = {
        pickUpLocation: bookingLookupStore?.pickUpLocation?.id,
        dropOffLocation: bookingLookupStore?.dropOffLocation?.id,
        pickUpDate: bookingLookupStore?.pickUpDate,
        dropOffDate: bookingLookupStore?.dropOffDate,
    }

    router.push({
        name: 'car',
        params: { id: bookingLookupStore?.carData.id },
        query: queryParams,
    })
}

onMounted(async () => {
    const { carId, pickUpLocationId, dropOffLocationId } = bookingStore.getBookingData
    await loadBookingData({ carId, pickUpLocationId, dropOffLocationId })
})
</script>
