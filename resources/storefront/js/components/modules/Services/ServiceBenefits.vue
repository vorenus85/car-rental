<script setup>
import InsuaranceV1 from '@storefront/components/icons/InsuaranceV1.vue'
import FuelV1 from '@storefront/components/icons/FuelV1.vue'
import CalendarV2 from '@storefront/components/icons/CalendarV2.vue'
import SupportV1 from '@storefront/components/icons/SupportV1.vue'
import ValletV1 from '@storefront/components/icons/ValletV1.vue'
import CarV2 from '@storefront/components/icons/CarV2.vue'

const icons = {
    InsuaranceV1,
    FuelV1,
    CalendarV2,
    SupportV1,
    ValletV1,
    CarV2,
}

const benefits = [
    {
        title: 'Full Insurance',
        text: 'Drive with peace of mind.',
        icon: 'InsuaranceV1',
    },
    {
        title: 'Free Cancellation',
        text: 'Cancel up to 48 hours before pick-up.',
        icon: 'CalendarV2',
    },
    {
        title: '24/7 Support',
        text: 'We’re here anytime, anywhere.',
        icon: 'SupportV1',
    },
    {
        title: 'Best Price Guarantee',
        text: 'The best rates with no hidden fees.',
        icon: 'ValletV1',
    },
    {
        title: 'Full-to-Full Policy',
        text: 'Pick up full, return full.',
        icon: 'FuelV1',
    },
    {
        title: 'Wide Selection',
        text: 'From economy to luxury, we have the perfect car.',
        icon: 'CarV2',
    },
]
</script>

<template>
    <section class="relative z-10 px-4" style="margin-top: -2rem">
        <div
            class="mx-auto max-w-7xl rounded-xl bg-white px-6 py-7 shadow-[0_12px_35px_rgba(15,23,42,0.14)]"
        >
            <div class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 lg:grid-cols-6">
                <div
                    v-for="(benefit, index) in benefits"
                    :key="benefit.title"
                    class="flex flex-col items-center px-5 text-center lg:border-r lg:border-slate-200"
                    :class="{ 'lg:border-r-0': index === benefits.length - 1 }"
                >
                    <div
                        class="mb-4 flex h-20 items-center justify-center text-2xl font-semibold text-primary"
                    >
                        <component :is="icons[benefit.icon]" :size="80" />
                    </div>

                    <h3 class="mb-2 text-sm font-bold text-slate-950">
                        {{ benefit.title }}
                    </h3>

                    <p class="max-w-[150px] text-sm leading-6 text-slate-700">
                        {{ benefit.text }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
