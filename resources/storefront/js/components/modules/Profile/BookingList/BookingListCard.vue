<template>
    <Card class="overflow-hidden">
        <template #content>
            <div class="flex flex-col gap-5">
                <!-- Header -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex items-center gap-4">
                        <!-- Car image -->
                        <Image
                            :src="item.vehicleImg"
                            :alt="item.vehicle"
                            image-class="h-20 w-28 rounded-lg object-cover"
                        />

                        <!-- Car info -->
                        <div>
                            <h3 class="text-lg font-semibold text-surface-900">
                                {{ item.vehicle }}
                            </h3>

                            <p class="mt-1 text-sm text-surface-500">
                                Booking #{{ item.bookingNumber }}
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <Tag
                        :value="statusSeverityLabel(item.status)"
                        :severity="statusSeverity(item.status)"
                        rounded
                    />
                </div>

                <Divider />

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-8">
                        <!-- Drivel -->
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-surface-500">
                                Driver
                            </p>

                            <p class="mt-1 font-semibold text-surface-900">
                                {{ item.driver.name }}
                            </p>
                            <p class="mt-1 text-sm text-surface-500">{{ item.driver.phone }}</p>
                        </div>
                    </div>
                </div>

                <Divider />

                <!-- Pickup / Dropoff -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Pickup -->
                    <div>
                        <div class="mb-2 flex items-center gap-2">
                            <i class="pi pi-sign-in text-primary" />

                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-surface-500"
                            >
                                Pick-up
                            </span>
                        </div>

                        <p class="font-medium text-surface-900">
                            {{ item.pickUpCity }}, {{ item.pickUpLocation }}
                        </p>

                        <BookingTime :date="item.pickupAt"></BookingTime>
                    </div>

                    <!-- Dropoff -->
                    <div>
                        <div class="mb-2 flex items-center gap-2">
                            <i class="pi pi-sign-out text-primary" />

                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-surface-500"
                            >
                                Drop-off
                            </span>
                        </div>

                        <p class="font-medium text-surface-900">
                            {{ item.dropOffCity }}, {{ item.dropOffLocation }}
                        </p>

                        <BookingTime :date="item.dropoffAt"></BookingTime>
                    </div>
                </div>

                <Divider />

                <!-- Summary -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center justify-between">
                    <div class="flex items-center gap-8">
                        <!-- Duration -->
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-surface-500">
                                Duration
                            </p>

                            <p class="mt-1 font-semibold text-surface-900">
                                {{ item.days }} day(s)
                            </p>
                        </div>

                        <!-- Total -->
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-surface-500">
                                Total
                            </p>

                            <p class="mt-1 text-lg font-bold text-surface-900">
                                €{{ Math.round(item.bookingTotal) }}
                            </p>
                        </div>
                    </div>

                    <!-- Action -->
                    <!--
                    <Button
                        label="View details"
                        icon="pi pi-arrow-right"
                        icon-pos="right"
                        outlined
                    />
                --></div>
            </div>
        </template>
    </Card>
</template>

<script setup>
import Card from 'primevue/card'
import Tag from 'primevue/tag'
import Divider from 'primevue/divider'
import Image from 'primevue/image'
import { useProfileBookings } from '@storefront/composables/useProfileBookings'
import BookingTime from '@storefront/components/modules/Booking/BookingTime.vue'

const { statusSeverity, statusSeverityLabel } = useProfileBookings()

defineProps({
    item: {
        type: Object,
        default: () => {},
    },
})
</script>
