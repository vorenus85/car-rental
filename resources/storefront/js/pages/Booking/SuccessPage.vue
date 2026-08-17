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
                            {{ customerEmail }}
                        </span>
                        .
                    </p>
                </div>

                <BookingNumber :booking-id="bookingNumber" class="mt-5"></BookingNumber>

                <div class="mt-10 rounded-xl border border-surface-200 bg-white">
                    <BookingOrderInfos
                        :vehicle="vehicle"
                        :booking-total="bookingTotal"
                        :pick-up-label="pickUpLabel"
                        :drop-off-label="dropOffLabel"
                        :pick-up-location="pickUpLocation"
                        :drop-off-location="dropOffLocation"
                    ></BookingOrderInfos>
                </div>

                <div class="grid gap-5 md:grid-cols-2 mt-5">
                    <FreeCancelation></FreeCancelation>
                    <SupportPhone></SupportPhone>
                </div>

                <!-- Buttons -->
                <div class="mt-10 flex flex-col justify-between gap-4 sm:flex-row">
                    <SuccessActions :download-url="invoiceUrl" />
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import { computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import BookingSteppes from '@storefront/components/modules/Booking/BookingSteppes.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import FreeCancelation from '@storefront/components/modules/FreeCancelation.vue'
import SupportPhone from '@storefront/components/modules/SupportPhone.vue'
import BookingNumber from '@storefront/components/modules/Booking/Success/BookingNumber.vue'
import ConfettiEffect from '@storefront/components/modules/Booking/Success/ConfettiEffect.vue'
import SuccessActions from '@storefront/components/modules/Booking/Success/SuccessActions.vue'
import BookingOrderInfos from '@storefront/components/modules/Booking/Success/BookingOrderInfos.vue'
import { useBookingOrder } from '@storefront/composables/useBookingOrder.js'

const route = useRoute()
const publicId = computed(() => {
    return route.query.publicId || null
})

const invoiceUrl = computed(() => {
    return publicId.value
        ? `/api/storefront/booking/invoice?publicId=${encodeURIComponent(publicId.value)}`
        : ''
})

const {
    loadBookingOrder,
    vehicle,
    bookingNumber,
    customerEmail,
    pickUpLabel,
    dropOffLabel,
    pickUpLocation,
    dropOffLocation,
    bookingTotal,
} = useBookingOrder()

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
    {
        label: 'Successful booking',
    },
]

onMounted(async () => {
    await loadBookingOrder(publicId.value)
})
</script>
