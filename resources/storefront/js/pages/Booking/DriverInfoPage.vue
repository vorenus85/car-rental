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
                    <div class="driver-details">
                        <DriverInfoSection :is-open="activeSection === 'personal'" class="mt-8">
                            <template #header>
                                <SectionHeader
                                    :title="'Personal Information'"
                                    :sub-title="`Please provide the driver's personal information.`"
                                />
                            </template>
                            <template #body>
                                <PersonalInformation
                                    :btn-label="'Next'"
                                    :section="'personal'"
                                    @save="handleSectionNext"
                                ></PersonalInformation>
                            </template>
                        </DriverInfoSection>

                        <DriverInfoSection :is-open="activeSection === 'address'" class="mt-8">
                            <template #header>
                                <SectionHeader
                                    :title="'Address Information'"
                                    :sub-title="`Please provide your residential address.`"
                                />
                            </template>
                            <template #body>
                                <AddressInformation
                                    :btn-label="'Next'"
                                    :section="'address'"
                                    :back-label="'Back'"
                                    :show-back="true"
                                    @back="handleSectionBack"
                                    @save="handleSectionNext"
                                ></AddressInformation>
                            </template>
                        </DriverInfoSection>

                        <DriverInfoSection
                            :is-open="activeSection === 'driving-licence'"
                            class="mt-8"
                        >
                            <template #header>
                                <SectionHeader
                                    :title="'Driving Licence'"
                                    :sub-title="`Please provide your driving licence details.`"
                                />
                            </template>
                            <template #body>
                                <DrivingLicenceInformation
                                    :section="'driving-licence'"
                                    :btn-label="'Continue to Payment'"
                                    :back-label="'Back'"
                                    :show-back="true"
                                    @back="handleSectionBack"
                                    @save="handleSectionNext"
                                ></DrivingLicenceInformation>
                            </template>
                        </DriverInfoSection>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <BookingSidebarSummary></BookingSidebarSummary>
                </div>
            </div>

            <BookingNavigation
                class="pt-5"
                :disabled="driverInfoisInvalid"
                :hide-next="true"
                @back="handleBack"
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
import { computed, ref } from 'vue'
import DriverInfoSection from '@storefront/components/modules/DriverInfo/DriverInfoSection.vue'
import SectionHeader from '@storefront/components/modules/SectionHeader.vue'

const router = useRouter()

const activeSection = ref('personal') //personal, address, driving-licence

const handleSectionNext = event => {
    const { valid, section, errors, values } = event
    console.log(event)
    if (!valid) {
        return
    }

    if (section === 'personal') {
        activeSection.value = 'address'
    }

    if (section === 'address') {
        activeSection.value = 'driving-licence'
    }
}

const handleSectionBack = event => {
    console.log(event)
    if (event === 'address') {
        activeSection.value = 'personal'
    }

    if (event === 'driving-licence') {
        activeSection.value = 'address'
    }
}

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

const driverInfoisInvalid = computed(() => {
    return true
})
</script>
