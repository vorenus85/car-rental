<template>
    <PublicLayout class="booking-page-1">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <BookingSteppes :active="1" class="pb-5" />
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3 pt-5">
                <div class="md:col-span-2">
                    <PageTitle
                        title="Extras and Insurance"
                        subtitle="Choose from our optional extras and insurance packages."
                        class="mb-5"
                    ></PageTitle>

                    <BookingInsurance class="pt-5"></BookingInsurance>
                    <BookingExtras class="pt-5"></BookingExtras>
                </div>
                <div class="md:col-span-1">
                    <BookingSidebarSummary class="mt-8"></BookingSidebarSummary>
                </div>
            </div>

            <BookingNavigation
                class="pt-5"
                @back="handleBack"
                @next="handleNext"
            ></BookingNavigation>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BookingSteppes from '@storefront/components/modules/Booking/BookingSteppes.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import BookingNavigation from '@storefront/components/modules/Booking/BookingNavigation.vue'
import BookingInsurance from '@storefront/components/modules/Booking/Insuarance/BookingInsurance.vue'
import BookingExtras from '@storefront/components/modules/Booking/Extras/BookingExtras.vue'
import BookingSidebarSummary from '@storefront/components/modules/Booking/BookingSidebarSummary.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
    {
        label: 'Booking extras and insurance',
    },
]

const handleBack = () => {
    globalThis.history.back()
}

const handleNext = () => {
    router.push({ name: 'booking-driver-info' })
}
</script>
