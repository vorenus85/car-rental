<template>
    <div class="py-4 px-4 home-advantages mx-auto max-w-8xl">
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div
                v-for="item in advantages"
                :key="item.icon"
                class="flex items-center gap-3 rounded-3xl py-3 text-center justify-center"
            >
                <div class="flex h-14 w-14 items-center justify-center home-advantages-icon">
                    <component class="advantage-icon" :is="icons[item.icon]" :size="40" />
                </div>
                <div class="flex flex-col gap-1 text-left">
                    <div class="text-l font-semibold">{{ item.title }}</div>
                    <div class="text-sm">{{ item.subTitle }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import InsuaranceV1 from '@storefront/components/icons/InsuaranceV1.vue'
import RoadAssistanceV1 from '@storefront/components/icons/RoadAssistanceV1.vue'
import FuelV1 from '@storefront/components/icons/FuelV1.vue'
import BookingV1 from '@storefront/components/icons/BookingV1.vue'

const icons = {
    InsuaranceV1,
    RoadAssistanceV1,
    FuelV1,
    BookingV1,
}

const advantages = [
    {
        icon: 'InsuaranceV1',
        title: 'Full Insuarance',
        subTitle: 'All rentals include comprehensive insurance.',
    },
    {
        icon: 'RoadAssistanceV1',
        title: '24/7 Roadside Assistance',
        subTitle: 'We are here to help you anytime, anywhere',
    },
    {
        icon: 'FuelV1',
        title: 'Full To Full Fuel Policy',
        subTitle: 'Pick up, full, return full. Simple!',
    },
    {
        icon: 'BookingV1',
        title: 'Easy Booking',
        subTitle: 'Quick, easy and secure booking in minutes!',
    },
]
</script>
<style scoped>
.home-advantages-icon {
    border-radius: 50%;
    flex: 0 0 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f2f1f4;
}
</style>
