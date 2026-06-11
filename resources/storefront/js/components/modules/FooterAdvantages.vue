<template>
    <div class="mx-auto max-w-8xl px-4 py-4 footer-advantages">
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div
                v-for="item in advantages"
                :key="item.icon"
                class="flex items-center gap-4 rounded-3xl py-3 text-center justify-center"
            >
                <div class="flex h-14 w-14 items-center justify-center">
                    <component class="advantage-icon" :size="80" :is="icons[item.icon]" />
                </div>
                <div class="flex flex-col gap-1 text-left">
                    <div class="text-3xl font-semibold text-white">{{ item.title }}</div>
                    <div class="text-sm text-white">{{ item.subTitle }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import CarV1 from '@storefront/components/icons/CarV1.vue'
import LocationV1 from '@storefront/components/icons/LocationV1.vue'
import UsersV1 from '@storefront/components/icons/UsersV1.vue'
import RatingV1 from '@storefront/components/icons/RatingV1.vue'

const icons = {
    CarV1,
    LocationV1,
    UsersV1,
    RatingV1,
}

const advantages = [
    {
        icon: 'CarV1',
        title: '100+',
        subTitle: 'Vehicles',
    },
    {
        icon: 'LocationV1',
        title: '50+',
        subTitle: 'Locations',
    },
    {
        icon: 'UsersV1',
        title: '10K+',
        subTitle: 'Happy Customers',
    },
    {
        icon: 'RatingV1',
        title: '4.8/5',
        subTitle: 'Customer Rating',
    },
]
</script>
<style scoped>
.advantage-icon {
    color: var(--primary-color);
}
</style>
