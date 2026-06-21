<template>
    <Card class="overflow-hidden">
        <template #header>
            <div class="p-4">
                <RouterLink
                    :to="{
                        name: 'car',
                        params: { id: car.id },
                        query: queryParams,
                    }"
                    ><img
                        :src="car.imageUrl"
                        :alt="car.name"
                        class="h-56 w-full object-contain hover:scale-110 transition-transform duration-300"
                        loading="lazy"
                    />
                </RouterLink>
            </div>
        </template>

        <template #content>
            <div>
                <RouterLink
                    class="text-xl font-bold hover:text-primary"
                    :to="{
                        name: 'car',
                        params: { id: car.id },
                        query: queryParams,
                    }"
                >
                    {{ car.name }}
                </RouterLink>

                <div class="my-3 flex items-center gap-2">
                    <Tag :value="car.productionYear" severity="secondary" />

                    <Tag
                        :value="car.category"
                        severity="secondary"
                        class="capitalize"
                        :class="{ uppercase: car.category === 'suv' }"
                    />
                </div>

                <div class="mb-5 grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <SeatsV1 :size="20" />
                        <span class="text-sm text-surface-600"> {{ car.seats }} seats </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <LuggageV1 :size="20" />
                        <span class="text-sm text-surface-600"> {{ car.luggageCount }} bags </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <FuelV1 :size="20" />
                        <span class="text-sm text-surface-600 capitalize">
                            {{ car.fuel }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <TransmissionV1 :size="20" />
                        <span class="text-sm text-surface-600 capitalize">
                            {{ car.transmission }}
                        </span>
                    </div>
                </div>

                <Divider />

                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-2xl font-bold"> €{{ car.pricePerDay }} </span>
                        <span class="text-sm text-surface-500"> /day </span>
                    </div>

                    <Button
                        label="View Details"
                        outlined
                        as="router-link"
                        :to="{
                            name: 'car',
                            params: { id: car.id },
                            query: queryParams,
                        }"
                    />
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
import { useRoute } from 'vue-router'
import { computed } from 'vue'

const route = useRoute()

const queryParams = computed(() => {
    const { location, pickUpDate, dropOffDate } = route.query
    return { location, pickUpDate, dropOffDate }
})

defineProps({
    car: {
        type: Object,
        default: () => {},
    },
})
</script>
