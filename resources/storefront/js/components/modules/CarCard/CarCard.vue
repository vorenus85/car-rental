<template>
    <Card class="overflow-hidden">
        <template #header>
            <div class="p-4">
                <img :src="image" :alt="name" class="h-56 w-full object-contain" loading="lazy" />
            </div>
        </template>

        <template #content>
            <div>
                <h3 class="text-xl font-bold">
                    {{ name }}
                </h3>

                <div class="my-3 flex items-center gap-2">
                    <Tag :value="year" severity="secondary" />

                    <Tag
                        :value="category"
                        severity="secondary"
                        class="capitalize"
                        :class="{ uppercase: category === 'suv' }"
                    />
                </div>

                <div class="mb-5 grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <SeatsV1 :size="20" />
                        <span class="text-sm text-surface-600"> {{ seats }} seats </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <LuggageV1 :size="20" />
                        <span class="text-sm text-surface-600"> {{ baggage }} bag </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <FuelV1 :size="20" />
                        <span class="text-sm text-surface-600 capitalize">
                            {{ fuel }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <TransmissionV1 :size="20" />
                        <span class="text-sm text-surface-600 capitalize">
                            {{ transmission }}
                        </span>
                    </div>
                </div>

                <Divider />

                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-2xl font-bold"> €{{ pricePerDay }} </span>
                        <span class="text-sm text-surface-500"> /day </span>
                    </div>

                    <Button label="View Details" outlined />
                </div>
            </div>
        </template>
    </Card>
</template>

<script setup>
import { Button, Tag, Card, Divider } from 'primevue'
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
