<template>
    <PublicLayout class="booking-page-2">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <BookingSteppes :active="2" class="pb-5" />
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3 pt-5">
                <div class="md:col-span-2">
                    <PageTitle
                        title="Driver Details"
                        subtitle="Please provide the driver's personal information and driver's license details."
                        class="mb-5"
                    ></PageTitle>
                    <div class="driver-details flex flex-col">
                        <PersonalInformation class="mb-8"></PersonalInformation>
                        <AddressInformation class="mb-8"></AddressInformation>
                        <DrivingLicenceInformation></DrivingLicenceInformation>
                    </div>
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
import BookingSidebarSummary from '@storefront/components/modules/Booking/BookingSidebarSummary.vue'
import PersonalInformation from '@storefront/components/modules/Profile/PersonalInformation.vue'
import AddressInformation from '@storefront/components/modules/Profile/AddressInformation.vue'
import DrivingLicenceInformation from '@storefront/components/modules/Profile/DrivingLicenceInformation.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
    {
        label: 'Booking extras and insurance',
        route: '/booking-driver-info',
    },
]

const handleBack = () => {
    globalThis.history.back()
}

const handleNext = () => {
    router.push({ name: 'booking-payment' })
}
</script>
