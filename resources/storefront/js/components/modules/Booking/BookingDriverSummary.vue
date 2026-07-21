<template>
    <Card class="rounded-2xl shadow-sm booking-sidebar-summary">
        <template #content>
            <div class="space-y-6">
                <!-- Title -->
                <h2 class="text-lg font-semibold text-surface-900">Driver details</h2>
                <div class="flex flex-col gap-1">
                    <p class="text-sm text-surface-600">
                        <strong class="text-surface-900">Name:</strong> {{ personalData.firstName }}
                        {{ personalData.lastName }}
                    </p>
                    <p class="text-sm text-surface-600">
                        <strong class="text-surface-900">Email:</strong> {{ personalData.email }}
                    </p>
                    <p class="text-sm text-surface-600">
                        <strong class="text-surface-900">Phone:</strong> {{ personalData.phone }}
                    </p>
                </div>

                <div class="">
                    <Button
                        severity="secondary"
                        size="small"
                        outlined
                        class="w-20"
                        @click="toDriverInfo"
                        >Edit</Button
                    >
                </div>
            </div>
        </template>
    </Card>
</template>
<script setup>
import { Button, Card } from 'primevue'
import { useBookingStore } from '@storefront/stores/bookingStore'
import { useRouter } from 'vue-router'

const bookingStore = useBookingStore()
const router = useRouter()
const personalData = bookingStore.getDriverPersonal

const toDriverInfo = () => {
    router.push({ name: 'booking-driver-info' })
}
</script>
