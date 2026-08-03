<template>
    <PublicLayout class="booking-success-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <BookingSteppes :active="4" class="pb-5" />
            <div class="rounded-2xl p-5">
                <!-- Success Icon -->
                <div class="flex justify-center">
                    <ConfettiEffect></ConfettiEffect>
                </div>

                <!-- Title -->
                <div class="mt-8 text-center">
                    <h1 class="text-3xl font-bold text-surface-900">Booking Confirmed!</h1>

                    <p class="mt-3 text-surface-600">
                        Thank you! Your booking has been successfully confirmed.
                    </p>

                    <p class="mt-1 text-surface-600">
                        A confirmation email has been sent to
                        <span class="font-semibold">
                            {{ bookingStore?.driver?.personal?.email || 'your email address' }}
                        </span>
                        .
                    </p>
                </div>

                <BookingNumber :booking-id="bookingNumber" class="mt-5"></BookingNumber>

                <div class="mt-10 rounded-xl border border-surface-200 bg-white">
                    <div class="grid gap-8 p-6 md:grid-cols-4">
                        <!-- Vehicle -->
                        <div class="flex gap-3">
                            <i class="pi pi-car text-xl text-primary mt-1"></i>

                            <div>
                                <p class="text-sm text-surface-500">Vehicle</p>

                                <p class="font-semibold">
                                    {{ bookingLookupStore?.carData?.name || 'Your selected vehicle' }}
                                </p>
                            </div>
                        </div>

                        <!-- Pickup -->
                        <div class="flex gap-3">
                            <i class="pi pi-calendar text-xl text-primary mt-1"></i>

                            <div>
                                <p class="text-sm text-surface-500">Pickup</p>

                                <p class="font-semibold">
                                    {{ pickUpLabel }}
                                </p>

                                <p class="text-sm text-surface-600">Vienna Central Station</p>
                            </div>
                        </div>

                        <!-- Dropoff -->
                        <div class="flex gap-3">
                            <i class="pi pi-map-marker text-xl text-primary mt-1"></i>

                            <div>
                                <p class="text-sm text-surface-500">Drop-off</p>

                                <p class="font-semibold">
                                    {{ dropOffLabel }}
                                </p>

                                <p class="text-sm text-surface-600">Vienna Airport</p>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex gap-3">
                            <i class="pi pi-wallet text-xl text-primary mt-1"></i>

                            <div>
                                <p class="text-sm text-surface-500">Total</p>

                                <p class="text-2xl font-bold text-primary">
                                    €{{ bookingTotal || '0' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 md:grid-cols-2 mt-5">
                    <FreeCancelation></FreeCancelation>
                    <SupportPhone></SupportPhone>
                </div>

                <!-- Buttons -->

                <div class="mt-10 flex flex-col justify-between gap-4 sm:flex-row">
                    <Button label="Download Confirmation" icon="pi pi-download" outlined />

                    <Button label="View My Bookings" icon="pi pi-list" />

                    <Button label="Back to Home" icon="pi pi-home" severity="secondary" text />
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import BookingSteppes from '@storefront/components/modules/Booking/BookingSteppes.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { Button } from 'primevue'
import FreeCancelation from '@storefront/components/modules/FreeCancelation.vue'
import SupportPhone from '@storefront/components/modules/SupportPhone.vue'
import BookingNumber from '@storefront/components/modules/Booking/BookingNumber.vue'
import ConfettiEffect from '../../components/modules/Booking/ConfettiEffect.vue'
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useBookingStore } from '@storefront/stores/bookingStore'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { formatDate } from '@storefront/utils.js'

const route = useRoute()
const bookingStore = useBookingStore()
const bookingLookupStore = useBookingLookupStore()

const bookingNumber = computed(() => {
    return route.query.bookingNumber || 'Booking reference'
})

const bookingTotal = computed(() => {
    const dailyRate = bookingLookupStore?.carData?.pricePerDay || 0
    const days = bookingLookupStore?.pickUpDate && bookingLookupStore?.dropOffDate
        ? Math.max(
              1,
              Math.ceil(
                  (new Date(bookingLookupStore.dropOffDate).setHours(0, 0, 0, 0) -
                      new Date(bookingLookupStore.pickUpDate).setHours(0, 0, 0, 0)) /
                      (1000 * 60 * 60 * 24)
              )
          )
        : 0
    const insurance = (bookingLookupStore?.insuranceData?.price || 0) * days
    const extras = (bookingLookupStore?.extrasData || []).reduce((sum, extra) => {
        return sum + (extra.quantity || 0) * (extra.price || 0) * days
    }, 0)

    return (dailyRate * days + insurance + extras).toFixed(0)
})

const pickUpLabel = computed(() => {
    if (!bookingLookupStore?.pickUpDate) {
        return 'Pickup details'
    }

    return `${formatDate(new Date(bookingLookupStore.pickUpDate), 'yyyy.MM.dd')} • ${
        bookingLookupStore.pickUpTime
    }`
})

const dropOffLabel = computed(() => {
    if (!bookingLookupStore?.dropOffDate) {
        return 'Drop-off details'
    }

    return `${formatDate(new Date(bookingLookupStore.dropOffDate), 'yyyy.MM.dd')} • ${
        bookingLookupStore.dropOffTime
    }`
})

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
    {
        label: 'Successful booking',
    },
]
</script>
