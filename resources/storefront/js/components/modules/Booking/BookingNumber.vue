<template>
    <!-- Booking Number -->
    <div class="border bg-green-50 border-green-200 px-6 py-5 rounded-xl">
        <div
            class="flex items-center justify-between flex-col md:flex-row"
            @click="copyBookingReference"
        >
            <p class="font-medium tracking-wide text-surface-700">Booking Reference</p>

            <h2 class="mt-1 text-3xl font-bold tracking-wide text-surface-900">
                {{ bookingId }}
            </h2>
            <Button
                icon="pi pi-copy"
                severity="secondary"
                outlined
                aria-label="Copy booking reference"
                @click="copyBookingReference"
            />
        </div>
    </div>
</template>
<script setup>
import { Button } from 'primevue'
import { useCustomToast } from '@storefront/composables/useCustomToast'

const { customToast } = useCustomToast()

const props = defineProps({
    bookingId: {
        type: String,
        default: 'CR-20260720-01-01-0001',
    },
})

const copyBookingReference = async () => {
    await navigator.clipboard.writeText(props.bookingId)

    customToast.success('Booking reference copied to clipboard.')
}
</script>
