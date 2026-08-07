<template>
    <div class="grid gap-8 p-6 md:grid-cols-4">
        <!-- Vehicle -->
        <div class="flex gap-3">
            <i class="pi pi-car text-xl text-primary mt-1"></i>

            <div>
                <p class="text-sm text-surface-500">Vehicle</p>

                <p class="font-semibold">
                    {{ vehicle || 'Your selected vehicle' }}
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

                <p class="text-sm text-surface-600">{{ pickUpLocation }}</p>
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

                <p class="text-sm text-surface-600">{{ dropOffLocation }}</p>
            </div>
        </div>

        <!-- Price -->
        <div class="flex gap-3">
            <i class="pi pi-wallet text-xl text-primary mt-1"></i>

            <div>
                <p class="text-sm text-surface-500">Total</p>

                <p class="text-2xl font-bold text-primary">€{{ bookingTotal || '0' }}</p>
            </div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    vehicle: {
        type: String,
        default: '',
    },
    pickUpLabel: {
        type: String,
        default: '',
    },
    dropOffLabel: {
        type: String,
        default: '',
    },
    pickUpLocation: {
        type: String,
        default: '',
    },
    dropOffLocation: {
        type: String,
        default: '',
    },
    bookingTotal: {
        type: Number,
        default: 0,
    },
})
</script>
