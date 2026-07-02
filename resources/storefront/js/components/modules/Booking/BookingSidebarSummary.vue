<template>
    <Card class="rounded-2xl shadow-sm">
        <template #content>
            <div class="space-y-6">
                <!-- Title -->
                <h2 class="text-lg font-semibold text-surface-900">Booking Summary</h2>

                <!-- Car -->
                <div class="flex items-center gap-4">
                    <Image
                        src="/images/cars/vw-golf-8.png"
                        alt="VW Golf 8"
                        width="90"
                        preview="false"
                    />

                    <div>
                        <h3 class="text-lg font-semibold">VW Golf 8</h3>
                    </div>
                </div>

                <!-- Pickup -->
                <div>
                    <h4 class="mb-1 font-semibold">Pick-up</h4>

                    <p class="text-sm text-surface-600">Liszt Ferenc Airport</p>

                    <p class="text-sm text-surface-600">2026. 07. 15. (Wednesday) 10:00</p>
                </div>

                <!-- Dropoff -->
                <div>
                    <h4 class="mb-1 font-semibold">Drop-off</h4>

                    <p class="text-sm text-surface-600">Liszt Ferenc Airport</p>

                    <p class="text-sm text-surface-600">2026. 07. 18. (Saturday) 10:00</p>
                </div>

                <!-- Duration -->
                <div>
                    <h4 class="mb-1 font-semibold">Rental Duration</h4>

                    <p class="text-sm text-surface-600">3 days</p>
                </div>

                <Divider />

                <!-- Prices -->
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-surface-600"> Base price (15 990 Ft × 3 days) </span>

                        <span class="font-medium"> 47 970 Ft </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-surface-600"> Full coverage insurance </span>

                        <span class="font-medium"> 2 500 Ft </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-surface-600"> Extras </span>

                        <span class="font-medium"> 0 Ft </span>
                    </div>
                </div>

                <Divider />

                <!-- Total -->
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-semibold">Total</p>
                    </div>

                    <div class="text-right">
                        <p class="text-3xl font-bold text-primary">50 470 Ft</p>

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
import Image from 'primevue/image'
</script>
