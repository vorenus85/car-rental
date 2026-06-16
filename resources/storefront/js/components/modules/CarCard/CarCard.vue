<template>
    <div
        class="car-card overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition hover:shadow-lg"
    >
        <!-- Image -->
        <div class="relative p-4">
            <img :src="image" :alt="name" class="h-56 w-full object-contain" loading="lazy" />
        </div>

        <div class="p-6 w-full">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-900">
                    {{ name }}
                </h3>

                <div class="my-2">
                    <span class="mr-2 inline-flex py-1 text-sm font-medium">
                        <Tag severity="secondary">{{ year }}</Tag>
                    </span>
                    <span
                        class="inline-flex py-1 text-sm font-medium capitalize"
                        :class="category === 'suv' ? 'uppercase' : ''"
                    >
                        {{ category }}
                    </span>
                </div>
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div class="flex items-center gap-2">
                    <div class="h-5 w-5">
                        <SeatsV1 :size="20"></SeatsV1>
                    </div>
                    <span class="text-sm text-gray-600"> {{ seats }} seats</span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="h-5 w-5"><LuggageV1 :size="20"></LuggageV1></div>
                    <span class="text-sm text-gray-600"> {{ baggage }} bag</span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="h-5 w-5">
                        <FuelV1 :size="20"></FuelV1>
                    </div>
                    <span class="text-sm text-gray-600 capitalize">
                        {{ fuel }}
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="h-5 w-5">
                        <TransmissionV1 :size="20"></TransmissionV1>
                    </div>
                    <span class="text-sm text-gray-600 capitalize">
                        {{ transmission }}
                    </span>
                </div>
            </div>
            <div class="flex justify-between items-center border-t border-gray-200 pt-3">
                <div class="">
                    <span class="text-xl font-bold"> €{{ pricePerDay }} </span>
                    <span class="text-sm text-gray-500"> /day </span>
                </div>
                <Button variant="outlined">View Details</Button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Button, Tag } from 'primevue'
import FuelV1 from '@storefront/components/icons/FuelV1.vue'
import SeatsV1 from '@storefront/components/icons/SeatsV1.vue'
import TransmissionV1 from '@storefront/components/icons/TransmissionV1.vue'
import LuggageV1 from '@storefront/components/icons/LuggageV1.vue'

defineProps({
    name: {
        type: String,
        required: true,
    },
    brand: {
        type: String,
        required: true,
    },
    model: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
    category: {
        type: String,
        required: true,
    },
    year: {
        type: Number,
        required: true,
    },
    pricePerDay: {
        type: Number,
        required: true,
    },
    seats: {
        type: Number,
        required: true,
    },
    baggage: {
        type: Number,
        required: true,
    },
    fuel: {
        type: String,
        required: true,
    },
    transmission: {
        type: String,
        required: true,
    },
})
</script>
